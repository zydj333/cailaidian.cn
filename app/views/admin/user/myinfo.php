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
            <div class="formtitle"><span>修改我的账户信息</span></div>
            <form action="/admin_user/editMyInfo" method="post" id='user_editMyInfo_form'>
                <ul class="forminfo">
                    <li><label>登录帐号</label><input name="account" type="text" class="dfinput" maxlength="20" value="<?php echo $userinfo->account; ?>" /><i>登录帐号信息（此项不可修改）</i></li>
                    <li><label>用户名称</label><input name="username" type="text" class="dfinput"  maxlength="20" value="<?php echo $userinfo->username; ?>" /><i>登录帐号信息（长度不超过20个字符）</i></li>
                    <li><label>邮箱地址</label><input name="email" type="text" class="dfinput"  maxlength="64"  value="<?php echo $userinfo->email; ?>"/><i>填写使用者的联系邮箱地址</i></li>
                    <li><label>联系电话</label><input name="telephone" type="text" class="dfinput"  maxlength="11" value="<?php echo $userinfo->telephone; ?>" /><i>填写使用者的联系手机号码(11个字符长度)</i></li>
                    <li><label>&nbsp;</label><input id='user_editMyInfo_button' type="button" class="btn" value="确认保存"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#user_editMyInfo_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_user/editMyInfo/" + Math.random(),
                data: $("#user_editMyInfo_form").serialize(),
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