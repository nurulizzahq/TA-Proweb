<x-app-layout>
    @if (session('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif

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
                            @elseif ($review->status == 'Approve')
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

</x-app-layout>
