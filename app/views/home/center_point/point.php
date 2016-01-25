<!--主栏-->
<div class="wdjf_mn f-fr bg_ff">
    <div class="wdjf_mn_tt bg_ff">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">我的积分</p>
        <div class="cb"></div>
    </div>
    <div class="wdjf_mn_cont">
        <p class="wdjf_mn_cont_l f-fl"><i>可兑换积分:
                <font>
                <span class="c_da271f" id="s_integral"><?php echo $info->pointsnow; ?></span>分</font></i>
            <a href="/center_point/exchange" title="" class="icon-btn-mallb">兑换</a> 
            <a href="#" title="" id="usersign" class="icon-btn-malla zhan"><span class="sptxt">签到</span></a>                </p>
        <div class="f-fr wdjf_mn_cont_r">
            <p class="f-fl"><?php echo $info->groupname; ?></p>
            <div class="f-fr ml20">
                <span class="jf_level"><i style="width:<?php echo $info->pointsnow * 100 / $info->maxexp; ?>%;" class="jf_level_sit"></i></span><br/>
                <span><?php echo $info->pointsnow; ?>/<?php echo  $info->maxexp;?></span>
            </div>
        </div>
        <div class="cb"></div>
    </div>
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<script type="text/javascript">
    $("#usersign").live('click', function () {
        $.ajax({
            type: "POST",
            url: "/center_account/sign/" + Math.random(),
            data: {"type": 'sign'},
            dataType: "json",
            success: function (data) {
                if (data.flag == 1) {
                    $.dialog(data.error);
                    location.href = "/center_point/index";
                } else {
                    $.dialog(data.error);
                }
            }
        });
    });
</script>