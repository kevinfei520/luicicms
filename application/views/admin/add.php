<# extends admin/from #>

<# block cententFrom #>
    <# parent #>
    <# slot title #>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 25px;">
            <legend>添加信息</legend>
        </fieldset>
    <# /slot #>
<# /block #>

<# block carouseJs #>
    <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8" ></script>
    <script type="text/javascript">
        layui.use(['form', 'layer', 'layedit', 'laydate'], function () {
            var form = layui.form, layer = layui.layer, layedit = layui.layedit, laydate = layui.laydate;

            //自定义验证规则
            form.verify({
                username: function (value) {
                    if (value.length < 2) {
                        return '管理员名称需要至少2个字符啊';
                    }
                },
                mobile: function (value){
                    if (value.length < 10) {
                        return '手机号需要11个字符啊';
                    }
                },
                email: function (value) {
                    if (value.length < 2) {
                        return '邮箱至少得2个字符啊';
                    }
                }
            });
            $(function(){
                $.post("/admins/getAuthGroup",{},function(result){
                    console.log(result);
                    result = JSON.parse(result)
                    var res = result.data;  var str = '';
                    for (var i=0; i < res.length; i++){
                        str += '<option value="'+res[i].id+'">'+res[i].name+'</option>';
                    }
                    $('select[name=permission_group]').append(str);
                    layui.form.render("select");
                });
            });

            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                $.ajax({
                    type: "POST",
                    url: "/admins/add",
                    data: {data:data.field},
                    dataType: "json",
                    beforeSend: function (request) {
                        sub = layer.load();
                    },
                    success: function (data) {
                        layer.close(sub);
                        layer.msg(data.message, {icon: 1,time: 2000 }, function(){
                            window.location.href = '/admins/index.html';
                        });
                    },
                    error: function (data) {
                        layer.alert(JSON.stringify(data));
                        console.log(data)
                    }
                });
                return false;
            });
        });
    </script>
<# /block #>
