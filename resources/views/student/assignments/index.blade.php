<x-app-layout>
    <div class="mb-5">
        <h1 class="text-2xl font-bold">Ruang Tugas</h1>
        <p class="text-light text-slate-500">Harap minta link Ruang Tugas pada dosen kamu.</p>
    </div>
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
                        Nama Ruangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deadline
                    </th>
                    <th scope="col" class="py-3">
                        Telah Dikumpul
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Masuk
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $assignment->room->name }}
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if (now() >= $assignment->room->closed_at)
                                <span
                                    class="text-red-500">{{ date('d-m-Y', strtotime($assignment->room->closed_at)) }}</span>
                            @else
                                <span
                                    class="text-green-500">{{ date('d-m-Y', strtotime($assignment->room->closed_at)) }}</span>
                            @endif
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if (
                                $assignment->studentAssignment == null ||
                                    ($assignment->studentAssignment->send_at == null && $assignment->stundent_assigment_id == null))
                                <x-heroicon-o-x-circle class="w-5 h-5 stroke-red-500" />
                            @else
                                <x-heroicon-o-check-circle class="w-5 h-5 stroke-green-500" />
                            @endif
                        </th>

                        <td class="flex gap-2 px-6 py-4">
                            @if ($assignment->student_assignment_id != null)
                                <a href="{{ route('collectAssignmentSended', $assignment->slug) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                            @else
                                <a href="{{ route('collectAssignment', $assignment->slug) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Kumpul</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-app-layout>
