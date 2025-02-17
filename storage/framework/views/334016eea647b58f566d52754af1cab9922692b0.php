<?php $__env->startSection('content'); ?>
    <div class="inform-inpt" ng-app="wcapp" ng-controller="addressCtrl">
        <h2>
            <img src="img/ic10.png" alt=""/>
        </h2>
        <form>
            <label>您的姓名</label>
            <input type="text" value="" id="name" ng-model="user.real_name" class="text"/>
            <label>联系电话/手机</label>
            <input type="text" name="" id="iphone" ng-model="user.phone" value="" class="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
            <label>奖品收货地址</label>
            <textarea name="addr" ng-model="user.address" id="address"></textarea>
            <input type="submit" value="保存" class="submit" ng-click="saveAddress()"/>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(asset('js/front/address-service-controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>