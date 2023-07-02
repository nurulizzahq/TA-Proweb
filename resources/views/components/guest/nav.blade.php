<header class="">
    <nav class="top-0 left-0 z-20 w-full border-b border-black bg-zinc-900 dark:bg-gray-900 dark:border-gray-600">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <a href="{{ route('landingpage') }}">
                <img src="{{ asset('assets/images/logo-lp.png') }}" alt="Logo Landing Page" class="w-28 md:w-32">
            </a>
            <div class="flex md:order-2">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 mr-2 text-sm font-medium text-white bg-blue-700 rounded-lg md:px-5 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign
                        In
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-3 py-2 mr-2 text-sm font-medium text-white bg-gray-800 rounded-lg md:px-5 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Sign
                        Up</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 mr-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Dashboard</a>
                @endauth
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div x-data class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-black rounded-lg md:p-0 bg-zinc-900 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-zinc-900 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <button @click="document.getElementById('home').scrollIntoView()"
                            class="block py-2 pl-3 pr-4 mx-auto text-white rounded md:bg-transparent md:p-0"
                            aria-current="page">Home</button>
                    </li>
                    <li>
                        <button @click="document.getElementById('about-us').scrollIntoView()"
                            class="block py-2 pl-3 pr-4 mx-auto text-white rounded md:bg-transparent md:p-0"
                            aria-current="page">Tentang Kami</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
