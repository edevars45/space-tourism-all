<?php $__env->startSection('title', 'Modifier une planète'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Modifier : <?php echo e($planet->name); ?></h1>

    <form method="POST" action="<?php echo e(route('admin.planets.update', $planet)); ?>" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Nom (FR) *</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name', $planet->name)); ?>"
                   class="w-full px-4 py-2 rounded border <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="name_en" class="block text-sm font-medium mb-2">Nom (EN)</label>
            <input type="text" name="name_en" id="name_en" value="<?php echo e(old('name_en', $planet->name_en)); ?>"
                   class="w-full px-4 py-2 rounded border">
            <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="slug" class="block text-sm font-medium mb-2">Slug</label>
            <input type="text" name="slug" id="slug" value="<?php echo e(old('slug', $planet->slug)); ?>"
                   class="w-full px-4 py-2 rounded border">
            <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="description" class="block text-sm font-medium mb-2">Description (FR)</label>
            <textarea name="description" id="description" rows="5"
                      class="w-full px-4 py-2 rounded border"><?php echo e(old('description', $planet->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="description_en" class="block text-sm font-medium mb-2">Description (EN)</label>
            <textarea name="description_en" id="description_en" rows="5"
                      class="w-full px-4 py-2 rounded border"><?php echo e(old('description_en', $planet->description_en)); ?></textarea>
            <?php $__errorArgs = ['description_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="distance" class="block text-sm font-medium mb-2">Distance</label>
            <input type="text" name="distance" id="distance" value="<?php echo e(old('distance', $planet->distance)); ?>"
                   class="w-full px-4 py-2 rounded border" placeholder="384 400 KM">
            <?php $__errorArgs = ['distance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="travel_time" class="block text-sm font-medium mb-2">Temps de trajet</label>
            <input type="text" name="travel_time" id="travel_time" value="<?php echo e(old('travel_time', $planet->travel_time)); ?>"
                   class="w-full px-4 py-2 rounded border" placeholder="3 JOURS">
            <?php $__errorArgs = ['travel_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="order" class="block text-sm font-medium mb-2">Ordre d'affichage</label>
            <input type="number" name="order" id="order" value="<?php echo e(old('order', $planet->order)); ?>"
                   class="w-full px-4 py-2 rounded border" min="0">
            <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="image_upload" class="block text-sm font-medium mb-2">Image</label>
            <input type="file" name="image_upload" id="image_upload" class="w-full px-4 py-2 rounded border" accept="image/*">
            <?php $__errorArgs = ['image_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="flex items-center gap-3">
            <input type="hidden" name="published" value="0">
            <input type="checkbox" name="published" id="published" value="1"
                   <?php echo e(old('published', $planet->is_published) ? 'checked' : ''); ?>

                   class="w-5 h-5">
            <label for="published" class="text-sm font-medium">Publié</label>
        </div>

        
        <div class="flex gap-4">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="<?php echo e(route('admin.planets.index')); ?>" class="btn-outline">Annuler</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/admin/planets/edit.blade.php ENDPATH**/ ?>