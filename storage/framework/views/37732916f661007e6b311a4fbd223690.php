<?php
    /** @var \Illuminate\Support\Collection|\App\Models\Technology[] $technologies */
    /** @var \App\Models\Technology|null $currentTechnology */

    // Je récupère la langue courante (fr ou en)
    $locale = app()->getLocale();

    // Je prépare des variables simples pour la techno active
    $title = '';
    $description = '';
    $nameEn = '';
    $imageUrl = null;

    if ($currentTechnology) {
        // Je prends toujours le nom FR et EN séparément
        $nameFr = $currentTechnology->name;
        $nameEn = $currentTechnology->name_en ?: $currentTechnology->name;

        // Je choisis quoi afficher en fonction de la langue du site
        if ($locale === 'fr') {
            // En français j'affiche le nom FR + la description FR
            $title = $nameFr;
            $description = $currentTechnology->description;
        } else {
            // En anglais j'affiche en priorité les colonnes EN
            $title = $nameEn;
            $description = $currentTechnology->description_en ?: $currentTechnology->description;
        }

        // Je prépare l'URL de l'image : d'abord ce qui vient de la BDD
        if ($currentTechnology->image_path) {
            // image_path contient par exemple "technologies/launch-vehicle.jpg"
            $imageUrl = asset('storage/' . $currentTechnology->image_path);
        } else {
            // Si jamais image_path est vide, je mets une image de secours
            $imageUrl = asset('images/technology/launch-vehicle.jpg');
        }
    }
?>


<?php $__env->startSection('title', __('technology.title')); ?>

<?php $__env->startSection('content'); ?>
<section class="relative min-h-screen text-white overflow-hidden">

    
    <img
        src="<?php echo e(asset('images/technology/background-stars.jpg')); ?>"
        alt=""
        class="absolute inset-0 w-full h-full object-cover -z-10"
    >
    <div class="absolute inset-0 bg-black/50 -z-10"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 py-16 md:py-24 lg:flex lg:items-center lg:gap-16">

        
        <div class="flex-1">

            
            <h1 class="font-barlow-condensed uppercase tracking-[0.25em] text-[#D0D6F9] text-sm md:text-base mb-10">
                <span class="font-bold text-white/70 mr-3">03</span>
                <?php echo e(__('technology.heading')); ?>

            </h1>

            
            <div class="flex gap-4 mb-10" aria-label="<?php echo e(__('technology.heading')); ?>">
                <?php $__currentLoopData = $technologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Je vérifie si ce bouton correspond à la techno active
                        $isActive = $currentTechnology && $tech->id === $currentTechnology->id;
                    ?>
                    <a
                        href="<?php echo e(route('technology', ['slug' => $tech->slug])); ?>"
                        class="w-10 h-10 rounded-full border flex items-center justify-center text-sm
                               <?php echo e($isActive ? 'bg-white text-black border-white' : 'border-white/40 text-white hover:bg-white/20'); ?>"
                        aria-current="<?php echo e($isActive ? 'page' : 'false'); ?>"
                    >
                        <?php echo e($index + 1); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <p class="font-barlow-condensed uppercase tracking-[0.25em] text-sm text-[#D0D6F9] mb-4">
                <?php echo e(__('technology.terminology')); ?>

            </p>

            
            <h2 class="font-bellefair text-4xl md:text-5xl lg:text-6xl uppercase mb-6">
                <?php echo e($title); ?>

            </h2>

            
            <p class="font-barlow text-[15px] md:text-base leading-relaxed text-[#D0D6F9] max-w-xl">
                <?php echo e($description); ?>

            </p>
        </div>

        
        <div class="flex-1 flex flex-col items-center lg:items-end mt-12 lg:mt-0">

            
            <?php if($currentTechnology): ?>
                <p class="font-barlow-condensed uppercase tracking-[0.25em] text-xs text-[#D0D6F9] mb-6">
                    <?php echo e($nameEn); ?>

                </p>
            <?php endif; ?>

            
            <?php if($imageUrl): ?>
                <img
                    src="<?php echo e($imageUrl); ?>"
                    alt="<?php echo e($title); ?>"
                    class="w-72 md:w-80 lg:w-[420px] object-contain"
                >
            <?php endif; ?>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/pages/technology.blade.php ENDPATH**/ ?>