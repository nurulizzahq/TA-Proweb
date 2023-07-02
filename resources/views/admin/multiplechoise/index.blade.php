<x-app-layout>
    <div class="flex justify-end mb-3">
        <x-button.small-primary data-modal-target="create-room-multiple-choise"
            data-modal-toggle="create-room-multiple-choise" class="flex items-center gap-1">
            <x-heroicon-o-plus class="w-4 h-4" />
            <span>Buat Kelas</span>
        </x-button.small-primary>
    </div>

    <div id="create-room-multiple-choise" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-hide="create-room-multiple-choise">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Silahkan
                        Silahkan mengisi form:</h3>
                    <form action="{{ route('multiplechoise.store') }}" method="post">
                        @csrf
                        <div>
                            <select id="course" name="course"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Pilih Kelas</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->slug }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-button.small-primary type="submit" class="block w-full mt-4">
                            <span>Buat Soal</span>
                        </x-button.small-primary>
                    </form>
                </div>
            </div>
        </div>
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
                        Nama Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $class->course->name }}
                        </th>

                        <td class="flex gap-2 px-6 py-4">

                            <a href="{{ route('multiplechoise.indexQuestion', $class->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Pertanyaan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
