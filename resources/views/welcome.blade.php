<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proweb Media</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/welcome.js'])
</head>

<body>
    <x-guest.nav />

    <main id="home" class="relative">
        <section class="bg-blue-100">
            <div class="mx-auto">
                <div class="container px-10 py-24 mx-auto md:py-0 md:max-w-5xl">
                    <div class="flex flex-col items-center justify-center mx-auto md:flex-row">
                        <div class="md:w-2/3">
                            <p class="mb-2 text-sm font-bold text-blue-400">Start your favorite course</p>
                            <h1 class="font-sans text-4xl font-medium leading-none tracking-tight text-slate-800">
                                Selamat Datang di
                                Media Pembelajaran Pemrograman Web
                            </h1>
                            <p class="mt-2 text-sm font-light">Belajar dimana saja dan kapan saja dengan proweb, akses
                                materi secara Gratis!</p>

                            <div class="mt-4">
                                <a href="{{ route('register') }}" type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                                    Daftar Sekarang!
                                </a>
                            </div>
                        </div>
                        <div class="hidden mx-auto md:block">
                            <img class="bottom-0 block w-full mx-auto" src="{{ asset('assets/images/proweb-1.png') }}"
                                alt="Person">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="py-10 mx-auto bg-white">
            <div class="container flex flex-col items-center justify-center max-w-6xl mx-auto gap-x-20 md:flex-row">
                <div>
                    <img class="w-full mb-5 rounded-lg md:mb-0" src="{{ asset('assets/images/proweb-2.jpg') }}"
                        alt="Proweb Media">
                </div>
                <div class="px-5 md:px-0">
                    <h2 class="mb-2 text-2xl font-bold text-slate-800">Apa Saja yang ada di Proweb?</h2>
                    <p class=" font-md md:w-96">Ada banyak materi yang bisa dipelajari di sini. Jadi,
                        luangkan waktu
                        Anda,
                        lihat-lihat
                        dan
                        pelajari semua
                        informasi yang ada untuk menambah pengetahuan terkait pemrograman web.
                    </p>

                    <button x-data @click="document.getElementById('materi').scrollIntoView()"
                        class="inline-flex items-center px-3 py-2 mt-5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Lihat Materi
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <section class="px-5 py-10 mx-auto" id="materi">
            <h3 class="mb-4 text-2xl font-bold text-center">Materi</h3>
            <div class="container max-w-6xl mx-auto owl-carousel owl-theme">
                @foreach ($courses as $course)
                    <div class="flex justify-center item">
                        <div
                            class="max-w-sm transition-shadow bg-white border border-gray-200 rounded-lg shadow max-h-sm hover:shadow-lg dark:bg-gray-800 dark:border-gray-700">
                            <a href="{{ route('learn', $course->slug) }}">
                                <img class="rounded-t-lg"
                                    src="{{ asset('assets/images/thumbnails/' . $course->thumbnail) }}"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <div id="tooltip-default-{{ $course->slug }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    {{ $course->name }}
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <h5 data-tooltip-target="tooltip-default-{{ $course->slug }}"
                                    class="block mb-1 text-lg font-medium tracking-tight text-blue-500 hover:underline">
                                    {{ Str::limit($course->name, 45) }}
                                </h5>

                                <p class="mb-3 text-sm font-normal text-gray-700">
                                    {{ Str::limit($course->description, 40) }}
                                </p>
                                <a href="{{ route('learn', $course->slug) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Pelajari
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
        </section>

        <section id="about-us">
            <div class="container max-w-6xl mx-auto bg-white">
                <div
                    class="items-center max-w-screen-xl gap-16 px-4 py-8 mx-auto lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                    <div class="">
                        <h2 class="mb-4 text-xl font-medium">Tentang Kami</h2>
                        <p class="mb-4">Media Pemrograman Web (Proweb Media) merupakan media pembelajaran berbasis web
                            yang
                            dikembangkan
                            untuk
                            memudahkan mahasiswa dalam mengakses materi serta memudahkan dosen untuk memberikan materi
                            dan tugas
                            pada mata kuliah Pemrograman Web.
                        </p>

                        <p class="mb-4">
                            Media ini dikembangkan sebagai penyelesaian Tugas Akhir Program Studi Pendidikan Teknik
                            Informatika
                            dan
                            Komputer Fakultas Teknik Universitas Negeri Makassar
                        </p>

                        <p class="mb-4">Media Pemrograman Web (Proweb Media) berbasis web dibuat dengan menggunakan
                            bahasa
                            pemrograman web
                            (php,
                            html, css, dan js). Berdasarkan hak aksesnya, Proweb Media dibagi menjadi tiga halaman
                            utama, yaitu
                            halaman
                            untuk mahasiswa, halaman untuk dosen, dan halaman untuk admin.
                        </p>

                        <p>Untuk mengakses halaman tersebut, pengguna harus menggunakan akun masing-masing. Mahasiswa
                            dapat
                            melakukan
                            registrasi secara langsung. Bagi dosen silakan menghubungi admin terkait akun yang akan
                            digunakan.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <img class="w-full rounded-lg" src="{{ asset('assets/images/footer-1.jpeg') }}"
                            alt="office content 1">
                        <img class="w-full mt-4 rounded-lg lg:mt-10" src="{{ asset('assets/images/footer.jpeg') }}"
                            alt="office content 2">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-guest.footer />

</body>

</html>
