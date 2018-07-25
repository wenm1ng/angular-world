<!doctype html>
<html>
<head design-width="750">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>小花样喜迎世界杯</title>
    <link rel="stylesheet" href="css/style2.css"/><!--页面样式-->
    <link rel="stylesheet" href="css/common.css"/><!--常用样式-->
    <link rel="stylesheet" href="css/animate.min.css"/><!--CSS3动画库-->
    <script src="js/auto-size.js"></script><!--设置字体大小-->
    <?php echo $__env->yieldContent('style'); ?>
</head>
<body>
<div class="mobile-wrap center">
    <div class="title">
        <img src="img/tit1.png" alt="" class="img-tit"/>
        <img src="img/tit2.png" alt="" class="img-tit2"/>
        <img src="img/tit3.png" alt="" class="img-tit3"/>
        <h6>
            <a href="<?php echo e(url('/lotteries')); ?>" class="a-list">
                获奖<br/>名单
            </a>
            <a href="<?php echo e(url('/center')); ?>" class="a-pers">
                个人<br/>中心
            </a>
        </h6>
        <ul>
            <li><i></i><a href="<?php echo e(url('/')); ?>">竞猜狂欢</a></li>
            <li><i></i><a href="<?php echo e(url('/rank')); ?>">谁是预言帝</a></li>
            <li><i></i><a href="<?php echo e(url('/talk')); ?>">吐槽一刻</a></li>
        </ul>
    </div>
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>


</body>
<script src="js/jquery-1.10.2.min.js"></script><!--jQ库-->
<script src="js/swiper-3.3.1.jquery.min.js"></script><!--轮播库-->
<script src="js/version-3.2.8.js"></script><!--封装函数-->
<script type="text/javascript">
    $('.title ul li').click(function () {
        $(this).addClass('acti').siblings().removeClass('acti');
    });
</script>
<script src="<?php echo e(asset('js/angular.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/angular-resource.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/worldcup-app.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/ng-file-upload-all.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/paging.min.js')); ?>"></script>
<?php echo $__env->yieldContent('custom-scripts'); ?>
</html>
