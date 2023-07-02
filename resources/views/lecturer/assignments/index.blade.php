<x-app-layout>
    <div class="flex justify-end mb-3">
        <x-button.small-primary href="{{ route('rooms.create') }}" class="flex items-center gap-1">
            <x-heroicon-o-plus class="w-4 h-4" />
            <span>Buat Ruangan</span>
        </x-button.small-primary>
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
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Selesai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $assignment->user->name }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ date('d-m-Y', strtotime($assignment->studentAssignment->send_at)) }}
                        </th>

                        <td class="flex gap-2 px-6 py-4">
                            <a href="{{ route('studentAssigmentsView', $assignment->studentAssignment->slug) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
