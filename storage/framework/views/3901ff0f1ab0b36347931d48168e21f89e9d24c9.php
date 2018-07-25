<?php $__env->startSection('title'); ?>
    <title>比赛列表</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div ng-controller="gameCtrl">
        <div class="container">
            <div class="well row">
                <div class="col-md-2">
                    <ol class="breadcrumb">
                        <li><a href="#">比赛列表</a></li>
                    </ol>
                </div>
                <div class="col-md-10 row form-inline">
                    <input type="text" class="form-control datepicker" ng-model="search.start_date" style="width:120px"
                           placeholder="开始时间"/>-
                    <input type="text" class="form-control datepicker" ng-model="search.end_date" style="width:120px"
                           placeholder="结束时间"/>
                    <div class="btn-group">
                        <a href="#" class="btn btn-default" ng-click="listGames(1)">搜索</a>
                        <a href="#" class="btn btn-default" ng-click="openEditForm()">增加</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>时间</th>
                        <th>状态</th>
                        <th>球队</th>
                        <th>结果</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="m in games">
                        <td>{{ m.game_time }}</td>
                        <td>{{ getStatusName(m.status) }}</td>
                        <td>{{ m.team.name }} vs. {{ m.opponent.name }}</td>
                        <td>{{ m.team_score }}:{{ m.opponent_score }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-default" ng-click="openEditForm(m)">编辑</button>
                                <button class="btn btn-sm btn-default" ng-click="deleteGame(m)">删除</button>
                                <a class="btn btn-sm btn-default" href="guesses?team=1&game={{m.id}}" target="_blank">竞猜记录</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row" paging
                 page-size="pagingInfo.per_page"
                 total="pagingInfo.total"
                 scroll-top="true"
                 show-prev-next="true"
                 paging-action="listGames(page)"></div>
        </div>

        <div id="game-form" class="modal fade form-horizontal" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">比赛详情</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="password" class="col-md-3">比赛时间</label>
                            <div class="col-md-6">
                                <input ng-model="selectedGame.game_time" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">状态</label>
                            <div class="col-md-6 form-inline">
                                <select class="form-control" ng-model="selectedGame.status"
                                        ng-options="c.id as c.text for c in gameOptions"></select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">球队</label>
                            <div class="col-md-6 form-inline">
                                <select class="form-control" ng-model="selectedGame.team_id"
                                        ng-options="c.id as c.name for c in teams"
                                        style="width:100px">
                                </select>
                                <input ng-model="selectedGame.team_count" placeholder="人数" style="width:50px" class="form-control"
                                       type="text"/>
                                <input ng-model="selectedGame.team_score" placeholder="比分" style="width:50px" class="form-control"
                                       type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">球队</label>
                            <div class="col-md-6 form-inline">
                                <select class="form-control" ng-model="selectedGame.opponent_id"
                                        ng-options="c.id as c.name for c in teams" style="width:100px">
                                </select>
                                <input ng-model="selectedGame.opponent_count" class="form-control" placeholder="人数" style="width:50px"
                                                type="text"/>
                                <input ng-model="selectedGame.opponent_score" placeholder="比分" class="form-control" style="width:50px"
                                       type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">一等奖数</label>
                            <div class="col-md-6">
                                <input ng-model="selectedGame.first_prize" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">二等奖数</label>
                            <div class="col-md-6">
                                <input ng-model="selectedGame.second_prize" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">三等奖数</label>
                            <div class="col-md-6">
                                <input ng-model="selectedGame.third_prize" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">四等奖数</label>
                            <div class="col-md-6">
                                <input ng-model="selectedGame.fourth_prize" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">五等奖数</label>
                            <div class="col-md-6">
                                <input ng-model="selectedGame.five_prize" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="btn btn-default" data-dismiss="modal">取消</a>
                        <a href="#!" class="btn btn-default" data-dismiss="modal" ng-click="saveGame()">保存</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/admin/team-service-controller.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/game-service-controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>