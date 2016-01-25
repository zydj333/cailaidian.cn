<!--主栏-->
<div class="xgmm_mn f-fr bg_ff">
    <div class="xgmm_mn_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">修改密码</p>
        <div class="cb"></div>
    </div>
    <div class="xgmm_mn_cont">
        <form id="modify_form">
            <div style="width:570px;margin-bottom:22px;">
                <p class="f-fl">输入旧密码&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <input id="oldPassword" type="password" name="password" class="xgmm_mn_cont_ipt"/>
                <span style=""></span>
                <div class="cb"></div>
            </div>
            <div style="width:570px;margin-bottom:22px;">
                <p class="f-fl">输入新密码&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <input id="newPassword" type="password" name="newPassword" class="xgmm_mn_cont_ipt"/>
                <span style=""></span>
                <div class="cb"></div>
            </div>
            <div style="width:570px;margin-bottom:22px;">
                <p class="f-fl">确认新密码&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <input type="password" name="confirmPassword" class="xgmm_mn_cont_ipt"/>
                <span style=""></span>
                <div class="cb"></div>
            </div>
            <a href="javascript:void(0)" id="btnSubmit" class="xgmm_mn_cont_btn">确认修改</a>
        </form> 
    </div>

</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<script type="text/javascript">
    $(function() {
        //提交表单
        $("#btnSubmit").click(function() {
            $.ajax({
                type: "POST",
                url: "/center_account/checkNewPassword/" + Math.random(),
                data: $("#modify_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        $.dialog(data.error);
                        location.href = "/login/index";
                    } else {
                        $.dialog(data.error);
                    }
                }
            });
        });
    });

</script>