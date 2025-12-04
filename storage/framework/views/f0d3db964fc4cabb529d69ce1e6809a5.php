<?php $__env->startSection('title', 'Planètes'); ?>

<?php $__env->startSection('content'); ?>
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Planètes</h1>
    <a href="<?php echo e(route('admin.planets.create')); ?>" class="bg-[#D0D6F9] text-black px-4 py-2 rounded">
      Nouvelle planète
    </a>
  </div>

  <?php if(session('success')): ?>
      <div class="mb-4 rounded border border-green-500/40 bg-green-500/10 px-4 py-2 text-sm text-green-200">
          <?php echo e(session('success')); ?>

      </div>
  <?php endif; ?>

  <?php
      $isEmpty =
          ($planets instanceof \Illuminate\Support\Collection && $planets->isEmpty())
          || (is_array($planets) && count($planets) === 0)
          || ($planets instanceof \Illuminate\Contracts\Pagination\Paginator && $planets->count() === 0);
  ?>

  <?php if($isEmpty): ?>
    <div class="border border-white/10 rounded p-6 text-white/70">
      Aucune planète pour le moment.
    </div>
  <?php else: ?>
    <div class="overflow-x-auto border border-white/10 rounded">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5">
          <tr class="text-left">
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Nom</th>
            <th class="px-4 py-3">Slug</th>
            <th class="px-4 py-3">Ordre</th>
            <th class="px-4 py-3">Publié</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $planets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $published = (bool)($p->is_published ?? $p->published ?? false);
            ?>
            <tr class="border-t border-white/10">
              <td class="px-4 py-3"><?php echo e($p->id); ?></td>
              <td class="px-4 py-3"><?php echo e($p->name); ?></td>
              <td class="px-4 py-3"><?php echo e($p->slug); ?></td>
              <td class="px-4 py-3"><?php echo e($p->order ?? '-'); ?></td>
              <td class="px-4 py-3">
                <?php if($published): ?>
                  <span class="px-2 py-1 text-xs rounded bg-green-500/20 text-green-300">Oui</span>
                <?php else: ?>
                  <span class="px-2 py-1 text-xs rounded bg-red-500/20 text-red-300">Non</span>
                <?php endif; ?>
              </td>
              <td class="px-4 py-3 text-right">
                <a href="<?php echo e(route('admin.planets.edit', $p)); ?>"
                   class="px-3 py-1 rounded border border-white/20 mr-2">
                  Éditer
                </a>

                <form action="<?php echo e(route('admin.planets.destroy', $p)); ?>"
                      method="POST"
                      class="inline"
                      onsubmit="return confirm('Supprimer cette planète ?')">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button class="px-3 py-1 rounded bg-red-600/80 hover:bg-red-600">
                    Suppr.
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>

    <?php if($planets instanceof \Illuminate\Contracts\Pagination\Paginator): ?>
      <div class="mt-4">
        <?php echo e($planets->links()); ?>

      </div>
    <?php endif; ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/admin/planets/index.blade.php ENDPATH**/ ?>