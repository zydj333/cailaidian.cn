<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript">
            $(function() {
                //顶部导航切换
                $(".nav li a").click(function() {
                    $(".nav li a.selected").removeClass("selected")
                    $(this).addClass("selected");
                })
            })
        </script>
    </head>

    <body style="background:url(/static/admin/images/topbg.gif) repeat-x;">
        <div class="topleft">
            <a href="/" target="_parent"><img src="/static/admin/images/logo.png" title="系统首页" /></a>
        </div>
        <div class="topright">    
            <ul>
                <li><a href="<?php echo base_url(); ?>" target="_blank">站点首页</a></li>
                <li><a href="<?php echo base_url('admin_user/editMyInfo'); ?>" target="rightFrame">账户信息</a></li>
                <li><a href="<?php echo base_url('admin_user/editMyPwd'); ?>" target="rightFrame">修改密码</a></li>
                <li><a href="<?php echo base_url('admin_login/logout'); ?>" target="_parent">退出</a></li>
            </ul>
            <div class="user">
                <span><?php if (isset($userinfo->user_name)): ?><?php echo $userinfo->user_name; ?><?php else: ?>未知用户<?php endif; ?></span>
            </div>    
        </div>
    </body>
</html>