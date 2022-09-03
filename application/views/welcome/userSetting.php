<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>基本资料</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
    <style>
        .layui-form-item .layui-input-company {
            width: auto;
            padding-right: 10px;
            line-height: 38px;
        }
    </style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">管理账号</label>
                <div class="layui-input-block">
                    <input type="text" name="username" lay-verify="username" lay-reqtext="管理账号不能为空"
                           placeholder="请输入管理账号" value="<?= $username ?>" class="layui-input">
                    <tip>填写自己管理账号的名称。</tip>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">手机</label>
                <div class="layui-input-block">
                    <input type="number" name="mobile" lay-verify="mobile" lay-reqtext="手机不能为空" placeholder="请输入手机"
                           value="<?= $mobile ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="email" lay-verify="email" lay-reqtext="邮箱不能为空" placeholder="请输入邮箱"
                           value="<?= $email ?>" class="layui-input">
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
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="saveBtn">确认保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
<script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.use(['form', 'layer'], function () {
        var form = layui.form, layer = layui.layer;

        form.verify({
            username: function (value) {
                if (value.length < 2) {
                    return '管理账号至少得2个字符啊';
                }
            },
            mobile: function (value) {
                if (value.length < 10) {
                    return '手机号需要11个字符啊';
                }
            },
            email: function (value) {
                if (value.length < 2) {
                    return '邮箱账号至少得2以上个字符啊';
                }
            }
        });

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            layer.confirm('真的提交信息么', function (index) {
                $.ajax({
                    type: "POST",
                    url: "/welcome/updateUserAdmin",
                    data: {data: data.field},
                    dataType: "json",
                    beforeSend: function (request) {
                        index = layer.load();
                    },
                    success: function (data) {
                        layer.msg(data.msg, {icon: 1, time: 2000}, function () {
                            layer.close(index);
                            parent.location.reload()//刷新父亲对象（用于框架）
                        });
                    }
                });
            });
            return false;
        });
    });
</script>
</body>
</html>