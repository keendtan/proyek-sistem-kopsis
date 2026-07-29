<?php if($errors->any()): ?>
    <div class="alert alert-light-danger color-danger alert-dismissible fade show" role="alert">
		<h5 class="alert-heading">Ups, ada kesalahan!</h5>
        <ul class="pb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if(session()->has('message_success')): ?>
	<div class="alert alert-light-success color-success  alert-dismissible fade show" role="alert">
		<?php echo e(session('message_success')); ?>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>
<?php if(session()->has('message_danger')): ?>
	<div class="alert alert-light-danger color-danger  alert-dismissible fade show" role="alert">
		<?php echo e(session('message_danger')); ?>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>
<?php /**PATH C:\gitrepo\proyek-sistem-kopsis\resources\views/include/flash.blade.php ENDPATH**/ ?>