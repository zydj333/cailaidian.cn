<div class="formbody">
    <div class="formtitle"><span>产品分类添加</span></div>
    <form action="#" method="post" id='product_type_add_form'>
        <ul class="forminfo">
            <li><label>分类标题</label><input name="title" type="text" class="dfinput" maxlength="20" /><i>请填写分类的标题（长度不超过20个字符）</i></li>
            <li><label>排序</label><input name="salt" type="number" class="dfinput" maxlength="10" value="0" /><i>填写一个数字作为排序（只能为整数）</i></li>
            <li><label>&nbsp;</label><input id='product_type_add_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#product_type_add_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_product_type/add/" + Math.random(),
                data: $("#product_type_add_form").serialize(),
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