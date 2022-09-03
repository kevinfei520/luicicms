<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>LuiciCMS - 基于LUI和CI框架的后台管理系统</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
    <script type="text/javascript" src="/resource/tinymce/tinymce.min.js"></script>
</head>
<body>

    <# block cententFrom #>
        <div class="layuimini-container">
            <div class="layuimini-main">
                <# slot title #> CodeIgniter <# /slot #>
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类ID</label>
                        <div class="layui-input-block">
                            <input type="text" name="cid" lay-verify="cid" autocomplete="off" placeholder="请输入分类ID" class="layui-input" value="<?php if(isset($cid)){ echo $cid; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="<?php if(isset($title)){ echo $title; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">图片</label>
                        <div class="layui-input-block">
                            <input type="text" name="image" autocomplete="off" placeholder="上传图片" class="layui-input" style="width: 88%;" value="<?php if(isset($image)){ echo $image; } ?>" />
                            <button type="button" class="layui-btn" id="image" style="float: right; margin-top: -38px;">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                            </button>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">作者</label>
                        <div class="layui-input-block">
                            <input type="text" name="author" lay-verify="author" autocomplete="off" placeholder="请输入作者" class="layui-input" value="<?php if(isset($author)){ echo $author; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">简介</label>
                        <div class="layui-input-block">
                            <input type="text" name="summary" lay-verify="summary" autocomplete="off" placeholder="请输入简介" class="layui-input" value="<?php if(isset($summary)){ echo $summary; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">相册</label>
                        <div class="layui-input-block">
                            <input type="text" name="photo" lay-verify="photo" autocomplete="off" placeholder="请输入相册" class="layui-input" value="<?php if(isset($photo)){ echo $photo; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">内容</label>
                        <div class="layui-input-block">
                            <input id="tinymce" type="text" name="content" lay-verify="content" autocomplete="off" placeholder="请输入内容" class="layui-input" value="<?php if(isset($content)){ echo $content; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">点击量</label>
                        <div class="layui-input-block">
                            <input type="text" name="view" lay-verify="view" autocomplete="off" placeholder="请输入点击量" class="layui-input" value="<?php if(isset($view)){ echo $view; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">是否置顶</label>
                        <div class="layui-input-block">
                            <input type="radio" name="is_top" value="1" title="启用" checked="">
                            <input type="radio" name="is_top" value="0" title="禁用">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">是否推荐</label>
                        <div class="layui-input-block">
                            <input type="radio" name="is_hot" value="1" title="启用" checked="">
                            <input type="radio" name="is_hot" value="0" title="禁用">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">活动状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="启用" checked="">
                            <input type="radio" name="status" value="0" title="禁用">
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="sort_order" lay-verify="sort_order" autocomplete="off" placeholder="请输入排序" class="layui-input" value="<?php if(isset($sort_order)){ echo $sort_order; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="keywords" lay-verify="keywords" autocomplete="off" placeholder="请输入关键字" class="layui-input" value="<?php if(isset($keywords)){ echo $keywords; } ?>" >
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="description" lay-verify="description" autocomplete="off" placeholder="请输入描述" class="layui-input" value="<?php if(isset($description)){ echo $description; } ?>" >
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">点赞数</label>
                        <div class="layui-input-block">
                            <input type="text" name="fabulous" lay-verify="fabulous" autocomplete="off" placeholder="请输入点赞数" class="layui-input" value="<?php if(isset($fabulous)){ echo $fabulous; } ?>" >
                        </div>
                    </div>

                    <input type="text" name="id" lay-verify="id" class="layui-input" style="display: none;" value="<?php if(isset($id)){ echo $id; } ?>" />
            
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

</body>
</html>
