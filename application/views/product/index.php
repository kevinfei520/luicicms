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
                                <label class="layui-form-label">商品标题</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="title" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">分类名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="category_name" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">商品价格</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="price" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">企业名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" autocomplete="off" class="layui-input">
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
    <script src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
    <script>
        layui.use(['form', 'util', 'table'], function () {
            var $ = layui.jquery, form = layui.form, util = layui.util, table = layui.table;

            table.render({
                elem: '#currentTableId',
                url: '/products/getlist',
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 80, title: 'ID', sort: true},
                    {field: 'cname', width: 130, title: '分类名称'},
                    {field: 'title', width: 320, title: '商品标题'},
                    {field: 'price', width: 130, title: '商品价格'},
                    {field: 'name', width: 200, title: '企业名称'},
                    {field: 'phone', width: 200, title: '联系电话'},
                    {field: 'purl', width: 120, title: '商品链接'},
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
                var result = JSON.stringify(data.field);
                //执行搜索重载
                table.reload('currentTableId', {
                    page: { curr: 1}, where: {
                        searchParams: result
                    }
                }, 'data');

                return false;
            });

            // 监听添加操作
            $(".data-add-btn").on("click", function () {
                 window.location.href = '/products/add.html';
            });

            // 监听表格操作
            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'edit') {
                    window.location.href = '/products/edit.html?id='+data.id;
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        $.post('delete', {id:data.id}, function (reslut) {
                            var data = JSON.parse(reslut);
                            if(data.code == 400){
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

            // 监听删除操作
            $(".data-delete-btn").on("click", function () {
                var checkStatus = table.checkStatus('currentTableId'), data = checkStatus.data;
                layer.confirm('真的删除行么', function (index) {
                    $.post('delete_all', {data:data}, function (reslut) {
                        var data = JSON.parse(reslut);
                        if(data.code == 400){
                            layer.msg(data.message, {icon: 1,time: 2000}, function () {
                                layer.close(index);
                                window.location.reload();
                            });
                        }else{
                            layer.msg(data.message, {icon: 1,time: 2000}, function () {
                                layer.close(index);
                                window.location.reload();
                            });
                        }
                    });
                });
            });
        });
    </script>
<# /block #>