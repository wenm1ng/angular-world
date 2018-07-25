<?php $__env->startSection('content'); ?>
    <div class="list">
        <h5>
            <img src="img/ic21.png" alt=""/>
        </h5>
        <?php $__currentLoopData = $lotteries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lottery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="list-col">
                <h6>
        				<span>
        					<?php echo e($lottery[0]->d); ?>

        				</span>
                </h6>
                <ul>
                    <?php $__currentLoopData = $lottery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><img src="<?php echo e($item->avatar); ?>"></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>