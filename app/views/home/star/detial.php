<!--下面是主要内容-->
<div class="lpd_mn">
    <div>
        <p class="lpd_mn_tt">锦兴美林湖</p>
    </div>
    <div class="lpd_mn_tb">
        <table class="lpd_mn_tb_cont">
            <tr>
                <td style="width:91px;height:43px;">发行机构 :</td>
                <td><?php echo $product->company; ?></td>
                <td style="width:91px;height:43px;">认购起点 :</td>
                <td><?php echo $product->support_limit; ?>万</td>
            </tr>
            <tr>
                <td style="width:91px;height:43px;">产品期限 :</td>
                <td><?php echo $product->month; ?>个月</td>
                <td style="width:91px;height:43px;">资金规模 :</td>
                <td><?php echo $product->amount; ?>万</td>
            </tr>
            <tr>
                <td style="width:91px;height:43px;">投资领域 :</td>
                <td><?php echo $product->tender_area; ?></td>
                <td style="width:91px;height:43px;">年化收益 :</td>
                <td><?php echo $product->interest; ?></td>
            </tr>
            <tr>
                <td style="width:91px;height:43px;">付息方式 :</td>
                <td><?php echo $product->pay_way; ?></td>
                <td style="width:91px;height:43px;">收益明细 :</td>
                <td><?php echo $product->interest_detial; ?></td>
            </tr>
            <tr>
                <td style="width:91px;height:43px;">收益类型 :</td>
                <td><?php echo $product->earning; ?></td>
                <td style="width:91px;height:43px;">发行费用 :</td>
                <td><?php echo $product->fee; ?></td>
            </tr>
            <tr>
                <td style="height:64px;">募资账号 :</td>
                <td colspan="3" style="white-space:normal;text-align:left;"><?php echo str_replace("\n", "<br/>", $product->account); ?></td>
            </tr>
            <tr>
                <td style="height:64px;">资金用途 :</td>
                <td colspan="3" style="white-space:normal;text-align:left;"><?php echo str_replace("\n", "<br/>", $product->use_for); ?></td>
            </tr>
            <tr>
                <td style="padding:26px 0 24px 0;">还款来源 :</td>
                <td colspan="3" style="white-space:normal;text-align:left;"><?php echo str_replace("\n", "<br/>", $product->repayment_from); ?></td>
            </tr>
            <tr>
                <td style="padding:25px 0 40px 0;">风控措施 :</td>
                <td colspan="3" style="white-space:normal;text-align:left;"><?php echo str_replace("\n", "<br/>", $product->risk_control); ?></td>
            </tr>
            <tr>
                <td style="padding:37px 0 102px 0;">项目亮点 :</td>
                <td colspan="3" style="white-space:normal;text-align:left;"><?php echo str_replace("\n", "<br/>", $product->highlights); ?></td>
            </tr>
        </table>
        <!--<div class="lpd_mn_share">
            <ul>
                <li><a href="#" onClick="yuyue()" style="background:url(<?php echo base_url(); ?>static/home/image/lpd_yuyue_btn.png) 50% no-repeat;" class="lpd_mn_share_btn">立即预约</a></li>
                <li><a href="#" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_21.png) 50% no-repeat;" class="lpd_mn_share_btn">我要报单</a></li>
                <li><a href="#" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_23.png) 50% no-repeat;" class="lpd_mn_share_btn">合同申请</a></li>
                <li><a href="#" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_25.png) 50% no-repeat;" class="lpd_mn_share_btn">资料下载</a></li>
                <li><a href="#" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_27.png) 50% no-repeat;" class="lpd_mn_share_btn">一键分享</a></li>
            </ul>
            <div class="cb"></div>
        </div>-->
    </div>
</div>
<!--尾部--> 