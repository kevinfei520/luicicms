<!DOCTYPE html>
<html>
<head>
    <title>LuiciCMS - 基于LUI和CI框架的后台内容管理系统</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
</head>
<body>

    <# block cententFrom #>
        <div class="layuimini-container">
            <div class="layuimini-main">
                <# slot title #> CodeIgniter <# /slot #>

                <blockquote class="layui-elem-quote" style="margin-left: 28px;">
                    |-  表示顶级父级 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  |--   |--   表示二级分类 
                </blockquote>

                <form class="layui-form">

                    <div class="layui-form-item">
                        <label class="layui-form-label">父级名称</label>
                        <div class="layui-input-block">
                            <select id="sePar" name="parentId" lay-verify="required" lay-search="">
                                <?php 
                                    if(isset($parentInfo)) 
                                    {   
                                        if( $parentInfo['parentId'] == '-1' && $parentInfo['isMenu'] == 0)
                                        {
                                            echo '<option value='.$parentId.'>'.'|-'.$parentInfo['authorityName'].'</option>';
                                        }else{
                                            echo '<option value='.$parentId.'>'.'|--|--'.$parentInfo['authorityName'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">权限名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="authorityName" lay-verify="authorityName" autocomplete="off" placeholder="请输入权限名称" class="layui-input" value="<?php if(isset($authorityName)){ echo $authorityName; } ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单URL</label>
                        <div class="layui-input-block">
                            <input type="text" name="menuUrl" lay-verify="menuUrl" autocomplete="off" placeholder="请输入菜单URL" class="layui-input" value="<?php if(isset($menuUrl)){ echo $menuUrl; }?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单图标</label>
                        <div class="layui-input-block">
                            <input type="text" name="menuIcon" lay-verify="menuIcon" autocomplete="off" placeholder="请输入菜单图标" class="layui-input" value="<?php if(isset($menuIcon)){ echo $menuIcon; }?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="orderNumber" lay-verify="orderNumber" autocomplete="off" placeholder="请输入排序" class="layui-input">
                        </div>
                    </div>

                     <div class="layui-form-item">
                        <label class="layui-form-label">是否为菜单</label>
                        <div class="layui-input-block">
                            <input type="radio" name="isMenu" value="1" title="是" checked="">
                            <input type="radio" name="isMenu" value="0" title="否">
                        </div>
                    </div>

                    <!-- <div class="layui-form-item">
                        <label class="layui-form-label">checked</label>
                        <div class="layui-input-block">
                            <input type="text" name="checked" lay-verify="checked" autocomplete="off" placeholder="请输入checked" class="layui-input">
                        </div>
                    </div> -->

                    <div class="layui-form-item">
                        <label class="layui-form-label">authority</label>
                        <div class="layui-input-block">
                            <input type="text" name="authority" lay-verify="authority" autocomplete="off" placeholder="请输入authority" class="layui-input" 
                            value=" <?php if(isset($authority) ) { echo $authority ;}?>" 
                            >
                        </div>
                    </div>

                    <input class="layui-input" type="text" name="authorityId" style="display: none;" value="<?php if(isset($authorityId)){echo $authorityId;}?>">

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            <button id="return1" class="layui-btn layui-btn-primary" >返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <# /block #>

    <# block carouseJs #>CodeIgniter<# /block #>
    
    <script type="text/javascript">
        $('#return1').on('click', function(){
             parent.location.reload()//刷新父亲对象（用于框架）
        });
    </script>
</body>
</html>
