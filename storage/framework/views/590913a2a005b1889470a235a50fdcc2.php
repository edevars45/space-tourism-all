


<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title>
        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
            <?php echo $__env->yieldContent('title'); ?> — <?php echo e(config('app.name', 'Space Tourism')); ?>

        <?php else: ?>
            <?php echo e(config('app.name', 'Space Tourism')); ?>

        <?php endif; ?>
    </title>

    
    
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', __('home.description')); ?>">
    
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e(config('app.name', 'Space Tourism')); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', trim($__env->yieldContent('title')) ?: config('app.name')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', __('home.description')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    
    <meta property="og:image" content="<?php echo e(asset('images/og-default.jpg')); ?>">

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=barlow:400,500,600|bellefair:400|barlow-condensed:400,500&display=swap"
        rel="stylesheet" />

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body class="font-sans antialiased bg-black text-white">
    <div class="min-h-screen flex flex-col">

        
        <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

        
        <main class="flex-grow pt-20 md:pt-24">
            <?php echo $__env->yieldContent('content'); ?>
            
            <?php echo e($slot ?? ''); ?>

        </main>

        
        <footer class="bg-gray-900 text-gray-400 text-center py-6 text-sm">
            © <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Space Tourism')); ?> | Projet Laravel Breeze
        </footer>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\space-tourism-all\resources\views/layouts/app.blade.php ENDPATH**/ ?>