<# extends category/from #>

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
        layui.use(['form', 'layedit', 'laydate', 'upload'], function () {
            var form = layui.form, layer = layui.layer, upload  = layui.upload;
            //自定义验证规则
            form.verify({
                name: function (value) {
                    if (value.length < 2) {
                        return '名称至少得2个字符啊';
                    }
                },
                description: function (value) {
                    if (value.length < 2) {
                        return '描述至少得2个字符啊';
                    }
                },
                url: function (value) {
                    if (value.length < 2) {
                        return '链接至少得2个字符啊';
                    }
                },
                target: function (value) {
                    if (value.length < 2) {
                        return '打开方式至少得2个字符啊';
                    }
                },
                sort_order: function (value) {
                    if (value.length < 1) {
                        return '排序至少得1个字符';
                    }
                }
            });

            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                $.post('/categorys/add',{data:data.field},function (reslut) {
                    var data = JSON.parse(reslut);
                    layer.msg(data.message, {icon: 1, time: 2000 }, function(){
                        parent.GetValue('true');
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    });
                });
                return false;
            });
        });
    </script>
<# /block #>