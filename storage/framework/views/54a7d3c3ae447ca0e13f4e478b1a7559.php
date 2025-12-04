
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['links' => [
    ['route' => 'home',               'label' => __('nav.home'),         'num' => '00'],
    ['route' => 'crew',               'label' => __('nav.crew'),         'num' => '01'],
    ['route' => 'destinations.show',  'params' => ['planet' => 'moon'],  'label' => __('nav.destinations'), 'num' => '02'],
    ['route' => 'technology',         'label' => __('nav.technology'),   'num' => '03'],
]]));

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

foreach (array_filter((['links' => [
    ['route' => 'home',               'label' => __('nav.home'),         'num' => '00'],
    ['route' => 'crew',               'label' => __('nav.crew'),         'num' => '01'],
    ['route' => 'destinations.show',  'params' => ['planet' => 'moon'],  'label' => __('nav.destinations'), 'num' => '02'],
    ['route' => 'technology',         'label' => __('nav.technology'),   'num' => '03'],
]]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<header class="w-full fixed top-0 left-0 right-0 z-50 bg-transparent">
  <div class="max-w-7xl mx-auto flex items-center gap-4 px-6 md:px-10 lg:px-16 py-5">

    
    <a href="<?php echo e(route('home')); ?>" class="shrink-0" aria-label="Space Tourism">
      <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo" class="h-10 w-10">
    </a>

    
    <div class="hidden lg:block flex-1 h-px bg-white/25 ml-2"></div>

    
    <nav class="hidden md:block backdrop-blur bg-white/5 border border-white/10 text-white">
      <ul class="flex items-center gap-6 md:gap-8 px-6 md:px-10">
        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $route  = $item['route'];
            $params = $item['params'] ?? [];
            $active = request()->routeIs($route)
                      || (count($params) && url()->current() === route($route, $params));
          ?>
          <li>
            <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route($route, $params),'active' => $active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route($route, $params)),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($active)]); ?>
              <span class="hidden md:inline font-semibold tracking-widest mr-2"><?php echo e($item['num']); ?></span>
              <span class="uppercase tracking-widest"><?php echo e($item['label']); ?></span>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </nav>

    
    <div class="hidden md:flex ml-2">
      <?php $loc = app()->getLocale(); ?>
      <a href="<?php echo e(route('lang.switch','fr')); ?>"
         class="px-2 text-sm <?php echo e($loc==='fr' ? 'underline' : 'opacity-70 hover:opacity-100'); ?>">FR</a>
      <span class="px-1 opacity-50">/</span>
      <a href="<?php echo e(route('lang.switch','en')); ?>"
         class="px-2 text-sm <?php echo e($loc==='en' ? 'underline' : 'opacity-70 hover:opacity-100'); ?>">EN</a>
    </div>

    
    <div class="hidden md:flex ml-2 relative">
      <?php if(auth()->guard()->check()): ?>
        
        <button id="admin-dropdown-btn"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-black bg-white rounded hover:bg-gray-200 transition-colors"
                aria-haspopup="true"
                aria-expanded="false">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          Admin
          <svg class="w-4 h-4 transition-transform" id="admin-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        
        <div id="admin-dropdown-menu"
             class="hidden absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden z-50">
          <a href="<?php echo e(route('dashboard')); ?>"
             class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              <?php echo e(__('Dashboard')); ?>

            </div>
          </a>

          <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
            <?php echo csrf_field(); ?>
            <button type="submit"
                    class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors border-t border-gray-100">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <?php echo e(__('Déconnexion')); ?>

              </div>
            </button>
          </form>
        </div>
      <?php else: ?>
        
        <a href="<?php echo e(route('login')); ?>"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-black bg-white rounded hover:bg-gray-200 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
          </svg>
          <?php echo e(__('Connexion')); ?>

        </a>
      <?php endif; ?>
    </div>

    
    <button id="nav-toggle"
            class="md:hidden ml-auto inline-flex items-center justify-center h-10 w-10 rounded
                   text-white/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40"
            aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mobile-menu">
      <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  
  <div id="mobile-overlay"
       class="md:hidden fixed inset-0 bg-black/60 hidden"></div>

  <nav id="mobile-menu"
       class="md:hidden fixed top-0 right-0 h-full w-72 max-w-[80%]
              backdrop-blur bg-white/5 border-l border-white/10
              transform translate-x-full transition-transform duration-300">
    <div class="flex items-center justify-between px-5 py-4 border-b border-white/10">
      <span class="uppercase tracking-widest text-white/70 text-sm"><?php echo e(config('app.name','Space Tourism')); ?></span>
      <button id="nav-close" class="h-9 w-9 inline-flex items-center justify-center rounded
                                   text-white/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40"
              aria-label="Fermer le menu">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <ul class="flex flex-col gap-1 p-4">
      <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $route  = $item['route'];
          $params = $item['params'] ?? [];
          $active = request()->routeIs($route)
                    || (count($params) && url()->current() === route($route, $params));
        ?>
        <li>
          <a href="<?php echo e(route($route, $params)); ?>"
             class="block px-4 py-3 rounded text-white/90 hover:text-white hover:bg-white/10
                    <?php echo e($active ? 'bg-white/10' : ''); ?>">
            <span class="font-semibold tracking-widest mr-2"><?php echo e($item['num']); ?></span>
            <span class="uppercase tracking-widest"><?php echo e($item['label']); ?></span>
          </a>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      
      <li class="mt-2 border-t border-white/10"></li>
      <li class="flex gap-3 items-center px-4 pt-3">
        <?php $loc = app()->getLocale(); ?>
        <a href="<?php echo e(route('lang.switch','fr')); ?>"
           class="<?php echo e($loc==='fr' ? 'underline' : 'opacity-70 hover:opacity-100'); ?>">FR</a>
        <span class="opacity-50">/</span>
        <a href="<?php echo e(route('lang.switch','en')); ?>"
           class="<?php echo e($loc==='en' ? 'underline' : 'opacity-70 hover:opacity-100'); ?>">EN</a>
      </li>

      
      <li class="mt-2 border-t border-white/10"></li>
      <li class="px-4 pt-3">
        <?php if(auth()->guard()->check()): ?>
          
          <div class="space-y-2">
            <a href="<?php echo e(route('dashboard')); ?>"
               class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-black bg-white rounded hover:bg-gray-200 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              Dashboard
            </a>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit"
                      class="flex items-center gap-2 w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <?php echo e(__('Déconnexion')); ?>

              </button>
            </form>
          </div>
        <?php else: ?>
          
          <a href="<?php echo e(route('login')); ?>"
             class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-black bg-white rounded hover:bg-gray-200 transition-colors w-full justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            <?php echo e(__('Connexion')); ?>

          </a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>
