<# extends user/from #>

<# block cententFrom #>
    <# parent #>
    <# slot title #> 
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 25px;">
            <legend>添加用户</legend>
        </fieldset>
    <# /slot #>
<# /block #>

<# block carouseJs #>
    <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8" ></script>
    <script type="text/javascript">
        layui.use(['form', 'layedit', 'laydate', 'upload'], function () {
            var form = layui.form, layer = layui.layer, upload = layui.upload;

            //自定义验证规则
            form.verify({
                username: function (value) {
                    if (value.length < 2) {
                        return '用户名至少得2个字符啊';
                    }
                },
                mobile: function (value) {
                    if (value.length < 11) {
                        return '手机号得11个字符啊';
                    }
                },
                password: function (value) {
                    if (value.length < 6) {
                        return '密码不能为空，必须要6位';
                    }
                }
            });

            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                $.post('/users/add', {data:data.field}, function (reslut) {
                    var data = JSON.parse(reslut);
                    layer.msg(data.message, {icon: 1,time: 2000}, function(){
                        window.location.href = '/users/index.html';
                    });
                });
                return false;
            });
        });
    </script>
<# /block #>