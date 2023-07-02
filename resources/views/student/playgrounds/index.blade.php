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
    <h1 class="text-xl font-medium">Playground 📝

    </h1>
    <span class="text-slate-500">Silahkan klik Run Code untuk menampilkan di preview.</span>
    <div class="flex items-center justify-between mb-5">
        <input id="isAttachmentValue" type="hidden" name="is_attachment" value="0">
    </div>
    <div id="isCode">
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
</x-app-layout>
