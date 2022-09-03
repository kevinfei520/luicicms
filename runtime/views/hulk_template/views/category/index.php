<?php /* HULK template engine v0.3
a:2:{s:15:"/category/index";i:1655502361;s:19:"base/parent_message";i:1655502361;}
*/ ?>
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
        <div class="layuimini-container">
        <div class="layuimini-main">
            <fieldset class="layui-elem-field layuimini-search">
                <legend>搜索信息</legend>
                <div style="margin: 10px;">
                    <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">分类</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="category_name" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">分类名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">描述</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="description" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">关键字</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="keywords" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <a class="layui-btn" lay-submit="" lay-filter="data-search-btn">搜索</a>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>

            <div class="layui-btn-group">
                <button class="layui-btn data-add-btn">添加</button>
                <button class="layui-btn layui-btn-danger data-delete-btn">删除</button>
            </div>
            <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>
            <script type="text/html" id="currentTableBar">
                <a class="layui-btn layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
                <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
            </script>
        </div>
    </div>
        <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
    <script type="text/javascript">
        function GetValue(obj){
             if(obj){  window.location.reload(); }
        }
        layui.use(['form', 'table'], function () {
            var $ = layui.jquery, form = layui.form, table = layui.table;

            table.render({
                elem: '#currentTableId',
                url: '/categorys/list',
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 80, title: 'ID', sort: true},
                    {field: 'pid', width: 120, title: '上级分类ID'},
                    {field: 'category_name', width: 180, title: '标题', sort: true},
                    {field: 'sort_order', width: 80, title: '排序'},
                    {field: 'keywords', title: '关键字', minWidth: 180},
                    {field: 'description', title: '描述', minWidth: 180},
                    {title: '操作', minWidth: 50, templet: '#currentTableBar', fixed: "right", align: "center"}
                ]],
                response: {
                      statusName: 'code' //数据状态的字段名称，默认：code
                      ,statusCode: 200 //成功的状态码，默认：0
                      ,msgName: 'message' //状态信息的字段名称，默认：msg
                      ,countName: 'count' //数据总数的字段名称，默认：count
                      ,dataName: 'data' //数据列表的字段名称，默认：data
                },
                limits: [10, 15, 20, 25, 50, 100],
                limit: 15,
                page: true
            });

            // 监听搜索操作
            form.on('submit(data-search-btn)', function (data) {
                let result = JSON.stringify(data.field);
                //执行搜索重载
                table.reload('currentTableId', {
                    page: { curr: 1 } , where: {
                        searchParams: result
                    }
                }, 'data');
                return false;
            });

            // 监听添加操作
            $(".data-add-btn").on("click", function () {
                layer.open({
                    type: 2,
                    title: false,
                    closeBtn: true, //不显示关闭按钮
                    shade: [0],
                    area: ['1100px', '450px'],
                    content: ['/categorys/add', 'no'], //iframe的url，no代表不显示滚动条
                });
            });

            // 监听多选删除操作
            $(".data-delete-btn").on("click", function () {
                var checkStatus = table.checkStatus('currentTableId'), data = checkStatus.data;
                layer.confirm('真的删除行么', function (index) {
                    $.post('delete_all',{data:data}, function (reslut) {
                        var data = JSON.parse(reslut);
                        if(data.code == 400){
                            layer.msg(data.message,{ time: 2000 }, function () {
                                layer.close(index);
                                window.location.reload();
                            });
                        }else{
                            layer.msg(data.message,{ time: 2000 }, function () {
                                layer.close(index);
                                window.location.reload();
                            });
                        }
                    });
                });
            });

            //监听表格复选框选择
            table.on('checkbox(currentTableFilter)', function (obj) {
                console.log(obj)
            });

            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'edit') {
                    layer.open({
                        type: 2,
                        title: false,
                        closeBtn: true, //不显示关闭按钮
                        shade: [0],
                        area: ['1100px', '450px'],
                        content: ['/categorys/edit', 'no'], //iframe的url，no代表不显示滚动条
                        success:function (layero,index) {
                            var iframe = window['layui-layer-iframe' + index];
                            iframe.child(data);
                        }
                    });
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        $.post('delete',{id:data.id}, function (reslut) {
                            var data = JSON.parse(reslut);
                            if(data.code == 400){
                                layer.msg(data.message,{ time: 2000 }, function () {
                                    layer.close(index);
                                    window.location.reload();
                                });
                            }else{
                                layer.msg(data.message,{ time: 2000 }, function () {
                                    obj.del();
                                    layer.close(index);
                                });
                            }
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
