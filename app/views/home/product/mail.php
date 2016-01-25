<div style="font-size: 16px;">
    <li style=" text-align: center; width: 400px;"><img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" /></li>
    <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
    <li><lable>收件邮箱：<input type="text" placeholder="请填写邮箱地址" name="email" id="email" style="width: 350px;height: 35px;border:1px solid #b6b1b1;line-height: 35px;padding-left: 15px;font-size: 15px;"/></lable></li>
<li style=" text-align: center;padding-top: 50px; width: 400px;"><a href="javascript:void(0);" onclick="return submit_getMail();" style="height: 48px;line-height: 48px;border-radius: 5px;border: 1px solid #fe3638; background-color: #f73e50; color: white;padding: 5px 85px;">发送邮件</a></li>
</div>
<script type="text/javascript">
    function submit_getMail() {
        var product_id = $('#product_id').val();
        var email = $('#email').val();
        $("#loading").show();
        $.ajax({
            type: "POST",
            url: "/product/sendEmail/" + Math.random(),
            data: {"product_id": product_id, "email": email},
            dataType: "json",
            success: function(data) {
                $("#loading").hide();
                if (data.flag === 1) {
                    $.dialog(data.error);
                } else {
                    $.dialog({
                        time: 2,
                        content: data.error
                    });
                }
            }
        });
    }
</script>