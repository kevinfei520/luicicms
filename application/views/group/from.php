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
                <# slot title #> CodeIgniter <# /slot #>
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限组名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入权限组名称" class="layui-input" value="<?php if(isset($name)){ echo $name; } ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">权限组描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="description" lay-verify="description" autocomplete="off" placeholder="请输入权限组描述" class="layui-input" value="<?php if(isset($description)){ echo $description; }?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">授权</label>
                        <div class="layui-input-block">
                            <div class="ztree" id="AuthRule"> 
                                <input lay-skin="primary" type="checkbox" id="checkall" title="全选" lay-filter="allChoose" /><br>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">权限状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="启用" checked="">
                            <input type="radio" name="status" value="0" title="禁用">
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

    <# block carouseJs #>CodeIgniter 3.0 <# /block #>

    <script type="text/javascript">
         $('#return1').on('click', function(){
             parent.location.reload()//刷新父亲对象（用于框架）
         })
    </script> 
</body>
</html>
