<?php $__env->startSection('topAssets'); ?>
    <style>
        .CodeMirror {
            float: left;
            width: 50%;
            border: 1px solid black;
        }

        iframe {
            width: 49%;
            float: left;
            height: 300px;
            border: 1px solid black;
            border-left: 0px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/lib/codemirror/lib/codemirror.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/lib/codemirror/theme/dracula.css')); ?>">
    <script src="<?php echo e(asset('assets/lib/codemirror/lib/codemirror.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/codemirror/mode/xml/xml.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/codemirror/mode/javascript/javascript.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/codemirror/addon/edit/closetag.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/codemirror/addon/hint/html-hint.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bottomAssets'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/assignment.js'); ?>
<?php $__env->stopSection(); ?>

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="mb-5">
        <h1 class="text-2xl font-bold">Ruangan: <?php echo e($assignment->room->name); ?></h1>
        <p class="text-light text-slate-500">Mantap Betul</p>
    </div>

    <?php if(now() > $assignment->room->closed_at): ?>
        <section class="px-4 py-2 my-2 bg-red-100 rounded">
            <div class="flex flex-col items-center justify-center h-52">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('heroicon-o-clock'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-20 h-20 stroke-red-500']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                <p class="mt-5 text-slate-500">Waktu pengumpulan tugas telah selesai.</p>
            </div>
        </section>
    <?php else: ?>
        <?php if($errors->all()): ?>
            <div class="px-5 py-3 mb-3 bg-red-300 rounded-md">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="flex flex-col">
                        <li class="list-disc">
                            <p class="text-sm font-light"><?php echo e($message); ?></p>
                        </li>
                    </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo e(route('storeAssignment', $assignment->slug)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="flex items-center justify-between mb-5">
                <input id="isAttachmentValue" type="hidden" name="is_attachment" value="0">
                <div>
                    <div class="flex space-x-3">
                        <div>
                            <label for="typeTaskSelect"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                                Tugas</label>
                            <select id="typeTaskSelect" onchange="typeTask(this.value)"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option id="code" value="0">Code</option>
                                <option id="file" value="1">File</option>
                            </select>
                        </div>

                        <div>
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select name="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=0 selected>Draft</option>
                                <option value=1>Kirim</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="isCode" class="-mt-16">
                <div class="flex justify-end mb-5">
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button.small-primary','data' => ['class' => 'block px-5','id' => 'runCodeMirror']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button.small-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'block px-5','id' => 'runCodeMirror']); ?>
                        Run Code
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                </div>
                <div>
                    <textarea class="block" name="content" id="codemirror"></textarea>
                </div>
                <iframe id="preview"></iframe>
            </div>

            <div id="isAttachment" class="hidden mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                    file</label>
                <input name="attachment"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="file_input_help" id="file_input" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help uppercase">Word, Pdf,
                    Excel, Zip, Rar.
                    (Max: 10Mb)
                </p>
            </div>

            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button.small-primary','data' => ['type' => 'submit','class' => 'w-full px-5 mt-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button.small-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'w-full px-5 mt-5']); ?>
                Kirim
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </form>
    <?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/nurulizzahq/Documents/proweb/proweb/resources/views/student/assignments/collect-assignment.blade.php ENDPATH**/ ?>