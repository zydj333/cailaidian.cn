<div class="formbody">
    <div class="formtitle"><span>修改后台用户帐号权限</span></div>
    <form action="/admin_setpower/saveEdit" method="post" id='userpower_edit_form'>
        <ul class="forminfo">
            <input name="user_id" value="<?php echo $user->id; ?>" type="hidden"/>
            <li><label>登录帐号:</label><?php echo $user->account; ?></li>
            <li><label>用户名称:</label><?php echo $user->username; ?></li>
            <li><label>选择权限:</label>
                <div class="vocation">
                    <select class="select1" name="power_id">
                        <option value="0" <?php if ($user->power == 0): ?>selected="selected"<?php endif; ?>>无权限</option>
                        <?php if (!empty($power)): ?>
                            <?php foreach ($power as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>" <?php if ($value->id == $user->power): ?>selected="selected"<?php endif; ?> ><?php echo $value->powername; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </li>
            <li></li>
            <li><label>&nbsp;</label><input id='userpower_edit_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript" src="/static/admin/js/select-ui.min.js"></script>
<link href="/static/admin/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#userpower_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_setpower/saveEdit/" + Math.random(),
                data: $("#userpower_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_setpower/index";
                    }
                }
            });
        });

        $(".select1").uedSelect({
            width: 345
        });
    });
</script>