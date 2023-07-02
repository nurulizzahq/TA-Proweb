<x-app-layout>
    <div class="mb-5">
        <h1 class="text-2xl font-bold">Latihan Soal: {{ $courseWithExam->name }}</h1>
    </div>
    <div>
        @if (session('message'))
            <x-alert type="success">
                {{ session('message') }}
            </x-alert>
        @endif
    </div>

    <div class="flex flex-col">
        <form action="{{ route('exam.submit', $courseWithExam->slug) }}" method="post">
            @csrf
            <div class="space-y-3">
                @foreach ($courseWithExam->exam[0]->multipleChoise as $key => $exam)
                    <div class="p-6 border rounded shadow-sm">
                        <p class="mb-3"><span>{{ ++$key }}</span> {{ $exam->question }}</p>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                <input required id="option1_{{ $exam->id }}" type="radio"
                                    value="{{ $exam->option1 }}" name="answers[{{ $exam->id }}]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="option1_{{ $exam->id }}"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $exam->option1 }}</label>
                            </div>
                            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                <input required id="option2_{{ $exam->id }}" type="radio"
                                    value="{{ $exam->option2 }}" name="answers[{{ $exam->id }}]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="option2_{{ $exam->id }}"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $exam->option2 }}</label>
                            </div>
                            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                <input required id="option3_{{ $exam->id }}" type="radio"
                                    value="{{ $exam->option3 }}" name="answers[{{ $exam->id }}]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="option3_{{ $exam->id }}"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $exam->option3 }}</label>
                            </div>
                            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                <input required id="option4_{{ $exam->id }}" type="radio"
                                    value="{{ $exam->option4 }}" name="answers[{{ $exam->id }}]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="option4_{{ $exam->id }}"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $exam->option4 }}</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-button.small-primary type="submit" class="w-full mt-5">Submit</x-button.small-primary>
        </form>
    </div>
</x-app-layout>
