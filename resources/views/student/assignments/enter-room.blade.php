<x-app-layout>
    <div class="mb-5">
        <h1 class="text-2xl font-bold">Masuk Ruangan: {{ $room->name }}</h1>
        <p class="text-light text-slate-500">Harap minta link Ruang Tugas pada dosen kamu.</p>
    </div>

    <div class="mx-auto my-10 w-80">
        @if (session()->has('message'))
            <div>
                <x-alert type="danger">
                    {{ session('message') }}
                </x-alert>
            </div>
        @endif
        <form action="{{ route('enteredRoom', $room->slug) }}" method="post">
            @csrf
            <div class="flex flex-col items-center justify-center mb-6">
                <label for="pass_code" class="block text-sm font-medium text-gray-900 dark:text-white">Masukkan
                    PIN</label>
                <p id="helper-text-explanation" class="text-sm text-gray-500 dark:text-gray-400">Pin didapatkan dari
                    dosen.</p>
                <input name="pass_code" type="password" id="pass_code" placeholder="xxxx"
                    class="mt-2 bg-gray-50 border text-center border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <x-button.small-primary type="submit" class="w-full -mt-5">Masuk</x-button.small-primary>
        </form>
    </div>


</x-app-layout>
