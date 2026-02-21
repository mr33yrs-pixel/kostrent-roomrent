<input
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
                'type' => 'hidden',
                $applyStateBindingModifiers('wire:model') => $getStatePath(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->class(['fi-fo-hidden'])); ?>

/>
<?php /**PATH D:\apps\scratch_apps\jaikost\room-rental-app\vendor\filament\forms\resources\views\components\hidden.blade.php ENDPATH**/ ?>