<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>业务管理后台</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
<div class="box header">
    <div class="box-1000">
        <div class="fl header-logo"><a title="业务管理后台">业务管理后台</a></div>
    </div>
</div>
<form role="form"  method="POST" action="{{ url('admin/login') }}">
    {{ csrf_field() }}
    <div class="box main">
        <div class="box-1000" id="user-reg-mainBox">
            <div class="regBox clearfix">
                <div class="fl login-box" style="margin-top:92px">
                    <div class="fl logintitle" style="font-size:18px;">账号登录</div>
                    <div class="go-reg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div class="login-wrap"><input placeholder="用户名" type="text" value="{{ old('username') }}"
                                                   name="username" class="login-input br3"/></div>
                    <div class="login-wrap"><input placeholder="密码" type="password" name="password"
                                                   value="{{ old('password') }}" class="login-input br3"/></div>
                    <div class="login-wrap more3"
                         style="margin-top:20px;margin-bottom:26px; overflow: hidden;height:20px">
                        <span class="fl"><input type="checkbox" name="remember" checked/> 记住登录状态</span>
                        <span class="fr">
                            </span>
                        <div style="clear: both;"></div>
                    </div>
                    <!--
                    <div class="login-wrap"><i></i><span style="color:red">用户名或密码错误</span></div>
                    -->
                    <div class="class"></div>
                    <div class="login-wrap">
                        <div class="login-loading br3">登录中.....</div>
                        <button type="submit" id="login-submit" class="login-btn br3">登&nbsp;&nbsp;&nbsp;&nbsp;录
                        </button>
                    </div>
                </div>
                <div class="fr main-qq"></div>
            </div>
            <div class="fieldset">
                <fieldset class="qita-login-line" style="height: 15px;">
                    <legend style="color: #5f5f5f">业务管理后台</legend>
                </fieldset>
            </div>
        </div>
    </div>
</form>
</body>
</html>

