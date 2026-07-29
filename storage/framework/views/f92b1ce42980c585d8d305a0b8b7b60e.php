<div class="sidebar-menu">
	<ul class="menu">
		<?php
			use Illuminate\Support\Facades\Route;

			$menus = collect(session('menus'))->map(fn ($item) => (object) $item);
			$route = Route::currentRouteName();
		?>
		<?php $__currentLoopData = $menus->where('level', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($menus->where('parent_id', $item->id)->where('level', 1)->count() > 0): ?>
				<li class="sidebar-title"><h6><?php echo e($item->menu); ?></h6></li>
				<hr>
			<?php endif; ?>
			<?php $__currentLoopData = $menus->where('parent_id', $item->id)->where('level', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($menus->where('parent_id', $item->id)->where('level', 2)->count() > 0): ?>
					<li class="sidebar-item has-sub">
						<a href="#" class='sidebar-link'> <i class="bi bi-stack"></i> <span><?php echo e($menu->menu); ?></span> </a>
						<ul class="submenu">
							<?php $__currentLoopData = $menus->where('parent_id', $item->id)->where('level', 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="submenu-item">
									<a href="component-alert.html"><?php echo e($submenu->menu); ?></a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</li>
				<?php else: ?>
					<li class="sidebar-item <?php echo e($menu->routing == $route ? 'active' : ''); ?>">
						<a href="<?php echo e(route($menu->routing)); ?>" class='sidebar-link'>
							<i class="fa <?php echo e($menu->icon); ?>"></i> <span><?php echo e($menu->menu); ?></span>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
<?php /**PATH C:\gitrepo\proyek-sistem-kopsis\resources\views/parts/sidebar.blade.php ENDPATH**/ ?>