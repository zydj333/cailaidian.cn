    <?php if (!empty($member)): ?>
        <!--主栏-->
        <div class="huiyuanzx_mn f-fr bg_ff">
            <div class="huiyuanzx_mn_tt">
                <p class="f-fl inb" style="border-bottom:3px solid #f1070a;">会员中心</p>
                <p class="f-fr inb" style="font-size:12px;color:#f1070a;padding-top:4px;">欢迎您！<?php echo $member->truename; ?></p>
                <div class="cb"></div>
            </div>
            <div class="huiyuanzx_mn_cont_1">
                <form class="f-fl">
                    <p style="margin-bottom:21px;">累计成交额： <span class="c_da271f"><?php echo $member->turnover; ?></span> 万元</p>
                    <p style="margin-bottom:21px;">累计已赚佣金：<span class="c_da271f"><?php echo $member->commission; ?></span> 元</p>
                    <div>
                        <p>可兑换积分:&nbsp;&nbsp;&nbsp;
                            <font>
                                <span class="c_da271f" id="s_integral"><?php echo $member->pointsnow; ?></span>分
                            </font>
                            <a href="/center_point/exchange" title="" class="icon-btn-mallb">兑换</a> 
                            <a href="#" title="" id="usersign" class="icon-btn-malla zhan"><span class="sptxt">签到</span></a>
                        </p>
                        <div class="cb"></div>
                    </div>
                </form>
                <div class="f-fl fs14" style="margin:66px 0 0 40px;">
                    <p style="margin-bottom:21px;">订单数量：<span class="c_da271f"><?php echo $order; ?></span> 条</p>
                    <p>预约订单：<span class="c_da271f"><?php echo $cout; ?></span> 条</p>
                </div>
                <a href="/center/appointment" class="f-fr db" style="margin:18px 38px 17px 0;"><img src="<?php echo base_url() ?>static/home/image/pic_03.jpg" alt="预约"/></a>
                <div class="cb"></div>
            </div>
            <div class="huiyuanzx_mn_cont_2">
                <div class="hyzx_item"><a href="/center_point/exchange" class="f-fl db"><img src="<?php echo base_url() ?>static/home/image/pic_13.jpg" alt="积分"/></a></div>
                <div class="hyzx_item"><a href="/center/commission" class="f-fl db"><img src="<?php echo base_url() ?>static/home/image/pic_15.jpg" alt="佣金"/></a></div>
                <div class="hyzx_item" style="border-right:none;"><a href="/center/contract" class="f-fr db"><img src="<?php echo base_url() ?>static/home/image/pic_17.jpg" alt="合同"/></a></div>
                <p class="cb"></p>
            </div>
            <div class="huiyuanzx_btn f-fr">
            <a href="/center/trade" class="huiyuanzx_btn_baodan">我要报单</a>
            </div>
        </div>    
        <div class="cb"></div>
      </div>
      <div class="cb"></div>
      </div>
<?php endif; ?>
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
                            location.href = "/center/index";
                        } else {
                            $.dialog(data.error);
                        }
                    }
                });
        });
    </script>