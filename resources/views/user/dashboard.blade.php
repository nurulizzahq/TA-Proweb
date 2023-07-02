@hasrole('student')
    <x-app-layout>
        <div class="mt-3 mb-5">
            <h1 class="text-2xl font-bold">Welcome {{ auth()->user()->name }} 🎉</h1>
            <p class="text-light text-slate-500">Semoga aktivitas belajarmu menyenangkan.</p>
        </div>
        <div>
            @if (session('message'))
                <x-alert type="success">
                    {{ session('message') }}
                </x-alert>
            @endif
            <p class="mb-2 ml-1 font-light">Kelas yang kamu pelajari.</p>
        </div>

        <section class="px-4 py-2 my-2 rounded bg-slate-100">
            @if ($courseLearneds->count() == 0)
                <div class="flex flex-col items-center justify-center h-52">
                    <x-heroicon-o-face-frown class="w-20 h-20 stroke-blue-500" />
                    <p class="text-slate-500">Belum ada kelas yang dipelajari.</p>
                    <x-button.small-primary class="mt-3" href="{{ route('coursesStudent') }}">
                        Belajar Sekarang
                    </x-button.small-primary>
                </div>
            @else
                @foreach ($courseLearneds as $learned)
                    <div class="flex items-center justify-between border-b">
                        <a href="{{ route('learn', $learned->course->slug) }}">
                            <h3 class="p-4 text-xl font-light hover:underline hover:text-blue-500">
                                {{ $learned->course->name }}
                            </h3>
                        </a>
                        @if (!$learned->is_completed)
                            <x-button.small-primary href="{{ route('learn', $learned->course->slug) }}">
                                Lanjut Belajar
                            </x-button.small-primary>
                        @else
                            <x-button.small-success href="{{ route('exam', $learned->course->slug) }}">
                                Latihan Soal
                            </x-button.small-success>
                        @endif
                    </div>
                @endforeach
            @endif
        </section>
    </x-app-layout>
@endrole

@hasrole('lecturer')
    <x-app-layout>
        <div class="mt-3 mb-5">
            <h1 class="text-2xl font-bold">Welcome {{ auth()->user()->name }} 🎉</h1>
            <p class="text-light text-slate-500">Semoga aktivitas kamu menyenangkan.</p>
        </div>
        <div>
            @if (session('message'))
                <x-alert type="success">
                    {{ session('message') }}
                </x-alert>
            @endif
        </div>

        <section>
            <div>
                <div class="mb-4">
                    <h2 class="text-lg font-medium text-slate-600">Hasil Review:</h2>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Kelas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Dibuat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $review->course->name }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($review->status == 'Pending')
                                            <span class="text-yellow-500">{{ $review->status }}</span>
                                        @elseif ($review->status == 'Process')
                                            <span class="text-blue-500">{{ $review->status }}</span>
                                        @elseif ($review->status == 'Success')
                                            <span class="text-green-500">{{ $review->status }}</span>
                                        @else
                                            <span class="text-red-500">{{ $review->status }}</span>
                                        @endif
                                    </th>

                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ date('d-m-Y', strtotime($review->created_at)) }}
                                    </th>

                                    <td class="flex gap-2 px-6 py-4">

                                        <a href="{{ route('lecturerCourse.showReview', $review->id) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div>
                <div class="mb-4">
                    <h2 class="text-lg font-medium text-slate-600">Stats:</h2>
                </div>
                <div class="block w-full p-5 text-center rounded-lg bg-slate-200">
                    <h3 class="text-4xl font-bold">{{ $assignments->count() }}</h3>
                    <p class="text-sm text-slate-600">Total Tugas Terkumpul</p>
                </div>
            </div> --}}
        </section>
    </x-app-layout>
@endrole

@hasrole('super-admin')
    <x-app-layout>
        <div class="mt-3 mb-5">
            <h1 class="text-2xl font-bold">Welcome {{ auth()->user()->name }} 🎉</h1>
            <p class="text-light text-slate-500">Semoga aktivitas kamu menyenangkan.</p>
        </div>
        <div>
            @if (session('message'))
                <x-alert type="success">
                    {{ session('message') }}
                </x-alert>
            @endif
        </div>

        <section>
            <div class="mb-4">
                <h2 class="text-lg font-medium text-slate-600">Hasil Latihan Soal:</h2>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Skor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Ujian
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($examResults as $result)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $result->user->name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $result->course->name }}
                                </th>

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $result->score }}
                                </th>

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ date('d-m-Y', strtotime($result->created_at)) }}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </x-app-layout>
@endrole
