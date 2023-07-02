<x-app-layout>
    <div class="flex justify-end mb-3">
        <x-button.small-primary href="{{ route('module.create', $course->slug) }}" class="flex items-center gap-1">
            <x-heroicon-o-plus class="w-4 h-4" />
            <span>Tambah Modul</span>
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
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Video
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $module->title }}
                        </th>
                        <td class="px-6 py-4">
                            @if ($module->yt_link !== null)
                                <x-heroicon-o-check-circle class="w-5 h-5 text-green-500" />
                            @else
                                <x-heroicon-o-x-circle class="w-5 h-5 text-red-500" />
                            @endif
                        </td>
                        <td class="flex gap-2 px-6 py-4">
                            <a href="{{ route('module.show', $module->slug) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
