



<?php $__env->startSection('content'); ?>
    
    <h1 class="mb-4">Utilisateurs</h1>

    
    <div class="d-flex justify-content-between mb-3">
        
        <form method="GET" class="d-flex gap-2">
            
            <input type="text" name="q" value="<?php echo e($q ?? ''); ?>" placeholder="Rechercher nom/email" class="form-control" />
            <button class="btn btn-primary">Filtrer</button>
        </form>

        
        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-success">Nouvel utilisateur</a>
    </div>

    
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôles</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                
                <td><?php echo e($u->id); ?></td>

                
                <td><?php echo e($u->name); ?></td>

                
                <td><?php echo e($u->email); ?></td>

                
                <td><?php echo e($u->roles->pluck('name')->join(', ')); ?></td>

                
                <td class="text-end">
                    
                    <a href="<?php echo e(route('admin.users.edit',$u)); ?>" class="btn btn-sm btn-primary">Éditer</a>

                    
                    <form action="<?php echo e(route('admin.users.destroy',$u)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer <?php echo e($u->name); ?> ?')">
                            Suppr.
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <tr><td colspan="5">Aucun utilisateur.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    
    <?php echo e($users->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\space-tourism-all\resources\views/admin/users/index.blade.php ENDPATH**/ ?>