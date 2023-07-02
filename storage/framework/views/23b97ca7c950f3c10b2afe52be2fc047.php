<?php if(isset($href)): ?>
    <a href="<?php echo e($href); ?>"
        <?php echo e($attributes->merge(['class' => 'px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800'])); ?>><?php echo e($slot); ?></a>
<?php else: ?>
    <button
        <?php echo e($attributes->merge(['type' => 'button', 'class' => 'px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800'])); ?>>
        <?php echo e($slot); ?>

    </button>
    <?php endif; ?>
<?php /**PATH /Users/nurulizzahq/Documents/proweb/proweb/resources/views/components/button/small-danger.blade.php ENDPATH**/ ?>