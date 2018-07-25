<?php $__env->startSection('title'); ?>
    <title>竞猜结果</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div ng-controller="guessCtrl">
        <input type="hidden" id="passedGameId" value="<?php echo e($game_id); ?>"/>
        <div class="container">
            <div class="well row">
                <div class="col-md-2">
                    <ol class="breadcrumb">
                        <li><a href="#">竞猜结果</a></li>
                    </ol>
                </div>
                <div class="col-md-10 row form-inline">
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>微信</th>
                        <th>头像</th>
                        <th>支持</th>
                        <th>竞猜时间</th>
                        <th>抽奖时间</th>
                        <th>奖项</th>
                        <th>地址</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="m in guesses">
                        <td>{{ m.nickname }}</td>
                        <td><img src="{{ m.avatar }}" width="50px" height="50px" /></td>
                        <td>{{ m.team_name  }} {{ m.bet_result == 1 ? '胜' : (m.bet_result == 0 ? '平' : '负') }} {{ m.opponent_team  }}</td>
                        <td>{{ m.gtime }}</td>
                        <td>{{ m.ltime }}</td>
                        <td>{{ m.result > 0 ? m.result == 1 ? '一等奖' : (m.result == 2 ? '二等奖' : '三等奖') : '' }}</td>
                        <td>{{ m.address }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-default" ng-click="openLotteryForm(m)">设置中奖</button>
                                <button class="btn btn-sm btn-default" ng-click="deleteLottery(m.lottery_id)">删除</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="lottery-form" class="modal fade form-horizontal" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">详情</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="password" class="col-md-3">奖项</label>
                            <div class="col-md-6 form-inline">
                                <select class="form-control" ng-model="selectedLottery.result" ng-options="c.id as c.name for c in lotteries"></select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="btn btn-default" data-dismiss="modal">取消</a>
                        <a href="#!" class="btn btn-default" data-dismiss="modal" ng-click="saveLottery()">保存</a>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script src="<?php echo e(asset('js/admin/game-service-controller.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/guess-service-controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>