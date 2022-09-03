<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LuiciCMS - 基于LUI和CI框架的后台管理系统 - 登陆</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="/resource/images/favicon.ico">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <style>
        html, body {width: 100%;height: 100%;overflow: hidden}
        body {background: #009688;}
        body:after {content:'';background-repeat:no-repeat;background-size:cover;-webkit-filter:blur(3px);-moz-filter:blur(3px);-o-filter:blur(3px);-ms-filter:blur(3px);filter:blur(3px);position:absolute;top:0;left:0;right:0;bottom:0;z-index:-1;}
        .layui-container {width: 100%;height: 100%;overflow: hidden}
        .admin-login-background {width:360px;height:300px;position:absolute;left:50%;top:40%;margin-left:-180px;margin-top:-100px;}
        .logo-title {text-align:center;letter-spacing:2px;padding:14px 0;}
        .logo-title h1 {color:#009688;font-size:25px;font-weight:bold;}
        .login-form {background-color:#fff;border:1px solid #fff;border-radius:3px;padding:14px 20px;box-shadow:0 0 8px #eeeeee;}
        .login-form .layui-form-item {position:relative;}
        .login-form .layui-form-item label {position:absolute;left:1px;top:1px;width:38px;line-height:36px;text-align:center;color:#d2d2d2;}
        .login-form .layui-form-item input {padding-left:36px;}
        .captcha {width:60%;display:inline-block;}
        .captcha-img {display:inline-block;width:34%;float:right;}
        .captcha-img img {height:34px;border:1px solid #e6e6e6;height:36px;width:100%;}
    </style>
</head>
<body>
    <div class="layui-container">
        <div class="admin-login-background">
            <div class="layui-form login-form">
                <form class="layui-form" action="/login/checklogin" method="post" >
                    <div class="layui-form-item logo-title">
                        <h1>LuiciCMS 登陆</h1>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-username" for="username"></label>
                        <input type="text" name="username" lay-verify="required|account" placeholder="用户名或者邮箱" autocomplete="off" class="layui-input" value="admin">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-password" for="password"></label>
                        <input type="password" name="password" lay-verify="required|password" placeholder="密码" autocomplete="off" class="layui-input" value="123456">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-vercode" for="captcha"></label>
                        <input type="text" name="captcha" lay-verify="required|captcha" placeholder="图形验证码" autocomplete="off" class="layui-input verification captcha" value="">
                        <div class="captcha-img">
                            <img id="captchaPic" src="/login/generate_captcha" onclick="this.src='/login/generate_captcha?k='+Math.random();" />
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="checkbox" name="rememberMe" value="true" lay-skin="primary" title="记住密码">
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="login">登 入</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
    <script src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script src="/resource/lib/jq-module/jquery.particleground.min.js" charset="utf-8"></script>
    <script type="text/javascript">

        layui.use(['form', 'layer'], function () {
            var form  = layui.form, layer = layui.layer;

            // 登录过期的时候，跳出ifram框架
            if (top.location != self.location) top.location = self.location;

            // 粒子线条背景
            $(document).ready(function(){
                $('.layui-container').particleground({
                    dotColor:'#5cbdaa',
                    lineColor:'#5cbdaa'
                });
            });

            //自定义验证规则
            form.verify({
                username: function (value) {
                    if (value.length < 2) {
                        return '用户名名称需要至少2个字符啊';
                    }
                },
                password: function (value){
                    if (value.length < 5) {
                        return '密码需要至少6个字符啊';
                    }
                },
                captcha: function (value) {
                    if (value.length < 4) {
                        return '验证码至少4个字符啊';
                    }
                }
            });

            // 进行登录操作
            form.on('submit(login)', function (data) {
                $.post('/login/checkLogin',{data:data.field},function(callback){
                    let reslut = JSON.parse(callback)
                    console.log(reslut)
                    if( reslut.code === 200) {
                        layer.msg(reslut.message, {time:2000}, function(){
                            window.location = '/';
                        });
                    }else if( reslut.code === 400) {
                        layer.msg(reslut.message, {time:2000}, function(){
                            window.location.reload()
                        });
                    }
                });
                return false;
            });
        }); 
    </script>
</body>
</html>
