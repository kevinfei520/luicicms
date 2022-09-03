<# extends product/from #>

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
    <script type="text/javascript" src="/resource/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
    <script type="text/javascript">
     
        layui.use(['form', 'layer', 'upload', 'layuimini'], function () {
            var form = layui.form, layer = layui.layer, upload = layui.upload, layuiimini = layui.layuimini;

            //自定义验证规则
            form.verify({
                title: function (value) {
                    if (value.length < 2) {
                        return '商品名称至少得2个字符啊';
                    }
                },
                price: function (value) {
                    if (value.length < 0) {
                        return '商品价格多少给个价格啊';
                    }
                },
                name: function (value) {
                    if (value.length < 2) {
                        return '企业名称至少得2个字符啊';
                    }
                },
                phone: function (value) {
                    if (value.length < 2) {
                        return '联系方式至少得2个字符啊';
                    }
                },
                purl: function (value) {
                    if (value.length < 5) {
                        return '商品链接至少得5个字符啊';
                    }
                }
            });

            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                $.post( "/products/edit", {data:data.field}, function (reslut) {
                    console.log(reslut);
                    var data = JSON.parse(reslut);
                    layer.msg(data.message, {icon:1,time:2000}, function(){
                        window.location.href = '/products/index.html';
                    });
                });
                return false;
            });
        });
    </script>
<# /block #>