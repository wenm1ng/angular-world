<?php $__env->startSection('content'); ?>
    <div class="rank-list">
        <div class="rank-tag">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="rank-list-col">
            <h5>
                <img src="img/ic17.png" alt=""/>
                <i>预测精准次数排行榜</i>
            </h5>
            <div class="rank-roll">
                <ul>
                    <?php for($i = 0; $i < count($guesses); $i+=2): ?>
                        <li>
                            <p>
                                <span <?php if( $guesses[$i]->myself == 1 ): ?>style="color:#ffe400"<?php endif; ?>><?php echo e($i+1); ?>.<?php echo e($guesses[$i]->nickname); ?></span>
                                <b><i><?php echo e($guesses[$i]->total); ?></i>次</b>
                            </p>
                            <?php if(!empty($guesses[$i+1])): ?>
                                <p>
                                <span <?php if( $guesses[$i+1]->myself == 1 ): ?>style="color:#ffe400"<?php endif; ?>><?php echo e($i+2); ?> .<?php echo e($guesses[$i+1]->nickname); ?></span>
                                <b><i><?php echo e($guesses[$i+1]->total); ?></i>次</b>
                                </p>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $('.title ul').children().eq(1).addClass('acti');
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>