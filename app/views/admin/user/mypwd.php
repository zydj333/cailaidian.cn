<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
    </head>
    <body>
        <div class="formbody">
            <div class="formtitle"><span>修改我的登录密码</span></div>
            <form action="/admin_user/editMyInfo" method="post" id='user_editMyPwd_form'>
                <ul class="forminfo">
                    <li><label>初始密码</label><input name="password" type="password" class="dfinput" maxlength="20" value="" /><i>当前登录密码</i></li>
                    <li><label>新密码</label><input name="newpassword" type="password" class="dfinput"  maxlength="20" value="" /><i>设置一个新的登录密码（可以是数字字母下划线组合）</i></li>
                    <li><label>新密码确认</label><input name="renewpassword" type="password" class="dfinput"  maxlength="64"  value=""/><i>再次输入新登录密码</i></li>
                    <li><label>&nbsp;</label><input id='user_editMyPwd_button' type="button" class="btn" value="确认保存"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#user_editMyPwd_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_user/editMyPwd/" + Math.random(),
                data: $("#user_editMyPwd_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href="/admin_index/main";
                    }
                }
            });
        });
    });
</script>