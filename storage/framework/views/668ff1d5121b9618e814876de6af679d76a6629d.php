<?php $__env->startSection('content'); ?>

    <div ng-app="wcapp" ng-controller="lotteryCtrl">
        <input type="hidden" value="<?php echo e($game_id); ?>" id="hiddenGameId"/>
        <div class="prize">
            <ul id="lottery">
                <li>
                    <img src="img/ico1.png" data="2" alt=""/>
                </li>
                <li>
                    <img src="img/ico2.png" data="1" alt=""/>
                </li>
                <li>
                    <img src="img/ico3.png" data="3" alt=""/>
                </li>
                <li>
                    <img src="img/ico4.png" data="4" alt=""/>
                </li>
                <li>
                    <img src="img/ico5.png" data="0" alt=""/>
                </li>
                <li>
                    <img src="img/ico6.png" data="5" alt=""/>
                </li>
            </ul>
        </div>
        <div class="bnt">
            <img src="img/bt.png" alt="" ng-click="draw()"/>
        </div>

        <div class="no-win">
            <h4>
                很遗憾,未中奖哦，再接再厉！
            </h4>
            <h6>
                <a href="<?php echo e(url('/')); ?>">返 回</a>
            </h6>
        </div>
        <div class="win">
            <h4>
                <img src="img/ic22.png" alt=""/>
            </h4>
            <p>
                [<b>{{ result.msg }}</b> ]
            </p>
            <h5>
                <a href="<?php echo e(url('/address')); ?>" style="color:white">点击填写奖品收货信息</a>
            </h5>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(asset('js/front/lottery-service-controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>