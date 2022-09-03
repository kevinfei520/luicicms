<# extends rule/from #>

<# block cententFrom #>
    <# parent #>
    <# slot title #> 
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 25px;">
            <legend>添加规则</legend>
        </fieldset>
    <# /slot #>
<# /block #>

<# block carouseJs #>
    <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8" ></script>
    <script type="text/javascript">
        $(function(){
            $.ajax({
                 type: "POST",
                 url: "/rules/getparentrule",
                 data: {},
                 dataType: "json",
                 success: function(data){
                    var rulesArr = data.data;
                    for (let index = 0; index < rulesArr.length; index++) {
                         if( rulesArr[index].parentId == '-1' )
                         {  
                             var childStr = '';
                             var pstr = '<option value="'+rulesArr[index].authorityId+'">' + '|- &nbsp;' + rulesArr[index].authorityName + '</option>'; 
                             for (let j = 0; j < rulesArr.length; j++) {
                                 if( rulesArr[j].parentId == rulesArr[index].authorityId)
                                 {  
                                    
                                     childStr += '<option value="'+rulesArr[j].authorityId+'">' + '|-- &nbsp;|-- &nbsp;' + rulesArr[j].authorityName + '</option>'; 
                                 }
                             }
                             $('#sePar').append( pstr+childStr) ;  
                             layui.form.render("select");
                         }
                    }
                 }
            });
        });

        layui.use(['form', 'layer'], function () {
            var form = layui.form
                , layer = layui.layer;

            //自定义验证规则
            form.verify({
                authorityName: function (value) {
                    if (value.length < 2) {
                        return '标题至少得2个字符啊';
                    }
                }
            });
            
            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                console.log(data)
                $.ajax({
                    type: "POST",
                    url: "/rules/addruledata",
                    data: {data:data.field},
                    dataType: "json",
                    beforeSend: function (request) {
                        index = layer.load();
                    },
                    success: function (data) {
                        layer.close(index);
                        layer.msg(data.message, { icon: 1, time: 2000}, function(){
                            window.location.href = '/rules/index.html';
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
<# /block #>s