@section('topAssets')
    <style>
        .CodeMirror {
            float: left;
            width: 50%;
            border: 1px solid black;
        }

        iframe {
            width: 49%;
            float: left;
            height: 300px;
            border: 1px solid black;
            border-left: 0px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/lib/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/codemirror/theme/dracula.css') }}">
    <script src="{{ asset('assets/lib/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('assets/lib/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('assets/lib/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('assets/lib/codemirror/addon/edit/closetag.js') }}"></script>
    <script src="{{ asset('assets/lib/codemirror/addon/hint/html-hint.js') }}"></script>
@endsection

@section('bottomAssets')
    @vite('resources/js/assignment.js')
@endsection

<x-app-layout>
    <div class="mb-5">
        <h1 class="text-2xl font-bold">Ruangan: {{ $assignment->room->name }}</h1>
        <p class="text-light text-slate-500">Silakan memilih tipe tugas sesuai dengan instruksi yang diberikan oleh
            dosen. Gunakan status draft jika masih ingin mengubah tugas dan status kumpul jika ingin mengumpulkan tugas
            tanpa mengubah.</p>
    </div>

    @if (now() > $assignment->room->closed_at)
        <section class="px-4 py-2 my-2 bg-red-100 rounded">
            <div class="flex flex-col items-center justify-center h-52">
                <x-heroicon-o-clock class="w-20 h-20 stroke-red-500" />
                <p class="mt-5 text-slate-500">Waktu pengumpulan tugas telah selesai.</p>
            </div>
        </section>
    @else
        @if ($errors->all())
            <div class="px-5 py-3 mb-3 bg-red-300 rounded-md">
                @foreach ($errors->all() as $message)
                    <ul class="flex flex-col">
                        <li class="list-disc">
                            <p class="text-sm font-light">{{ $message }}</p>
                        </li>
                    </ul>
                @endforeach
            </div>
        @endif
        <form action="{{ route('storeAssignment', $assignment->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-between mb-5">
                <input id="isAttachmentValue" type="hidden" name="is_attachment" value="0">
                <div>
                    <div class="flex space-x-3">
                        <div>
                            <label for="typeTaskSelect"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                                Tugas</label>
                            <select id="typeTaskSelect" onchange="typeTask(this.value)"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option id="code" value="0">Code</option>
                                <option id="file" value="1">File</option>
                            </select>
                        </div>

                        <div>
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select name="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=0 selected>Draft</option>
                                <option value=1>Kirim</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="isCode" class="-mt-16">
                <div class="flex justify-end mb-5">
                    <x-button.small-primary class="block px-5" id="runCodeMirror">
                        Run Code
                    </x-button.small-primary>
                </div>
                <div>
                    <textarea class="block" name="content" id="codemirror"></textarea>
                </div>
                <iframe id="preview"></iframe>
            </div>

            <div id="isAttachment" class="hidden mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                    file</label>
                <input name="attachment"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="file_input_help" id="file_input" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help uppercase">Word, Pdf,
                    Excel, Zip, Rar.
                    (Max: 10Mb)
                </p>
            </div>

            <x-button.small-primary type="submit" class="w-full px-5 mt-5">
                Kirim
            </x-button.small-primary>
        </form>
    @endif

</x-app-layout>
