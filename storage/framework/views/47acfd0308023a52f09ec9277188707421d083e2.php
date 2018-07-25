<?php $__env->startSection('content'); ?>
    <style type="text/css">
        .win_coin {
            width: 12%;
            height: 65%;
            color: #fff;
            font-size: .22rem;
            display: inline-block;
            margin: 0 auto;
            background-color: #af161e;
            border-radius: .02rem;
            text-align: center;
            line-height: .30rem;
            font-weight: normal;
        }

        .draw_coin {
            width: 12%;
            height: 65%;
            color: black;
            font-size: .22rem;
            display: inline-block;
            margin: 0 auto;
            background-color: #fff;
            border-radius: .02rem;
            text-align: center;
            line-height: .30rem;
            font-weight: normal;
        }
    </style>
    <div class="record">
        <div class="record-item">
            <h5>
                <img src="img/ic19.png" alt=""/>
            </h5>
            <ul>
                <?php $__currentLoopData = $lotteries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span><?php echo e($g->game_time); ?></span>
                        <b><?php echo e($g->team_name); ?> VS <?php echo e($g->opponent_team); ?></b>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="record-item">
            <h5>
                <img src="img/my_guess.png" alt=""/>
            </h5>
            <ul>
                <?php $__currentLoopData = $guesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($g->bet_result == $g->result ? 'acti' : ''); ?>">
                        <span style=" <?php if($g->bet_result == $g->result && $g->status != 0): ?> color:#af161e <?php endif; ?> " ><?php echo e($g->game_time); ?></span>
                        <b><?php echo e($g->team_name); ?> <i
                                    class="win_coin"> <?php echo e($g->bet_result == 1 ? '胜': ($g->bet_result == 0 ? '平' : '负')); ?> </i> <?php echo e($g->opponent_team); ?>

                        </b>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="record-item">
            <h5>
                <img src="img/ic21zhong.png" alt=""/>
            </h5>
            <ul>
                <?php $__currentLoopData = $lotteries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($g->result != '0' ): ?>
                        <a href="/address">
                            <li class="acti">
                                <span><?php echo e($g->game_time); ?></span>
                                <b><?php echo e($g->result); ?></b>
                            </li>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>