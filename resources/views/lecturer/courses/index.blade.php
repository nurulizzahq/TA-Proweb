<x-app-layout>
    <section class="mb-5 ">
        <h1 class="text-xl font-bold">Review Kelas Proweb</h1>
        <p class="text-slate-500">Kami sangat mengapresiasi setiap masukan yang anda berikan.</p>
    </section>
    <section>
        <div class="grid grid-cols-1 gap-3 lg:grid-cols-2 ">
            @foreach ($courses as $course)
                <div
                    class="mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('lecturerCourse', $course->slug) }}">
                        <img class="w-full rounded-t-lg"
                            src="{{ asset('assets/images/thumbnails/' . $course->thumbnail) }}" />
                    </a>
                    <div class="flex items-center justify-between px-5 mt-3">
                        <div class="flex flex-row">
                            <x-heroicon-o-book-open class="w-5 h-5 mr-2 text-slate-500" />
                            <span class="text-sm font-light text-slate-500">{{ $course->module->count() }}
                                Modul</span>
                        </div>
                        <div class="flex flex-row">
                            <x-heroicon-o-tag class="w-5 h-5 mr-2 text-slate-500" />
                            <span class="text-sm font-light text-slate-500">{{ $course->category->name }}</span>
                        </div>
                    </div>
                    <div class="px-5 mt-1 mb-5">
                        <a href="{{ route('lecturerCourse', $course->slug) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $course->name }}
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ Str::limit($course->description, 100, '...') }}</p>
                        <div class="flex justify-between">
                            <a href="{{ route('lecturerCourse.review', $course->slug) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Review
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="{{ route('lecturerCourse.sendReview', $course->slug) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Beri Masukan
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mx-0 mt-5 lg:mx-5">
            {{ $courses->links() }}
        </div>
    </section>
</x-app-layout>
