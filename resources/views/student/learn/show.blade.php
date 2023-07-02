<x-app-layout>
    <div class="mb-3 text-end">
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
            aria-controls="drawer-navigation">Daftar
            Modul
        </button>
    </div>
    @if (session('message'))
        <x-alert type="warning">
            {{ session('message') }}
        </x-alert>
    @endif
    <section>
        @if ($module->yt_link !== null)
            <section>
                <iframe class="w-full mx-auto mb-4" height="400" src="{{ $module->yt_link }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </section>
        @endif
        <section class="mb-20">
            <h1 class="mb-4 text-2xl font-bold">{{ $module->title }}</h1>

            <div class="p-6 overflow-scroll rounded-md bg-slate-100">
                <div class="unreset">
                    {!! $module->content !!}
                </div>
            </div>
        </section>

        @if (!$nextModule)
            <div
                class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                <div class="grid h-full max-w-lg mx-auto font-medium">
                    <form class="grid" action="{{ route('learn.storeFisnishedCourse', $module->slug) }}"
                        method="post">
                        @csrf
                        <button
                            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                            <x-heroicon-o-arrow-long-right class="w-5 h-5" />
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Selesai
                                🎉</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div
                class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                <div class="grid h-full max-w-lg mx-auto font-medium">
                    <form class="grid" action="{{ route('learn.storeFisnishedModule', $module->slug) }}"
                        method="post">
                        @csrf
                        <button name="nextModule" value="{{ $nextModule->slug }}"
                            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                            <x-heroicon-o-arrow-long-right class="w-5 h-5" />
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">{{ $nextModule->title }}</span>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div id="drawer-navigation"
            class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-navigation-label">
            <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                Modul</h5>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">
                    @foreach ($modules as $module)
                        <li>
                            <a href="{{ route('learn.show', $module->slug) }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                @if (\App\Helpers\CheckLearned::check(auth()->user()->id, $module->id))
                                    <x-heroicon-o-check-circle class="w-5 h-5 stroke-green-500" />
                                @else
                                    <x-icons.circle class="w-5 h-5" />
                                @endif

                                <span class="ml-3">{{ $module->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
</x-app-layout>
