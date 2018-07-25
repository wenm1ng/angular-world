<?php $__env->startSection('title'); ?>
    <title>参与人员列表</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div ng-controller="userCtrl">
        <div class="container">
            <div class="well row">
                <div class="col-md-2">
                    <ol class="breadcrumb">
                        <li><a href="#">参与人员列表</a></li>
                    </ol>
                </div>
                <div class="col-md-10 row form-inline">
                    <div class="btn-group">
                        <a href="#" class="btn btn-default" ng-click="listUsers()">搜索</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>昵称</th>
                        <th>区域</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="m in users">
                        <td><img width="50px" height="50px" ng-src="{{ m.avatar }}"/></td>
                        <td>{{ m.nickname }}</td>
                        <td>{{ m.country }}{{ m.province }}{{ m.city }}</td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/admin/user-service-controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>