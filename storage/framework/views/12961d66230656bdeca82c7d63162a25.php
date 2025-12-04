<?php $__env->startSection('title', __('home.title')); ?>


<?php $__env->startSection('meta_description', __('home.description')); ?>
<?php $__env->startSection('og_title', __('home.title')); ?>
<?php $__env->startSection('og_description', __('home.description')); ?>

<?php $__env->startSection('content'); ?>

  
  <section class="relative bg-black text-white overflow-hidden" aria-labelledby="home-hero-heading">

    
    <div class="max-w-7xl mx-auto w-full px-6 md:px-12 lg:px-16 pt-8 md:pt-12 lg:pt-14 pb-10 md:pb-12">

      
      <div class="grid md:grid-cols-2 gap-10 lg:gap-14 items-start">

        
        <div>
          
          <p class="font-barlow-condensed uppercase tracking-[.25em] text-[#D0D6F9] text-xs sm:text-sm md:text-base mb-4 md:mb-5">
            <?php echo e(__('home.intro')); ?>

          </p>

          
          <h1 id="home-hero-heading" class="font-bellefair uppercase leading-none
                     text-[50px] sm:text-[64px] md:text-[92px] lg:text-[120px] xl:text-[150px]
                     mb-4 md:mb-5">
            <span class="sr-only">L’ESPACE</span>
            <?php echo e(__('home.space')); ?>

          </h1>

          
          <p class="font-barlow text-gray-300 text-[15px] md:text-base leading-relaxed max-w-xl">
            <?php echo e(__('home.description')); ?>

          </p>
        </div>

        
        <div class="flex justify-center md:justify-end items-start md:items-center">
          <div class="relative group">

            
            <span class="hidden md:block absolute inset-0 rounded-full transform scale-90 opacity-0
                         transition-all duration-500 ease-out
                         group-hover:scale-125 group-hover:opacity-20 bg-white/10"></span>

            
            <a href="<?php echo e(url('/destinations/moon')); ?>"
               class="relative inline-flex items-center justify-center
                      w-32 h-32 sm:w-40 sm:h-40 md:w-52 md:h-52
                      rounded-full bg-white text-black
                      font-bellefair uppercase tracking-widest
                      text-sm sm:text-base md:text-lg
                      transition-transform duration-300 hover:scale-105
                      focus:outline-none focus:ring-4 focus:ring-white/20"
               aria-label="<?php echo e(__('home.explore')); ?>">
              <span class="pointer-events-none"><?php echo e(__('home.explore')); ?></span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/pages/home.blade.php ENDPATH**/ ?>