<# extends menu/from #>

<# block cententFrom #>
    <# parent #>
    <# slot title #> 
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 25px;">
            <legend>编辑信息</legend>
        </fieldset>
    <# /slot #>
<# /block #>

<# block carouseJs #>
    <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8" ></script>
    <script src="/resource/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
    <script type="text/javascript">
        layui.use(['form', 'layedit', 'laydate', 'layuimini'], function () {
            var form = layui.form, layedit = layui.layedit, laydate = layui.laydate, layuimini = layui.layuimini;
            
            //自定义验证规则
            form.verify({
                title: function (value) {
                    if (value.length < 2) {
                        return '标题至少得2个字符啊';
                    }
                },
                href: function (value) {
                    if (value.length < 2) {
                        return 'href号得11个字符啊';
                    }
                },
                nickname: function (value) {
                    if (value.length < 2) {
                        return 'nickname';
                    }
                }
            });

            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                console.log(data.field)
                $.ajax({
                    type: "POST",
                    url: "/menus/editdata?id="+"<?php echo $id;?>",
                    data: {data:data.field},
                    dataType: "json",
                    beforeSend: function (request) {
                        index = layer.load();
                    },
                    success: function (data) {
                        layer.close(index);
                        layer.msg(data.message, {icon: 1,time: 2000}, function(){
                             window.location.href = '/menus/index.html';
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
