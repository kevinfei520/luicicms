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
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
</head>
<body>

    <# block cententFrom #>
        <div class="layuimini-container">
            <div class="layuimini-main">
                <# slot title #> CodeIgniter <# /slot #>
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">管理员名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="username" lay-verify="username" autocomplete="off" placeholder="请输入管理员名称" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">管理员密码</label>
                        <div class="layui-input-block">
                            <input type="text" name="password" lay-verify="password" autocomplete="off" placeholder="请输入管理员密码" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">手机号</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile" lay-verify="mobile" autocomplete="off" placeholder="请输入手机号" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱</label>
                        <div class="layui-input-block">
                            <input type="text" name="email" lay-verify="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">所属权限组</label>
                        <div class="layui-input-block">
                            <select name="permission_group" lay-filter="aihao">
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">活动状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="启用" checked="">
                            <input type="radio" name="status" value="0" title="禁用">
                        </div>
                    </div>

                    <input type="text" name="id" lay-verify="id" class="layui-input" style="display: none;" value="" />

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

    <# block carouseJs #>CodeIgniter<# /block #>
    
    <script type="text/javascript">
        $('#return1').on('click', function(){
            parent.location.reload()//刷新父亲对象（用于框架）
        });
    </script>

</body>
</html>
