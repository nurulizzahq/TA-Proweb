<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
    aria-controls="sidebar-multi-level-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-black rounded-lg md:hidden hover:bg-blue-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="sidebar-multi-level-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-blue-800 shadow">
        <div class="mb-2">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo-lp.png') }}" alt="Proweb Logo" class="w-36">
            </a>
        </div>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                    <x-heroicon-m-home class="w-6 h-6 text-white" />
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            @hasanyrole('student')
                <li>
                    <a href="{{ route('coursesStudent') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-book-open class="w-6 h-6 text-white" />
                        <span class="ml-3">Materi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('assignments') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-archive-box-arrow-down class="w-6 h-6 text-white" />
                        <span class="ml-3">Kumpul Tugas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('playground') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-pencil-square class="w-6 h-6 text-white" />
                        <span class="ml-3">Playground</span>
                    </a>
                </li>
            @endhasanyrole
            @hasrole('super-admin')
                <li>
                    <a href="{{ route('categories') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-tag class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('courses') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-book-open class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Materi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('multiplechoise') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-list-bullet class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Pilihan Ganda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminReviews') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-chat-bubble-oval-left-ellipsis class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Review</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('registeredLecturer') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-users class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Dosen</span>
                    </a>
                </li>
            @endhasrole

            @hasrole('lecturer')
                <li>
                    <a href="{{ route('lecturerCourse') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-book-open class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Review Materi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('rooms') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-archive-box-arrow-down class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Ruang Tugas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('lecturerCourse.indexReview') }}"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                        <x-heroicon-m-chat-bubble-oval-left-ellipsis class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Review</span>
                    </a>
                </li>
            @endrole
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-slate-500">
                    <x-heroicon-m-user class="w-6 h-6 text-white" />
                    <span class="flex-1 ml-3 whitespace-nowrap">Profile</span>
                </a>
            </li>
            <form action="{{ route('logout') }}" method="post"
                class="items-center block text-white rounded-lg hover:bg-slate-500">
                @csrf
                <li>
                    <button type="submit"
                        class="flex items-center w-full p-2 text-white rounded-lg text-start hover:bg-slate-500">
                        <x-heroicon-m-arrow-left-on-rectangle class="w-6 h-6 text-white" />
                        <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                    </button>
                </li>
            </form>
        </ul>
    </div>
</aside>
