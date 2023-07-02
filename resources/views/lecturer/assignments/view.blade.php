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

@if ($assignment->is_attachment == false)
    <x-app-layout>
        <div class="mb-5">
            <h1 class="text-2xl font-bold">Nama: {{ $user->name }}</h1>
            <p class="text-light text-slate-500">Ruangan: {{ $room->name }}</p>
        </div>

        <div class="flex justify-end mb-5">
            <x-button.small-primary class="block px-5" id="runCodeMirror">
                Run Code
            </x-button.small-primary>
        </div>
        <div id="isCode">
            <div>
                <textarea class="block" name="content" id="codemirror">{{ $assignment->content }}</textarea>
            </div>
            <iframe id="preview"></iframe>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <div class="mb-5">
            <h1 class="text-2xl font-bold">Nama: {{ $user->name }}</h1>
            <p class="text-light text-slate-500">Ruangan: {{ $room->name }}</p>
        </div>

        {{-- file --}}
        <div class="flex flex-row items-center justify-center p-3 mb-5 space-x-5 border rounded shadow">
            <div>
                <x-heroicon-o-document-arrow-down class="w-24 stroke-blue-500" />
            </div>
            <div>
                <p class="mb-3 font-medium text-blue-500">{{ $assignment->attachment }}
                </p>
                <p class="text-sm font-light text-blue-500">
                    {{ date('d-m-Y', strtotime($assignment->updated_at)) }}</p>
            </div>
            <div>
                <form action="{{ route('downloadTask', $assignment->slug) }}" method="post">
                    @csrf
                    <x-button.small-primary type="submit">Download</x-button.small-primary>
                </form>
            </div>
        </div>
    </x-app-layout>
@endif
