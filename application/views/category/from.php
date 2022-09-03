<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>LCADMIN - 基于LUI和CI框架的后台管理系统</title>
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
                        <label class="layui-form-label">上级分类ID</label>
                        <div class="layui-input-block">
                            <input type="text" name="pid" lay-verify="pid" autocomplete="off" placeholder="请输入分类顶级为0" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">分类名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="category_name" lay-verify="name" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="sort_order" lay-verify="description" autocomplete="off" placeholder="请输入排序" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="keywords" lay-verify="target" autocomplete="off" placeholder="请输入关键字" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="description" lay-verify="image" autocomplete="off" placeholder="请输入描述" class="layui-input">
                        </div>
                    </div>

                    <input type="text" name="id" lay-verify="title" class="layui-input" style="display: none;" value="" />
                  <!--<input type="text" name="--><?php //echo $this->security->get_csrf_token_name(); ?><!--" lay-verify="title" class="layui-input" style="display: none;" value="--><?php //echo $this->security->get_csrf_hash(); ?><!--">-->

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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