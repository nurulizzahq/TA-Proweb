<x-app-layout>
    <div class="mb-5">
        <h1 class="text-2xl font-bold">Hasil Latihan Soal: {{ $data->name }}</h1>
        {{-- <p class="text-light text-slate-500">Semoga aktivitas belajarmu menyenangkan.</p> --}}
    </div>
    <div>
        @if (session('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
    </div>
    <section class="px-4 py-2 my-2 rounded bg-slate-100">
        <div class="flex flex-col items-center justify-center h-52">
            <p class="text-2xl font-medium ">Nilai Kamu:</p>
            @if ($data->score <= 50)
                <div class="p-3 my-2 bg-red-500 rounded-lg">
                    <p class="text-4xl font-bold">{{ $data->score }}</p>
                </div>
                <p class="font-normal">Silakan pelajari materi dengan baik dan tingkatkan di materi selanjutnya.</p>
            @elseif ($data->score <= 70)
                <div class="p-3 my-2 bg-yellow-300 rounded-lg">
                    <p class="text-4xl font-bold">{{ $data->score }}</p>
                </div>
                <p class="font-normal">Kamu sudah berusaha dengan baik, tingkatkan lagi.</p>
            @else
                <div class="p-3 my-2 bg-green-400 rounded-lg">
                    <p class="text-4xl font-bold">{{ $data->score }}</p>
                </div>
                <p class="font-normal">Selamat kamu sudah menguasai materi dengan baik.</p>
            @endif
        </div>
    </section>

    </div>
</x-app-layout>
