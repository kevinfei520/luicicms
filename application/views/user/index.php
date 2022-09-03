<# extends base/parent_message #>

<# block cententFrom #>
    <div class="layuimini-container">
        <div class="layuimini-main">
            <fieldset class="layui-elem-field layuimini-search">
                <legend>搜索信息</legend>
                <div style="margin: 10px 10px 10px 10px">
                    <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">用户姓名</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="username" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">手机</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="mobile" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">上次登录IP</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="last_login_ip" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">登陆次数</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="login_count" autocomplete="off" class="layui-input">
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
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
    <script type="text/javascript">

        layui.use(['form', 'table', 'laydate', 'util'], function () {
            var $ = layui.jquery, form=layui.form, util=layui.util, table = layui.table;

            table.render({
                elem: '#currentTableId',
                url: '/users/list',
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 80, title: 'ID', sort: true},
                    {field: 'username', width: 135, title: '用户名'},
                    {field: 'sex', width: 80, title: '性别', sort: true},
                    {field: 'mobile', width: 135, title: '手机'},
                    {field: 'integral', width: 80, title: '积分', sort: true},
                    {field: 'last_login_ip', minWidth: 140, title: '上次登录IP'},
                    {field: 'login_count', width: 135, title: '登录次数'},
                    {field: 'last_login_time', minWidth: 165, title: '上次登录时间', templet:function(d){
                         return util.toDateString(d.last_login_time*1000); 
                    }},
                    {field: 'status', minWidth: 80, title: '状态', sort: true,templet:function(d){
                         return d.status == 0 ? "禁用" : "开启";
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
                 window.location.href = '/users/add.html';
            });

            // 监听多选删除操作
            $(".data-delete-btn").on("click", function () {
                var checkStatus = table.checkStatus('currentTableId'), data = checkStatus.data;
                layer.confirm('真的删除行么', function (index) {
                    $.post('delete_all',{data:data}, function (reslut) {
                        var data = JSON.parse(reslut);
                        layer.msg(data.message, {icon: 1,time: 2000}, function () {
                            layer.close(index);
                            window.location.reload();
                        });
                    });
                });
            });

            // 表格操作
            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'edit') {
                     window.location.href = '/users/edit.html?id='+data.id;
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除行么', function (index) {
                        $.post('delete', {id:data.id}, function (reslut) {
                            var data = JSON.parse(reslut);
                            if(data.code==400){
                                layer.msg(data.message, {icon: 1,time: 2000}, function () {
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
<# /block #>s