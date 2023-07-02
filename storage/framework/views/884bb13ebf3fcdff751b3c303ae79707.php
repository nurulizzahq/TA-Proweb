<?php if(isset($href)): ?>
    <a href="<?php echo e($href); ?>"
        <?php echo e($attributes->merge(['class' => 'px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'])); ?>><?php echo e($slot); ?></a>
<?php else: ?>
    <button
        <?php echo e($attributes->merge(['type' => 'button', 'class' => 'px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'])); ?>>
        <?php echo e($slot); ?>

    </button>
    <?php endif; ?>
<?php /**PATH /Users/nurulizzahq/Documents/proweb/proweb/resources/views/components/button/small-primary.blade.php ENDPATH**/ ?>