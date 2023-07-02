@section('topAssets')
    @vite('resources/js/universal.js')
@endsection
<x-app-layout>
    @foreach ($errors->all() as $message)
        <p>{{ $message }}</p>
    @endforeach
    <form action="{{ route('module.store', $course->slug) }}" method="post">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pengertian Javascript" required>
            </div>

            <div>
                <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link
                    Video</label>
                <input type="url" id="url" name="yt_link"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="https://www.youtube.com/embed/ja2GabBKaaw8">
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Link video
                    youtube, kosongkan jika tidak ada.
                </p>
            </div>

            <div>
                <label for="content"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konten</label>
                <textarea type="text" id="content" name="content" aria-describedby="content-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
            </div>

            <button type="submit"
                class="py-2 font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Simpan
            </button>
    </form>

    @section('bottomAssets')
        <script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
    @endsection
</x-app-layout>
