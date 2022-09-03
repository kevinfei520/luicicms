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
                        <label class="layui-form-label">所属分类</label>
                        <div class="layui-input-block">
                            <input type="text" name="pid" lay-verify="pid" autocomplete="off" placeholder="请输入分类" class="layui-input" value="<?php if(isset($pid)){echo $pid;} ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">商品名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入商品名称" class="layui-input" value="<?php if(isset($title)){echo $title;} ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">商品价格</label>
                        <div class="layui-input-block">
                            <input type="text" name="price" lay-verify="price" autocomplete="off" placeholder="请输入商品价格" class="layui-input" value="<?php if(isset($price)){echo $price;} ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">企业名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入企业名称" class="layui-input" value="<?php if(isset($name)){echo $name;} ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">联系方式</label>
                        <div class="layui-input-block">
                            <input type="text" name="phone" lay-verify="phone" autocomplete="off" placeholder="请输入联系方式" class="layui-input" value="<?php if(isset($phone)){echo $phone;} ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">商品链接</label>
                        <div class="layui-input-block">
                            <input type="text" name="purl" lay-verify="purl" autocomplete="off" placeholder="请输入商品链接" class="layui-input" value="<?php if(isset($purl)){echo $purl;} ?>" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">商品封面图</label>
                        <div class="layui-input-block">
                            <input type="text" name="image" lay-verify="image" autocomplete="off" placeholder="请输入商品封面图" class="layui-input" value="<?php if(isset($image)){echo $image;} ?>" >
                        </div>
                    </div>

                    <!-- status -->
                    <div class="layui-form-item">
                        <label class="layui-form-label">活动状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="启用" checked="">
                            <input type="radio" name="status" value="0" title="禁用">
                        </div>
                    </div>

                    <input type="text" name="id" lay-verify="id" class="layui-input" style="display: none;" value="<?php if(isset($id)){echo $id;} ?>" />

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
        });
    </script>

</body>
</html>
