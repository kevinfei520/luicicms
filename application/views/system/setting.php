<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>系统设置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
    <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <style>
        .layui-form-item .layui-input-company {width: auto;padding-right: 10px;line-height: 38px;}
    </style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" name="sitename" lay-verify="required" lay-reqtext="网站域名不能为空" placeholder="请输入网站名称"  value="<?php echo $sitename;?>" class="layui-input">
                    <tip>填写自己部署网站的名称。</tip>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">网站域名</label>
                <div class="layui-input-block">
                    <input type="text" name="domain" lay-verify="required" lay-reqtext="网站域名不能为空" placeholder="请输入网站域名"  value="<?php echo $domain;?>" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">缓存时间</label>
                <div class="layui-input-inline" style="width: 80px;">
                    <input type="text" name="cache" lay-verify="number" value="0" class="layui-input">
                </div>
                <div class="layui-input-inline layui-input-company">分钟</div>
                <div class="layui-form-mid layui-word-aux">本地开发一般推荐设置为 0，线上环境建议设置为 10。</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">最大文件上传</label>
                <div class="layui-input-inline" style="width: 80px;">
                    <input type="text" name="cache" lay-verify="number" value="2048" class="layui-input">
                </div>
                <div class="layui-input-inline layui-input-company">KB</div>
                <div class="layui-form-mid layui-word-aux">提示：1 M = 1024 KB</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">上传文件类型</label>
                <div class="layui-input-block">
                    <input type="text" name="cache" value="<?php echo $cache; ?>" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label required">首页标题</label>
                <div class="layui-input-block">
                    <textarea name="title" class="layui-textarea"><?php echo $title;?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META关键词</label>
                <div class="layui-input-block">
                    <textarea name="keywords" class="layui-textarea" placeholder="多个关键词用英文状态 , 号分割"><?php echo $keywords;?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META描述</label>
                <div class="layui-input-block">
                    <textarea name="descript" class="layui-textarea"><?php echo $descript;?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label required">版权信息</label>
                <div class="layui-input-block">
                    <textarea name="copyright" class="layui-textarea"><?php echo $copyright;?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="setting">确认保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form'], function () {
        var form = layui.form
            , layer = layui.layer;

        //监听提交
        form.on('submit(setting)', function (data) {
            $.ajax({
                    type: "POST",
                    url: "/systems/upsetdata",
                    data: {data: data.field},
                    dataType: "json",
                    success: function(res){ 
                        layer.msg(res.message, {icon: 1,time: 2000}, function () {
                            window.location.reload();
                        });  
                    }
            });
        });
    });
</script>
</body>
</html>