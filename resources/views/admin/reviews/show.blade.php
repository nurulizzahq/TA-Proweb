<x-app-layout>
    <section class="mb-5">
        <h1 class="text-2xl font-bold">Beri Masukan</h1>
    </section>
    @if ($errors->all())
        <div class="px-5 py-3 bg-red-300 rounded-md">
            @foreach ($errors->all() as $message)
                <ul class="flex flex-col">
                    <li class="list-disc">
                        <p class="text-sm font-light">{{ $message }}</p>
                    </li>
                </ul>
            @endforeach
        </div>
    @endif
    <form action="{{ route('adminReviews.update', $review->id) }}" method="post">
        @csrf<div class="mb-4">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah
                Status</label>
            <select id="status" name="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option {{ $review->status == 'Pending' ? 'selected=true' : '' }} value="Pending">Pending</option>
                <option {{ $review->status == 'Process' ? 'selected=true' : '' }} value="Process">Process</option>
                <option {{ $review->status == 'Approve' ? 'selected=true' : '' }} value="Approve">Approve</option>
            </select>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Kelas</label>
                <input value="{{ $review->course->name }}" disabled type="text" id="name" name="name"
                    class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Belajar Fundamental Javascript" required>
            </div>

            <div>
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unik
                    Slug:</label>
                <input value="{{ $review->course->slug }}" disabled type="text" id="slug" name="slug"
                    class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Belajar Fundamental Javascript" required>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saran:</label>
            <div class="p-3 border rounded shadow">
                <div class="unreset">
                    {!! $review->content !!}
                </div>
            </div>
        </div>
        <button type="submit"
            class="text-white mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah
            Status</button>
    </form>

    @section('bottomAssets')
        <script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
    @endsection

</x-app-layout>
