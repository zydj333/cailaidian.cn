<div class="formbody">
    <div class="formtitle"><span>修改资讯分类</span></div>
    <form action="" method="post" id='newcate_edit_form'>
        <ul class="forminfo">
                    <input name="ac_id" value="<?php echo $category->ac_id; ?>" type="hidden"/>
                    <li><label>分类名称</label><input name="name" type="text" class="dfinput" maxlength="30" value="<?php echo $category->name ?>"/></li>
                    <li><label>排序</label><input name="listorder" type="text" class="dfinput" value="<?php echo $category->listorder ?>"/></li>
                    <li><label>&nbsp;</label><input id='newcate_edit_button' type="button" class="btn" value="确认修改"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript" src="/static/admin/js/ajaxfileupload.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#newcate_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_newcate/edit/" + Math.random(),
                data: $("#newcate_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_newcate/index";
                    }
                }
            });
        });  
    });
</script>