</header>


<script>
  (function () {
    // Menu mobile (burger)
    const toggle = document.getElementById('nav-toggle');
    const closeBtn = document.getElementById('nav-close');
    const menu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-overlay');

    function openMenu() {
      menu.classList.remove('translate-x-full');
      overlay.classList.remove('hidden');
      toggle.setAttribute('aria-expanded', 'true');
      document.body.classList.add('overflow-hidden');
    }

    function closeMenu() {
      menu.classList.add('translate-x-full');
      overlay.classList.add('hidden');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('overflow-hidden');
    }

    toggle && toggle.addEventListener('click', openMenu);
    closeBtn && closeBtn.addEventListener('click', closeMenu);
    overlay && overlay.addEventListener('click', closeMenu);

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMenu();
    });

    // Dropdown Admin (desktop)
    const adminBtn = document.getElementById('admin-dropdown-btn');
    const adminMenu = document.getElementById('admin-dropdown-menu');
    const adminChevron = document.getElementById('admin-chevron');

    if (adminBtn && adminMenu) {
      // Toggle dropdown au clic
      adminBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = !adminMenu.classList.contains('hidden');
        
        if (isOpen) {
          adminMenu.classList.add('hidden');
          adminBtn.setAttribute('aria-expanded', 'false');
          adminChevron.style.transform = 'rotate(0deg)';
        } else {
          adminMenu.classList.remove('hidden');
          adminBtn.setAttribute('aria-expanded', 'true');
          adminChevron.style.transform = 'rotate(180deg)';
        }
      });

      // Fermer au clic extérieur
      document.addEventListener('click', (e) => {
        if (!adminBtn.contains(e.target) && !adminMenu.contains(e.target)) {
          adminMenu.classList.add('hidden');
          adminBtn.setAttribute('aria-expanded', 'false');
          adminChevron.style.transform = 'rotate(0deg)';
        }
      });

      // Fermer à la touche Échap
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !adminMenu.classList.contains('hidden')) {
          adminMenu.classList.add('hidden');
          adminBtn.setAttribute('aria-expanded', 'false');
          adminChevron.style.transform = 'rotate(0deg)';
        }
      });
    }
  })();
</script><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/components/header.blade.php ENDPATH**/ ?>