<# extends article/from #>

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
    <script type="text/javascript" >
        tinymce.init({
            selector: '#tinymce', //容器，可使用css选择器
            language: 'zh_CN', //调用放在langs文件夹内的语言包
            toolbar: true, //工具栏
            menubar: true, //菜单栏
            branding: false, //右下角技术支持
            inline: false, //开启内联模式
            elementpath: false,
            min_height: 400, //最小高度
            // height: 800, //高度
            skin: 'oxide',
            toolbar_sticky: true,
            visualchars_default_state: true, //显示不可见字符
            image_caption: true,
            paste_data_images: true,
            relative_urls: false,
            // remove_script_host : false,
            removed_menuitems: 'newdocument', //清除“文件”菜单
            plugins: "lists,hr, advlist,anchor,autolink,autoresize,charmap,code,codesample,emoticons,fullscreen,image,media,insertdatetime,link,pagebreak,paste,preview,print,searchreplace,table,textcolor,toc,visualchars,wordcount", //依赖lists插件
            toolbar: 'bullist numlist anchor charmap emoticons fullscreen hr image insertdatetime link media pagebreak paste preview print searchreplace textcolor wordcount',
            //选中时出现的快捷工具，与插件有依赖关系 
            images_upload_url: 'upload/do_upload',
            /*后图片上传接口*/
            /*返回值为json类型 {'location':'uploads/jpg'}*/
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        function getcontent() {
            alert(tinyMCE.activeEditor.getContent());
        }
        /*3、获取不带HTML标记的纯文本内容：
        var activeEditor = tinymce.activeEditor;
        var editBody = activeEditor.getBody();
        activeEditor.selection.select(editBody);
        var text = activeEditor.selection.getContent( {'format' : 'text' } );*/
        function getbody() {
            var activeEditor = tinymce.activeEditor;
            var editBody = activeEditor.getBody();
            activeEditor.selection.select(editBody);
            var text = activeEditor.selection.getContent({
                'format': 'text'
            });
            alert(text);
        }
    </script>
    <script type="text/javascript">
        layui.use(['form', 'layer', 'upload', 'layuimini'], function () {
            var form = layui.form, layer = layui.layer, upload = layui.upload, layuiimini = layui.layuimini;
                
            $('#return1').on('click', function(){
                 parent.location.reload()//刷新父亲对象（用于框架）
            }); 
            //自定义验证规则
            form.verify({
                title: function (value) {
                    if (value.length < 2) {
                        return '标题至少得2个字符啊';
                    }
                },
                author: function (value) {
                    if (value.length < 2) {
                        return '作者至少得2个字符啊';
                    }
                },
                summary: function (value) {
                    if (value.length < 2) {
                        return '简介至少得2个字符啊';
                    }
                },
                content: function (value) {
                    if (value.length < 2) {
                        return '内容至少得2个字符啊';
                    }
                },
                description: function (value) {
                    if (value.length < 5) {
                        return '描述至少得5个字符啊';
                    }
                },
                keywords: function (value) {
                    if (value.length < 1) {
                        return '关键字至少得1个字符';
                    }
                },
                fabulous: function (value) {
                    if (value.length < 1) {
                        return '点赞数至少得1个字符';
                    }
                }
            });
            
            //上传文件
            var uploadInst = upload.render({
                elem: '#image' //绑定元素
                ,url: '/upload/do_upload' //上传接口
                ,method: 'POST'
                ,multiple: true
                ,accept: 'file'
                ,data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>"}
                ,before: function(obj){
                    index = layer.load();
                },
                done: function(res){ //上传完毕回调
                    layer.close(index);
                    $('input[name=image]').val(res.data);
                    $('input[name=photo]').val(res.data);
                    layer.msg(res.msg);
                }
                ,error: function(data){ //请求异常回调
                    layer.alert(JSON.stringify(data));
                }
            });
            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                $.post('/articles/edit', {data:data.field}, function(reslut){
                    var data = JSON.parse(reslut);
                    if(data.code==200){
                        layer.msg(data.message, {icon: 1, time: 2000}, function(){
                            window.location.href = '/articles/index.html';
                        });
                    }else{
                        layer.alert(JSON.stringify(data));
                        console.log(data)
                    }
                });
                return false;
            });
        });
    </script>
<# /block #>