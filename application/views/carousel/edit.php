<# extends carousel/from #>

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
    <script type="text/javascript">
        function child(obj){
            console.log(obj);//获取父界面的传值
            $('input[name=id]').val(obj.id);
            $('input[name=category]').val(obj.category);
            $('input[name=name]').val(obj.name);
            $('input[name=description]').val(obj.description);
            $('input[name=url]').val(obj.url);
            $('input[name=target]').val(obj.target);
            $('input[name=image]').val(obj.image);
            $('input[name=sort_order]').val(obj.sort_order);
            $('input[name=status]').val(obj.status);
        }
        layui.use(['form', 'layedit', 'laydate', 'upload'], function () {
            var form = layui.form, layer = layui.layer, upload  = layui.upload;
            //自定义验证规则
            form.verify({
                category: function (value) {
                    if (value.length < 2) {
                        return '分类至少得2个字符啊';
                    }
                },
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
                image: function (value) {
                    if (value.length < 5) {
                        return '图片至少得5个字符啊';
                    }
                },
                sort_order: function (value) {
                    if (value.length < 1) {
                        return '排序至少得1个字符';
                    }
                }
            });

            var uploadInst = upload.render({
                elem: '#url' //绑定元素
                ,url: '/upload/do_upload' //上传接口
                ,method: 'POST'
                ,multiple: true
                ,accept: 'file'
                ,data: {}
                ,before: function(obj){
                    index = layer.load();
                },
                done: function(res){ //上传完毕回调
                    layer.close(index);
                    $('input[name=url]').val(res.data);
                    $('input[name=image]').val(res.data);
                    layer.msg(res.message);
                }
                ,error: function(data){ //请求异常回调
                    layer.alert(JSON.stringify(data));
                }
            });
            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                $.post("/carouse/edit", {data:data.field}, function(reslut){
                    var data = JSON.parse(reslut);
                    layer.msg(data.message, {icon: 1,time: 2000 }, function(){
                        parent.location.reload()//刷新父亲对象（用于框架）
                    });
                });
                return false;
            });
        });
    </script>
<# /block #>