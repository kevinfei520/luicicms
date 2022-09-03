<!DOCTYPE html>
<html>
<head>
    <title>LCADMIN - 基于LUI和CI框架的后台管理系统</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
    <style>
        .layui-input-block{
            margin-left: 125px;
        }
        .layui-form-label{
            width: 90px;
        }
    </style>
</head>
<body>  

    <# block cententFrom #>

        <div class="layuimini-container">
            <div class="layuimini-main">
                <# slot title #> CodeIgniter <# /slot #>
                <form class="layui-form">

                    <div class="layui-form-item">
                        <label class="layui-form-label">父级（级别）</label>
                        <div class="layui-input-block">
                            <input type="text" name="pid" lay-verify="pid" class="layui-input" value='<?php if(isset($pid)){echo $pid;} ?>' placeholder="请输入级别 0 为父级">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" lay-verify="title" class="layui-input" value='<?php if(isset($title)){echo $title;} ?>' placeholder="请输入标题">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">链接</label>
                        <div class="layui-input-block">
                            <input type="text" name="href" lay-verify="href"  class="layui-input" value='<?php if(isset($href)){echo $href;} ?>' placeholder="请输入链接">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">图标</label>
                        <div class="layui-input-block">
                            <input type="text" name="icon" lay-verify="icon" class="layui-input" value='<?php if(isset($icon))  { echo $icon; } ?>' placeholder="请输入图标">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">跳转方式</label>
                        <div class="layui-input-block">
                            <input type="text" name="target" lay-verify="target" class="layui-input" value='<?php if(isset($target)) { echo $target; } ?>' placeholder="请输入跳转方式">
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <label class="layui-form-label">昵称</label>
                        <div class="layui-input-block">
                            <input type="text" name="nickname" lay-verify="nickname" class="layui-input" value='<?php if(isset($nickname)) { echo $nickname; } ?>' placeholder="请输入昵称">
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

    <# block carouseJs #>CodeIgniter<# /block #>

    <script type="text/javascript">
        $('#return1').on('click', function(){
             parent.location.reload()//刷新父亲对象（用于框架）
        });
    </script>
</body>
</html>