<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="wcapp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/base/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/gt.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="navbar navbar-default navbar-fixed-top notprint">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">小花样世界杯管理后台</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/admin/games') }}">比赛场次</a></li>
                <li><a href="{{ url('/admin/teams') }}">球队设置</a></li>
            </ul>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/angular.min.js') }}"></script>
<script src="{{ asset('js/angular-resource.min.js') }}"></script>
<script src="{{ asset('js/worldcup-app.js }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/ng-file-upload-all.min.js') }}"></script>
<script src="{{ asset('js/paging.min.js') }}"></script>

@yield('content')
<script>
    $(document).ready(function () {
        $("input.datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
</body>
</html>
