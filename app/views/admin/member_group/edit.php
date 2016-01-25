<div class="formbody">
    <div class="formtitle"><span>修改分组</span></div>
    <form action="" method="post" id='group_edit_form'>
        <ul class="forminfo">
            <input name="id" value="<?php echo $group->id; ?>" type="hidden"/>
            <li><label>用户组名称</label><input name="groupname" type="text" class="dfinput" maxlength="30" value="<?php echo $group->groupname ?>"/></li>
            <li><label>下限积分</label><input name="minexp" type="text" class="dfinput" maxlength="30" value="<?php echo $group->minexp ?>"/></li>
            <li><label>上限积分</label><input name="maxexp" type="text" class="dfinput" maxlength="30" value="<?php echo $group->maxexp ?>"/></li>
            <li><label>排序</label><input name="listorder" type="text" class="dfinput" maxlength="30" value="<?php echo $group->listorder ?>"/></li>
            <li><label>折扣</label><input name="discount" type="text" class="dfinput" maxlength="30" value="<?php echo $group->discount ?>"/></li>
            <li><label>&nbsp;</label><input id='group_edit_button' type="button" class="btn" value="确认修改"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#group_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_member_group/edit/" + Math.random(),
                data: $("#group_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_member_group/index";
                    }
                }
            });
        });  
    });
</script>