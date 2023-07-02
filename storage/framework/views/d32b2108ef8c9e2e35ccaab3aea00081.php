<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="mb-5">
        <h1 class="text-2xl font-bold">Beri Masukan</h1>
    </section>
    <?php if($errors->all()): ?>
        <div class="px-5 py-3 bg-red-300 rounded-md">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="flex flex-col">
                    <li class="list-disc">
                        <p class="text-sm font-light"><?php echo e($message); ?></p>
                    </li>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('adminReviews.update', $review->id)); ?>" method="post">
        <?php echo csrf_field(); ?><div class="mb-4">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah
                Status</label>
            <select id="status" name="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option <?php echo e($review->status == 'Pending' ? 'selected=true' : ''); ?> value="Pending">Pending</option>
                <option <?php echo e($review->status == 'Process' ? 'selected=true' : ''); ?> value="Process">Proccess</option>
                <option <?php echo e($review->status == 'Approve' ? 'selected=true' : ''); ?> value="Approve">Approve</option>
                <option <?php echo e($review->status == 'Rejected' ? 'selected=true' : ''); ?> value="Rejected">Reject</option>
            </select>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Kelas</label>
                <input value="<?php echo e($review->course->name); ?>" disabled type="text" id="name" name="name"
                    class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Belajar Fundamental Javascript" required>
            </div>

            <div>
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unik
                    Slug:</label>
                <input value="<?php echo e($review->course->slug); ?>" disabled type="text" id="slug" name="slug"
                    class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Belajar Fundamental Javascript" required>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saran:</label>
            <div class="p-3 border rounded shadow">
                <div class="unreset">
                    <?php echo $review->content; ?>

                </div>
            </div>
        </div>
        <button type="submit"
            class="text-white mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah
            Status</button>
    </form>

    <?php $__env->startSection('bottomAssets'); ?>
        <script src="<?php echo e(asset('assets/lib/tinymce/tinymce.min.js')); ?>"></script>
    <?php $__env->stopSection(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/nurulizzahq/Documents/proweb/proweb/resources/views/admin/reviews/show.blade.php ENDPATH**/ ?>