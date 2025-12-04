<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href', 'active' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['href', 'active' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
  // Lien de base
  $base = 'relative inline-block py-5 text-white/80 hover:text-white transition';
  // Soulignement actif façon maquette
  $underline = $active
      ? 'after:content-[""] after:absolute after:left-0 after:right-0 after:-bottom-1
         after:h-0.5 after:bg-white after:opacity-100'
      : 'after:content-[""] after:absolute after:left-1/2 after:right-1/2 after:-bottom-1
         after:h-0.5 after:bg-white/70 after:opacity-0
         hover:after:left-0 hover:after:right-0 hover:after:opacity-100 after:transition-all';
?>

<a <?php echo e($attributes->merge(['href' => $href, 'class' => "$base $underline"])); ?>>
  <?php echo e($slot); ?>

</a>
<?php /**PATH C:\laragon\www\space-tourism-all\resources\views/components/nav-link.blade.php ENDPATH**/ ?>