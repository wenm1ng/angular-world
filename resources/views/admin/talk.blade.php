@extends('layouts.app')
@section('title')
    <title>留言管理</title>
@stop
@section('content')
    <div ng-controller="talkCtrl">
        <div class="container">
            <div class="well row">
                <div class="col-md-2">
                    <ol class="breadcrumb">
                        <li><a href="#">留言管理</a></li>
                    </ol>
                </div>
                <div class="col-md-10 row form-inline">
                    <div class="btn-group">
                        <a href="#" class="btn btn-default" ng-click="listTalks(1)">搜索</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>内容</th>
                        <th>时间</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="m in talks">
                        <td><img width="50px" height="50px" ng-src="@{{ m.user.avatar }}"/></td>
                        <td>@{{ m.content }}</td>
                        <td>@{{ m.created_at }}</td>
                        <td>
                            <button class="btn btn-sm btn-default" ng-click="deleteTalk(m)">删除</button>
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
                 paging-action="listTalks(page)"></div>
        </div>
    </div>
    <script src="{{ asset('js/admin/talk-service-controller.js') }}"></script>
@stop
