<# extends base/parent_message #>

<# block cententFrom #>
    <div class="layuimini-container">
        <div class="layuimini-main">
            <fieldset class="layui-elem-field layuimini-search">
                <legend>搜索信息</legend>
                <div style="margin: 10px;">
                    <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">分类ID</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="cid" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="title" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">关键字</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="keywords" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">内容</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="content" autocomplete="off" class="layui-input">
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
<# /block #>

<# block carouseJs #>
    <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
    <script type="text/javascript" >
        layui.use(['jquery', 'form', 'layer', 'table'], function () {
            var $ = layui.jquery, form = layui.form, layer = layui.layer, table = layui.table;
            table.render({
                elem: '#currentTableId',
                url: '/articles/list',
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 80, title: 'ID', sort: true},
                    {field: 'cid', width: 100, title: '分类ID', sort: true},
                    {field: 'title', width: 120, title: '标题'},
                    {field: 'author', width: 120, title: '作者'},
                    {field: 'summary', width: 120, title: '简介'},
                    {field: 'content', width: 180, title: '文章内容'},
                    {field: 'view', width: 100, title: '点击量', sort: true},
                    {field: 'is_top', width: 110, title: '是否置顶', sort: true},
                    {field: 'is_hot', width: 100, title: '是否推荐'},
                    {field: 'description', width: 120, title: '描述'},
                    {field: 'fabulous', width: 100, title: '点赞数', sort: true},
                    {field: 'sort_order', width: 80, title: '排序', sort: true},
                    {field: 'status', width: 80, title: '状态', sort: true,templet:function(d){
                        if(d.status == 0){  return '关闭'  }else{  return '开启'; }
                    }},
                    {title: '操作', minWidth: 120, templet: '#currentTableBar', fixed: "right", align: "center"}
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
                    page: { curr: 1 }, where: {
                        searchParams: result
                    }
                }, 'data');
                return false;
            });

            // 监听添加操作
            $(".data-add-btn").on("click", function () {
                window.location.href = '/articles/add.html';
            });

            // 监听删除操作
            $(".data-delete-btn").on("click", function () {
                var checkStatus = table.checkStatus('currentTableId'), data = checkStatus.data;
                layer.confirm('真的删除行么', function (index) {
                    $.post('delete_all', {data:data}, function(reslut){
                        var data = JSON.parse(reslut);
                        layer.msg(data.message,{ time: 2000 }, function () {
                            layer.close(index);
                            window.location.reload();
                        });
                    });
                });
            });
            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'edit') {
                    window.location.href = '/articles/edit.html?id='+data.id;
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        $.post('delete', {id:data.id}, function(reslut){
                            var data = JSON.parse(reslut);
                            layer.msg(data.message,{ time: 2000 }, function () {
                                obj.del();
                                layer.close(index);
                            });
                        });
                    });
                }
            });
            //监听表格复选框选择
            // table.on('checkbox(currentTableFilter)', function (obj) {
            //     console.log(obj)
            // });
        });
    </script>
<# /block #>