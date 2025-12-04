<?php $__env->startSection('title', __('destinations.title')); ?>

<?php $__env->startSection('content'); ?>
<section class="relative min-h-screen text-white overflow-hidden">

  
  <img src="<?php echo e(asset('images/destinations/background.jpg')); ?>" alt=""
       class="absolute inset-0 w-full h-full object-cover -z-10">
  <div class="absolute inset-0 bg-black/45 -z-10"></div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 py-16 md:py-24">

    
    <h1 class="font-barlow-condensed uppercase tracking-[0.25em] text-[#D0D6F9] text-sm md:text-base mb-12">
      <span class="font-bold text-white/70 mr-3">01</span> <?php echo e(__('destinations.heading')); ?>

    </h1>

    <div class="grid md:grid-cols-2 gap-12 items-center">

      
      <div class="flex justify-center md:justify-start transition-all duration-700 ease-in-out">
        
        <img id="planet-image"
             src="<?php echo e(asset('images/destinations/'.$planet.'.png')); ?>"
             alt="<?php echo e($data['name'] ?? ucfirst($planet)); ?>"
             class="w-56 md:w-72 lg:w-96 object-contain transition-all duration-700 ease-in-out transform">
      </div>

      
      <div class="text-center md:text-left">

        
        <?php
          // Ordre d’affichage souhaité
          $order = ['moon','mars','europa','titan'];
        ?>

        <div class="flex justify-center md:justify-start gap-8 mb-8"
             role="tablist" aria-label="<?php echo e(__('destinations.title')); ?>">
          <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $isActive = $slug === $planet;
              $baseBtn  = 'planet-btn uppercase tracking-widest text-sm md:text-base pb-2 border-b-2 transition-colors';
              $active   = $isActive
                          ? 'border-white text-white'
                          : 'border-transparent text-[#D0D6F9] hover:text-white';
            ?>
            <button
              type="button"
              class="<?php echo e($baseBtn); ?> <?php echo e($active); ?>"
              data-planet="<?php echo e($slug); ?>"
              role="tab"
              aria-selected="<?php echo e($isActive ? 'true' : 'false'); ?>"
              aria-controls="dest-panel"
            >
              <?php echo e($planets[$slug]['name'] ?? ucfirst($slug)); ?>

            </button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <h2 id="planet-name"
            class="font-bellefair uppercase text-6xl md:text-7xl mb-6 transition-all duration-700">
          <?php echo e($data['name'] ?? ucfirst($planet)); ?>

        </h2>

        
        <p id="planet-desc"
           class="font-barlow text-[#D0D6F9] text-[15px] md:text-base leading-relaxed max-w-md mx-auto md:mx-0 mb-10 transition-all duration-700">
          <?php echo e($data['desc'] ?? ''); ?>

        </p>

        <hr class="border-gray-600 my-8 w-3/4 md:w-full mx-auto md:mx-0">

        
        <div id="dest-panel"
             class="flex flex-col md:flex-row justify-center md:justify-start gap-10 text-center md:text-left uppercase font-barlow-condensed text-[#D0D6F9] tracking-widest text-sm">
          <div>
            <p class="text-gray-400"><?php echo e(__('destinations.distance')); ?></p>
            <p id="planet-distance" class="font-bellefair text-white text-2xl">
              <?php echo e($data['distance'] ?? ''); ?>

            </p>
          </div>
          <div>
            <p class="text-gray-400"><?php echo e(__('destinations.travel_time')); ?></p>
            <p id="planet-time" class="font-bellefair text-white text-2xl">
              <?php echo e($data['time'] ?? ''); ?>

            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', () => {
  // Données issues du contrôleur (je garde les clés name, desc, distance, time).
  const planets = <?php echo json_encode($planets, 15, 512) ?>;
  // Slug courant envoyé par le contrôleur
  let current = <?php echo json_encode($planet, 15, 512) ?>;

  const btns  = Array.from(document.querySelectorAll('.planet-btn[role="tab"]'));
  const imgEl = document.getElementById('planet-image');
  const nameEl = document.getElementById('planet-name');
  const descEl = document.getElementById('planet-desc');
  const distEl = document.getElementById('planet-distance');
  const timeEl = document.getElementById('planet-time');

  // Je centralise la mise à jour visuelle de l’onglet actif
  function updateActiveButton(activeSlug) {
    btns.forEach(b => {
      const isActive = b.dataset.planet === activeSlug;
      b.setAttribute('aria-selected', isActive ? 'true' : 'false');
      b.classList.toggle('border-white', isActive);
      b.classList.toggle('text-white', isActive);
      b.classList.toggle('border-transparent', !isActive);
      b.classList.toggle('text-[#D0D6F9]', !isActive);
    });
  }

  // Animation simple : fade/slide, puis mise à jour des contenus
  function animateSwap(next) {
    imgEl.classList.add('opacity-0', '-translate-x-10');
    nameEl.classList.add('opacity-0', 'translate-y-4');
    descEl.classList.add('opacity-0', 'translate-y-4');

    setTimeout(() => {
      // Mise à jour des données
      const p = planets[next];
      if (!p) return;

      // Image : si tu préfères, tu peux fournir p.img côté PHP
      imgEl.src = "<?php echo e(asset('images/destinations')); ?>/" + next + ".png";
      imgEl.alt = p.name || next;

      nameEl.textContent = p.name || '';
      descEl.textContent = p.desc || '';
      distEl.textContent = p.distance || '';
      timeEl.textContent = p.time || '';

      // Sortie d’animation
      imgEl.classList.remove('-translate-x-10');
      nameEl.classList.remove('translate-y-4');
      descEl.classList.remove('translate-y-4');

      imgEl.classList.remove('opacity-0');
      nameEl.classList.remove('opacity-0');
      descEl.classList.remove('opacity-0');

      // Accessibilité : je replace le focus sur le titre de la planète
      nameEl.setAttribute('tabindex', '-1');
      nameEl.focus({ preventScroll: true });
      setTimeout(() => nameEl.removeAttribute('tabindex'), 0);
    }, 250);
  }

  // Gestion du clic et du clavier sur les onglets
  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      const slug = btn.dataset.planet;
      if (!slug || slug === current) return;
      current = slug;
      updateActiveButton(current);
      animateSwap(current);
    });

    btn.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        btn.click();
      }
    });
  });

  // Au chargement, je m’assure que l’état visuel reflète bien $planet
  updateActiveButton(current);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/pages/destinations.blade.php ENDPATH**/ ?>