@extends('layouts.app')
@section('title')
    <title>球队列表</title>
@stop
@section('content')
    <div ng-controller="teamCtrl">
        <div class="container">
            <div class="well row">
                <div class="col-md-2">
                    <ol class="breadcrumb">
                        <li><a href="#">球队列表</a></li>
                    </ol>
                </div>
                <div class="col-md-10 row form-inline">
                    <div class="btn-group">
                        <a href="#" class="btn btn-default" ng-click="openTeamForm()">新增</a>
                        <a href="#" class="btn btn-default" ng-click="listTeams()">搜索</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>球队</th>
                        <th>国旗</th>
                        <th>备注</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="m in teams">
                        <td>@{{ m.name }}</td>
                        <td><a href="@{{ m.flag_url }}" target="_blank"><img width="50px" height="50px"  ng-src="@{{ m.flag_url }}"/></a></td>
                        <td>@{{ m.description }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-default" ng-click="openTeamForm(m)">编辑</button>
                                <button class="btn btn-sm btn-default" ng-click="deleteTeam(m)">删除</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="team-form" class="modal fade form-horizontal" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">球队详情</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label for="password" class="col-md-3">名称</label>
                            <div class="col-md-6">
                                <input ng-model="selectedTeam.name" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">旗帜</label>
                            <div class="col-md-6">
                                <input type="file" ngf-select ng-model="selectedTeam.flagUrl" name="file"
                                       accept="image/*" ngf-max-size="10MB" required
                                       ngf-model-invalid="errorFile"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-md-3">备注</label>
                            <div class="col-md-6">
                                <textarea class="form-control" ng-model="selectedTeam.description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="btn btn-default" data-dismiss="modal">取消</a>
                        <a href="#!" class="btn btn-default" data-dismiss="modal" ng-click="saveTeam(selectedTeam.flagUrl)">保存</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin/team-service-controller.js') }}"></script>
@stop
