<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h1 class="mb-2 text-lg font-bold">Harap isi sesuai urutan!</h1>
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
    <form x-data="{ answer: null }" method="post" action="<?php echo e(route('multiplechoise.storeQuestion', $class->id)); ?>">
        <?php echo csrf_field(); ?>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="question"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan</label>
                <input type="text" id="question"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Kepanjangan HTML Adalah?" name="question" required>
            </div>
            <div>
                <label for="option1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi
                    A</label>
                <input type="text" id="option1"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="option1" required>
            </div>
            <div>
                <label for="option2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi
                    B</label>
                <input type="text" id="option2"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="option2" required>
            </div>
            <div>
                <label for="option3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi
                    C</label>
                <input type="text" id="option3"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="option3" required>
            </div>
            <div>
                <label for="option4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi
                    D</label>
                <input type="text" id="option4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="option4" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                <select required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Pilih Jawaban</option>
                    <option @click="answer = document.getElementById('option1').value">A</option>
                    <option @click="answer = document.getElementById('option2').value">B</option>
                    <option @click="answer = document.getElementById('option3').value">C</option>
                    <option @click="answer = document.getElementById('option4').value">D</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <input  x-model="answer" type="text" id="answer"
                class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="answer" required>
            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Jika jawaban tidak
                sesuai, silahkan klik ulang Opsi "Jawaban".</p>
        </div>
        <input id="answer" type="hidden" name="answer" x-model="answer">
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
    </form>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/nurulizzahq/Documents/proweb/proweb/resources/views/admin/multiplechoise/create-question.blade.php ENDPATH**/ ?>