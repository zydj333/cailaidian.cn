<div class="formbody">
    <div class="formtitle"><span>产品分类修改</span></div>
    <form action="#" method="post" id='product_type_edit_form'>
        <ul class="forminfo">
            <input type="hidden" name="type_id" value="<?php echo $type->id;?>">
            <li><label>分类标题</label><input name="title" type="text" class="dfinput" maxlength="20" value="<?php echo $type->title;?>" /><i>请填写分类的标题（长度不超过20个字符）</i></li>
            <li><label>排序</label><input name="salt" type="number" class="dfinput" maxlength="10" value="<?php echo $type->salt;?>" /><i>填写一个数字作为排序（只能为整数）</i></li>
            <li><label>&nbsp;</label><input id='product_type_edit_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#product_type_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_product_type/edit/" + Math.random(),
                data: $("#product_type_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_product_type/index";
                    }
                }
            });
        });

    });
</script>