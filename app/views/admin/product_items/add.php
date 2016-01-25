<div class="formbody">
    <div class="formtitle"><span>产品分类添加</span></div>
    <form action="#" method="post" id='product_items_add_form'>
        <ul class="forminfo">
            <li><label>产品ID</label><input name="product_id" id="product_id" type="text" class="dfinput" maxlength="20" readonly="readonly" value="<?php echo $product_id;?>" /><i>不可修改，系统默认选择</i></li>
            <li><label>购买金额区间</label><input name="buy_total" type="text" class="dfinput" maxlength="20" /><i>填写区间如（100万≤X＜300万）</i></li>
            <li><label>收益年化</label><input name="interest" type="text" class="dfinput" maxlength="20" /><i>只能填写数字如（9.8）</i></li>
            <li><label>返佣比例</label><input name="fee" type="text" class="dfinput" maxlength="20" /><i>只能填写数字如（1.5）</i></li>
            <li><label>&nbsp;</label><input id='product_items_add_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#product_items_add_button").click(function() {
            var product_id=$("#product_id").val();
            $.ajax({
                type: "POST",
                url: "/admin_product_items/add/" + Math.random(),
                data: $("#product_items_add_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_product_items/index/"+product_id;
                    }
                }
            });
        });

    });
</script>