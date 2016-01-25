<div class="formbody">
    <div class="formtitle"><span>添加分组</span></div>
    <form action="" method="post" id='group_add_form'>
        <ul class="forminfo">
            <li><label>用户组名称</label><input name="groupname" type="text" class="dfinput" maxlength="30" /></li>
            <li><label>下限积分</label><input name="minexp" type="text" class="dfinput" maxlength="30" /></li>
            <li><label>上限积分</label><input name="maxexp" type="text" class="dfinput" maxlength="30" /></li>
            <li><label>排序</label><input name="listorder" type="text" class="dfinput" maxlength="30" value="255"/></li>
            <li><label>折扣</label><input name="discount" type="text" class="dfinput" maxlength="30" /></li>
            <li><label>&nbsp;</label><input id='group_add_button' type="button" class="btn" value="确认添加"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
                        $(document).ready(function(e) {
                            $("#group_add_button").click(function() {
                                $.ajax({
                                    type: "POST",
                                    url: "/admin_member_group/add/" + Math.random(),
                                    data: $("#group_add_form").serialize(),
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
                            })
                        });
</script>