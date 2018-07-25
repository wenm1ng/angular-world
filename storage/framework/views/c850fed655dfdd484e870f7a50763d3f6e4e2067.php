<?php $__env->startSection('content'); ?>
    <div class="pk-rank">
        <h5>
            <img src="img/ic23.png" alt=""/>
        </h5>
        <ul>
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="germany">
                    <h6>
                        <span><?php echo e($game->team_score); ?>:<?php echo e($game->opponent_score); ?></span>
                    </h6>
                    <h4>
                        <img src="<?php echo e($game->team_url); ?>" alt="" class="argentina"/>
                        <span class="argentina"><?php echo e($game->team_name); ?></span>
                        <i>VS</i>
                        <span class="germany"><?php echo e($game->opponent_team); ?></span>
                        <img src="<?php echo e($game->opponent_url); ?>" alt="" class="germany"/>
                    </h4>
                    <h2>
                        <?php echo e($game->game_time); ?>

                    </h2>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>