<div class="formbody">
    <div class="formtitle"><span>修改后台用户帐号</span></div>
    <form action="/admin_user/edit" method="post" id='user_edit_form'>
        <ul class="forminfo">
            <input name="user_id" value="<?php echo $user->id;?>" type="hidden"/>
            <li><label>登录帐号</label><input name="account" value="<?php echo $user->account;?>" type="text" class="dfinput" maxlength="20" readonly="readonly" /><i>登录帐号信息（长度不超过20个字符,不可更改）</i></li>
            <li><label>用户名称</label><input name="username" value="<?php echo $user->username;?>" type="text" class="dfinput"  maxlength="20" /><i>登录帐号信息（长度不超过20个字符）</i></li>
            <li><label>邮箱地址</label><input name="email" value="<?php echo $user->email;?>" type="text" class="dfinput"  maxlength="64" /><i>填写使用者的联系邮箱地址</i></li>
            <li><label>联系电话</label><input name="telephone" value="<?php echo $user->telephone;?>" type="text" class="dfinput"  maxlength="11" /><i>填写使用者的联系手机号码(11个字符长度)</i></li>
            <li><label>&nbsp;</label><input name="user_edit_button" id='user_edit_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#user_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_user/edit/" + Math.random(),
                data: $("#user_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_user/index";
                    }
                }
            });
        });

    });
</script>