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

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js', 'resources/js/welcome.js']); ?>
</head>

<body>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.nav','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest.nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

    <main id="home" class="relative pt-20">
        <section
            class="bg-white dark:bg-gray-900 bg-[url('https://cdn.pixabay.com/photo/2015/06/24/15/45/code-820275_960_720.jpg')] bg-no-repeat bg-cover">
            <div class="px-4 py-32 mx-auto text-center md:py-52 bg-black/70">
                <h1
                    class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-white drop-shadow-md md:text-5xl lg:text-6xl dark:text-white">
                    Selamat Datang di
                    Media Pembelajaran Pemrograman Web</h1>
            </div>
        </section>


        <section class="px-20 py-10 bg-white">
            <h2 class="mb-2 text-2xl font-bold text-slate-800">Apa Saja yang ada di Proweb?</h2>
            <p class="font-md md:w-96">Ada banyak materi yang bisa dipelajari di sini. Jadi, luangkan waktu Anda,
                lihat-lihat
                dan
                pelajari semua
                informasi yang ada untuk menambah pengetahuan terkait pemrograman web.
            </p>

            <button x-data @click="document.getElementById('materi').scrollIntoView()"
                class="inline-flex items-center px-3 py-2 mt-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Lihat Materi
                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </section>

        <section class="px-5 py-10 mx-auto" id="materi">
            <h3 class="mb-4 text-2xl font-bold text-center">Materi</h3>
            <div class="owl-carousel owl-theme">
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg"
                                    src="<?php echo e(asset('assets/images/thumbnails/' . $course->thumbnail)); ?>"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        <?php echo e($course->name); ?>

                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <?php echo e(Str::limit($course->description, 60)); ?>

                                </p>
                                <a href="<?php echo e(route('learn', $course->slug)); ?>"
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <section id="about-us" class="px-5 py-10 mx-auto">
            <h3 class="mb-4 text-2xl font-bold text-center">About Us</h3>
            <div class="space-y-5">
                <p>Media Pemrograman Web (Proweb Media) merupakan media pembelajaran berbasis web yang dikembangkan
                    untuk
                    memudahkan mahasiswa dalam mengakses materi serta memudahkan dosen untuk memberikan materi dan tugas
                    pada mata kuliah Pemrograman Web.
                </p>

                <p>
                    Media ini dikembangkan sebagai penyelesaian Tugas Akhir Program Studi Pendidikan Teknik Informatika
                    dan
                    Komputer Fakultas Teknik Universitas Negeri Makassar
                </p>

                <p>Media Pemrograman Web (Proweb Media) berbasis web dibuat dengan menggunakan bahasa pemrograman web
                    (php,
                    html, css, dan js). Berdasarkan hak aksesnya, Proweb Media dibagi menjadi tiga halaman utama, yaitu
                    halaman
                    untuk mahasiswa, halaman untuk dosen, dan halaman untuk admin.
                </p>

                <p>Untuk mengakses halaman tersebut, pengguna harus menggunakan akun masing-masing. Mahasiswa dapat
                    melakukan
                    registrasi secara langsung. Bagi dosen silakan menghubungi admin terkait akun yang akan digunakan.
                </p>
            </div>
        </section>
    </main>

    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

</body>

</html>
<?php /**PATH /Users/nurulizzahq/Documents/proweb/proweb/resources/views/welcome.blade.php ENDPATH**/ ?>