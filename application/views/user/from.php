<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>LuiciCMS - 基于LUI和CI框架的后台内容管理系统</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
</head>
<body>  

    <# block cententFrom #>

        <div class="layuimini-container">
            <div class="layuimini-main">
                <# slot title #> CodeIgniter 3.0<# /slot #>
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-block">
                            <input type="text" name="username" lay-verify="username" placeholder="请输入用户名" class="layui-input" value='<?php if(isset($username)){echo $username;} ?>' >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-input-block">
                            <input type="text" name="password" lay-verify="password" placeholder="请输入密码" class="layui-input" value='<?php if(isset($password)){echo $password;} ?>' >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">手机</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile" lay-verify="mobile" placeholder="请输入手机" class="layui-input" value='<?php if(isset($mobile))
                            { echo $mobile; } ?>'>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                            <?php
                                if(isset($sex) && $sex == 1)
                                {
                                    echo '<input type="radio" name="sex" value="0" title="男" ><input type="radio" name="sex" value="1" title="女" checked="">';
                                }else{
                                    echo '<input type="radio" name="sex" value="0" title="男" checked=""><input type="radio" name="sex" value="1" title="女" >';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">积分</label>
                        <div class="layui-input-block">
                            <input type="text" name="integral" lay-verify="integral" placeholder="积分" class="layui-input" value='<?php if(isset($integral)){
                                echo $integral;} ?>'>
                        </div>
                    </div>
                   
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <?php 
                                if(isset($status) && $status == 0)
                                {   
                                    echo '<input type="radio" name="status" value="1" title="启用" ><input type="radio" name="status" value="0" title="禁用" checked="">';
                                }else{
                                    echo '<input type="radio" name="status" value="1" title="启用" checked=""><input type="radio" name="status" value="0" title="禁用" >';
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            <button id="return1" class="layui-btn layui-btn-primary" >返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <# /block #>

    <# block carouseJs #>CodeIgniter 3.0<# /block #>

    <script type="text/javascript">
        $('#return1').on('click', function(){
             parent.location.reload()//刷新父亲对象（用于框架）
        });
    </script>
</body>
</html>