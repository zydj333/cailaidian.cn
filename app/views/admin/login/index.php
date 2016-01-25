<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>欢迎登录后台管理系统</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="/static/admin/js/jquery.js"></script>
        <script src="/static/admin/js/cloud.js" type="text/javascript"></script>
        <script language="javascript">
            $(function() {
                $('.loginbox').css({'position': 'absolute', 'left': ($(window).width() - 692) / 2});
                $(window).resize(function() {
                    $('.loginbox').css({'position': 'absolute', 'left': ($(window).width() - 692) / 2});
                })
            });
        </script> 
    </head>
    <body style="background-color:#1c77ac; background-image:url(/static/admin/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
        <div id="mainBody">
            <div id="cloud1" class="cloud"></div>
            <div id="cloud2" class="cloud"></div>
        </div>  
        <div class="logintop">    
            <span>欢迎登录后台管理界面平台</span>    
            <ul>
                <li><a href="#">回首页</a></li>
                <li><a href="#">帮助</a></li>
                <li><a href="#">关于</a></li>
            </ul>    
        </div>
        <div class="loginbody">
            <span class="systemlogo"></span>
            <form action="" method="post" id="login_form">
                <div class="loginbox">
                    <ul>
                        <li><input name="account" type="text" class="loginuser" value="请输入帐号" onfocus="if (this.value == '请输入帐号') {
                                    this.value = '';
                                }" onblur="if (this.value == '') {
                                            this.value = '请输入帐号';
                                        }"  /></li>
                        <li><input name="password" type="password" class="loginpwd" value=""/></li>
                        <li>
                            <input type="button" class="loginbtn" value="登录" id="login_button"/>
                            <label>
                                <input name="remember" type="checkbox" value="1" checked="checked" />记住密码
                            </label>
                            <label><a href="#">忘记密码？</a></label>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="loginbm">版权所有  2014-2015  Aman 仅供学习交流，勿用于任何商业用途</div>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
    $(function(e) {
        $("#login_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_login/doLogin/" + Math.random(),
                data: $("#login_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_index/index";
                    }
                }
            });
        });
    });
</script>