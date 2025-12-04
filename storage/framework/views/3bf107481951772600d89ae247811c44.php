
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title','Back-office'); ?> — <?php echo e(config('app.name','Space Tourism')); ?></title>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

  <style>
    /* Lisibilité des champs dans le thème sombre du BO */
    .admin-scope input,
    .admin-scope textarea,
    .admin-scope select {
      background:#fff !important;
      color:#111 !important;
      border-color:#37415133 !important;
      -webkit-text-fill-color:#111 !important;
      caret-color:#111 !important;
    }
    .admin-scope input::placeholder,
    .admin-scope textarea::placeholder { color:#6b7280 !important; opacity:1; }
    .admin-scope input:focus,
    .admin-scope textarea:focus,
    .admin-scope select:focus {
      outline: none !important;
      box-shadow: 0 0 0 2px #93c5fd33, 0 0 0 1px #60a5fa !important;
    }
    .admin-scope input:-webkit-autofill,
    .admin-scope textarea:-webkit-autofill,
    .admin-scope select:-webkit-autofill {
      box-shadow: 0 0 0 1000px #fff inset !important;
      -webkit-text-fill-color:#111 !important;
    }
  </style>
</head>

<body class="antialiased bg-black text-white admin-scope">
<a href="#admin-main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:bg-white focus:text-black focus:p-2 focus:rounded">Aller au contenu</a>

<?php
  $baseLink = 'text-white/80 hover:text-[#D0D6F9]';
  $active   = 'text-[#D0D6F9]';
  $isActive = fn(string $pat) => request()->routeIs($pat) ? $active : '';
?>

<div class="min-h-screen flex flex-col">
  <header class="sticky top-0 z-40 bg-black/90 backdrop-blur border-b border-white/10">
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 md:px-10 py-3">
      <div class="flex items-center justify-between gap-4">
        <a href="<?php echo e(route('dashboard')); ?>" class="font-semibold tracking-wide">Back-office</a>

        <!-- Bouton burger (mobile) -->
        <button id="admin-menu-btn"
                class="inline-flex items-center justify-center rounded md:hidden p-2 text-white/80 hover:text-[#D0D6F9] focus:outline-none focus:ring"
                aria-controls="admin-menu" aria-expanded="false">
          <span class="sr-only">Ouvrir le menu</span>
          <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>

        <!-- Nav desktop -->
        <nav id="admin-menu-desktop" class="hidden md:flex items-center gap-6 text-sm">
          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrateur')): ?>
            <a href="<?php echo e(route('admin.users.index')); ?>"
               class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.users.*')); ?>"
               <?php if(request()->routeIs('admin.users.*')): ?> aria-current="page" <?php endif; ?>>
              Utilisateurs
            </a>
          <?php endif; ?>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('technologies.manage')): ?>
            <a href="<?php echo e(route('admin.technologies.index')); ?>"
               class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.technologies.*')); ?>"
               <?php if(request()->routeIs('admin.technologies.*')): ?> aria-current="page" <?php endif; ?>>
              Technologies
            </a>
          <?php endif; ?>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('planets.manage')): ?>
            <a href="<?php echo e(route('admin.planets.index')); ?>"
               class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.planets.*')); ?>"
               <?php if(request()->routeIs('admin.planets.*')): ?> aria-current="page" <?php endif; ?>>
              Planètes
            </a>
          <?php endif; ?>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crew.manage')): ?>
            <a href="<?php echo e(route('admin.crew.index')); ?>"
               class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.crew.*')); ?>"
               <?php if(request()->routeIs('admin.crew.*')): ?> aria-current="page" <?php endif; ?>>
              Équipage
            </a>
          <?php endif; ?>

          <span class="text-white/40 select-none">|</span>
          <a class="<?php echo e($baseLink); ?>" href="<?php echo e(route('lang.switch','fr')); ?>">FR</a>
          <span class="text-white/40 select-none">/</span>
          <a class="<?php echo e($baseLink); ?>" href="<?php echo e(route('lang.switch','en')); ?>">EN</a>

          <?php if(auth()->guard()->check()): ?>
            <!-- Logout en POST (évite l'erreur 405) -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
              <?php echo csrf_field(); ?>
              <button type="submit" class="ml-2 hover:text-[#D0D6F9]">Déconnexion</button>
            </form>
          <?php endif; ?>
        </nav>
      </div>

      <!-- Nav mobile (fermée par défaut : PAS de 'flex' au départ) -->
      <nav id="admin-menu"
           class="hidden md:hidden mt-3 flex-col gap-3 border-t border-white/10 pt-3 text-sm">
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrateur')): ?>
          <a href="<?php echo e(route('admin.users.index')); ?>"
             class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.users.*')); ?>"
             <?php if(request()->routeIs('admin.users.*')): ?> aria-current="page" <?php endif; ?>>
            Utilisateurs
          </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('technologies.manage')): ?>
          <a href="<?php echo e(route('admin.technologies.index')); ?>"
             class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.technologies.*')); ?>"
             <?php if(request()->routeIs('admin.technologies.*')): ?> aria-current="page" <?php endif; ?>>
            Technologies
          </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('planets.manage')): ?>
          <a href="<?php echo e(route('admin.planets.index')); ?>"
             class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.planets.*')); ?>"
             <?php if(request()->routeIs('admin.planets.*')): ?> aria-current="page" <?php endif; ?>>
            Planètes
          </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crew.manage')): ?>
          <a href="<?php echo e(route('admin.crew.index')); ?>"
             class="<?php echo e($baseLink); ?> <?php echo e($isActive('admin.crew.*')); ?>"
             <?php if(request()->routeIs('admin.crew.*')): ?> aria-current="page" <?php endif; ?>>
            Équipage
          </a>
        <?php endif; ?>

        <div class="items-center gap-2">
          <a class="<?php echo e($baseLink); ?>" href="<?php echo e(route('lang.switch','fr')); ?>">FR</a>
          <span class="text-white/40 select-none">/</span>
          <a class="<?php echo e($baseLink); ?>" href="<?php echo e(route('lang.switch','en')); ?>">EN</a>
        </div>

        <?php if(auth()->guard()->check()): ?>
          <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="hover:text-[#D0D6F9]">Déconnexion</button>
          </form>
        <?php endif; ?>
      </nav>
    </div>

    <script>
      // Toggle accessible du menu mobile : on bascule 'hidden' et 'flex'
      (function () {
        const btn  = document.getElementById('admin-menu-btn');
        const menu = document.getElementById('admin-menu');
        if (!btn || !menu) return;

        // État initial: fermé
        menu.classList.add('hidden');
        menu.classList.remove('flex');

        btn.addEventListener('click', () => {
          const isHidden = menu.classList.contains('hidden'); // fermé ?
          menu.classList.toggle('hidden', !isHidden); // ouvrir => enlever hidden
          menu.classList.toggle('flex',    isHidden); // ouvrir => ajouter flex
          btn.setAttribute('aria-expanded', String(isHidden));
        });
      })();
    </script>
  </header>

  <main id="admin-main" class="flex-1">
    <div class="max-w-7xl mx-auto w-full px-6 md:px-10 py-6">
      <?php if(session('success')): ?>
        <div class="mb-4 rounded-lg bg-green-600/15 border border-green-600/30 text-green-200 px-4 py-3">
          <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>
      <?php if(session('error')): ?>
        <div class="mb-4 rounded-lg bg-red-600/15 border border-red-600/30 text-red-200 px-4 py-3">
          <?php echo e(session('error')); ?>

        </div>
      <?php endif; ?>
      <?php if($errors->any()): ?>
        <div class="mb-4 rounded-lg bg-yellow-600/15 border border-yellow-600/30 text-yellow-100 px-4 py-3">
          <p class="font-medium mb-2">Erreurs de validation :</p>
          <ul class="list-disc list-inside space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php echo $__env->yieldContent('content'); ?>
      <?php echo e($slot ?? ''); ?>

    </div>
  </main>

  <footer class="bg-gray-900 text-gray-400 text-center py-6 text-sm">
    © <?php echo e(date('Y')); ?> <?php echo e(config('app.name','Space Tourism')); ?> — Back-office
  </footer>
</div>

<script>
  // Ferme un éventuel menu mobile global d'un autre layout
  (function(){
    const overlay = document.getElementById('mobile-overlay');
    const menu = document.getElementById('mobile-menu');
    overlay && overlay.classList.add('hidden');
    menu && menu.classList.add('translate-x-full');
  })();
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\space-tourism-all\resources\views/layouts/admin.blade.php ENDPATH**/ ?>