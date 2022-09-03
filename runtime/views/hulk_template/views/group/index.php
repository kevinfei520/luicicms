<?php /* HULK template engine v0.3
a:2:{s:12:"/group/index";i:1655502361;s:19:"base/parent_message";i:1655502361;}
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
                                <label class="layui-form-label">权限组名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" autocomplete="off" class="layui-input" />
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">描述</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="description" autocomplete="off" class="layui-input">
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
                <button class="layui-btn data-add-btn">添加权限组</button>
            </div>
            <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>
            <script type="text/html" id="currentTableBar">
                <a class="layui-btn layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
                <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
            </script>
        </div>
    </div>
        <script src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.use(['form', 'table', 'layer'], function () {
            var $ = layui.jquery, form = layui.form, table = layui.table, layer = layui.layer;

            table.render({
                elem: '#currentTableId',
                url: '/groups/getlist',
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 100, title: 'ID', sort: true},
                    {field: 'name', width: 240, title: '权限组名称', fixed: "right", align: "center"},
                    {field: 'description', minwidth: 300, title: '描述', fixed: "right", align: "center"},
                    {field: 'status', width: 150, title: '状态', align: "center", templet:function(d){
                        if(d.status==0){
                            return  '<div class="layui-input-block" style="margin-left:0px;">'+
                                         '<input type="checkbox" name="close" lay-skin="switch" lay-filter="switchTest" lay-text="开启|关闭" data-id='+d.id+'>'+
                                    '</div>';
                        }else{
                            return  '<div class="layui-input-block" style="margin-left:0px;"> ' +
                                         '<input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="开启|关闭" data-id='+d.id+'>'+
                                    '</div>';
                        }
                    }},
                    {title: '操作', minwidth: 80, templet: '#currentTableBar', fixed: "right", align: "center"}
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
                var result = JSON.stringify(data.field);
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
                 window.location.href = '/groups/add.html';
            });

            //监听指定开关
            form.on('switch(switchTest)', function (data) {
                var id = $(this).data('id');
                $.post("/groups/editgroupstatus?id="+id, {data:this.checked ? '1' : '0'}, function (resource) {
                    resource = JSON.parse(resource);
                    layer.msg(resource.message, { icon: 1, time: 2000 }, function(){
                        //parent.location.reload()//刷新父亲对象（用于框架）
                    });
                });
            });

            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'edit') {
                     window.location.href = '/groups/edit.html?id='+data.id;
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        $.post("/groups/delete", {id:data.id}, function (data) {
                            if(data.code===400){
                                layer.msg(data.message, {icon: 1,time: 2000}, function () {
                                    layer.close(index);
                                    window.location.reload();
                                });
                            }else{
                                layer.msg(data.message, {icon: 1,time: 2000}, function () {
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
