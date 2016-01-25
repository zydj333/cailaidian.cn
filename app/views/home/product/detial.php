<!--下面是主要内容-->
<div class="xintuo_content">
    <div class="xintuo_sd">
        <div class="xintuo_sdc1 f-fl">
            <h2 class="tl"><?php echo $product->product_name; ?><img src="<?php echo base_url(); ?>static/home/image/baoxiao.png" alt=""/></h2>
            <div>
                <table class="xintuo_sdc1_tb">
                    <tr>
                        <td class="style1">收益类型&nbsp;:&nbsp;</td>
                        <td class="style2"><?php echo $product->earning; ?></td>
                        <td class="style1">年化收益&nbsp;:&nbsp;</td>
                        <td class="style2"><?php echo $product->interest_area; ?></td>
                    </tr>
                    <tr>
                        <td class="style1">付息方式&nbsp;:&nbsp;</td>
                        <td class="style2"><?php echo $product->pay_way; ?></td>
                        <td class="style1">产品期限&nbsp;:&nbsp;</td>
                        <td class="style2"><?php echo $product->month; ?>个月</td>
                    </tr>
                    <tr>
                        <td class="style1">大小配比&nbsp;:&nbsp;</td>
                        <td class="style2"><?php echo $product->comparison; ?></td>
                        <td class="style1">发行费用&nbsp;:&nbsp;</td>
                        <td class="style2" style="color:#f1171a;"><?php if (!empty($member)): ?><?php echo $product->fee_area; ?><?php else: ?><a href="<?php echo base_url('login/index');?>" style=" color:red;">登录可见</a><?php endif; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="style1">
                            <p class="f-fl" style="margin-left:14px;">募集进度&nbsp;:&nbsp;</p>
                            <div class="pg-bar f-fl">
                                <div style="width:<?php echo $product->progress; ?>%;height:12px;background:#1dbb86;border-radius:15px;text-align:right;font-size:12px;color:#fff;padding-right:10px;"><p style="line-height:1.2em;"><?php echo $product->progress; ?>%</p></div>
                            </div>
                            <div class="cb"></div>
                            <p class="tl" style="font-size:14px;margin-left:10px;"><?php echo $product->support_log; ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <span>财来电点评：<b>融资方记录良好，担保方提供无限连带责任担保！</b></span>
            </div>
            <div class="cb"></div>
        </div>
        <div class="xintuo_sdc2 f-fr">
            <p>咨询热线&nbsp;:&nbsp;4008-313-618</p>
            <form method="post" action="<?php echo base_url('product/bootOrder'); ?>" id="boot_account">
                <input type="hidden" name="product_id" id="product_id" value="<?php echo $product->id;?>" />
                <input type="text" name="username" style="background:url(<?php echo base_url(); ?>static/home/image/yuyue_inp_bg_06.png) no-repeat" class="xintuo_sdc2_ipt_t"/>
                <input type="text" name="cellphone" style="background:url(<?php echo base_url(); ?>static/home/image/yuyue_inp_bg_09.png) no-repeat" class="xintuo_sdc2_ipt_t"/>
                <input type="text" name="amount" style="background:url(<?php echo base_url(); ?>static/home/image/yuyue_inp_bg_11.png) no-repeat" class="xintuo_sdc2_ipt_t"/>
                <textarea placeholder="顾客填写备注信息&nbsp;:&nbsp;" class="xintuo_sdc2_ta" name="description"></textarea>
                <?php if(!empty($member)):?><input type="button" value="立即预约" id="boot_button" class="xintuo_sdc2_ipt_btn"/><?php else:?><input type="button" class="xintuo_sdc2_ipt_btn" value="请登录后再预约" onclick="return loginUrl();" /><?php endif;?>
            </form>
        </div>
        <div class="cb"></div>
    </div>
    <div class="xintuo_mn">
        <div class="xintuo_mn_nav">
            <h4>产品详情</h4>
            <ul>
                <li><a href="#" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_27.png) no-repeat;">一键分享</a></li>
                <li><a href="<?php echo base_url('download/index?type=').base64_encode($product->id);?>" target="_blank" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_25.png) no-repeat;">资料下载</a></li>
                <li><a href="<?php echo base_url('center/contract'); ?>" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_23.png) no-repeat;">合同申请</a></li>
                <li><a href="<?php echo base_url('center/trade'); ?>" style="background:url(<?php echo base_url(); ?>static/home/image/nav_btn_bg_21.png) no-repeat;">我要报单</a></li>
            </ul>
            <div class="cb"></div>
        </div>
        <div>
            <table class="xintuo_mn_tb">
                <tr>
                    <td class="kind1">产品名称</td>
                    <td class="kind2"><?php echo $product->product_name; ?></td>
                    <td class="kind1">状态</td>
                    <td class="kind2"><?php if ($product->status == 1): ?>预热中<?php elseif ($product->status == 2): ?>抢购中<?php else: ?>已结束<?php endif; ?></td>
                </tr>
                <tr>
                    <td class="kind1">产品类别</td>
                    <td class="kind2"><?php echo $product->category_name; ?></td>
                    <td class="kind1">本期起售日</td>
                    <td class="kind2"><?php echo date("Y/m/d", $product->start); ?></td>
                </tr>
                <tr>
                    <td class="kind1">发行机构</td>
                    <td class="kind2"><?php echo $product->company; ?></td>
                    <td class="kind1">产品期限</td>
                    <td class="kind2"><?php echo $product->month; ?>个月</td>
                </tr>
                <tr>
                    <td class="kind1">资金规模</td>
                    <td class="kind2"><?php echo $product->amount; ?>万</td>
                    <td class="kind1">认购起点</td>
                    <td class="kind2"><?php echo $product->support_limit; ?>万</td>
                </tr>
                <tr>
                    <td class="kind1">投资领域</td>
                    <td class="kind2"><?php echo $product->tender_area; ?></td>
                    <td class="kind1">投资区域</td>
                    <td class="kind2"><?php echo $product->province_name . ',' . $product->city_name; ?></td>
                </tr>
                <tr>
                    <td class="kind1">融资主体</td>
                    <td class="kind2"><?php echo $product->mainpart; ?></td>
                    <td class="kind1">付息方式</td>
                    <td class="kind2"><?php echo $product->pay_way; ?></td>
                </tr>
                <tr>
                    <td class="kind1">抵/质押率</td>
                    <td class="kind2"><?php echo $product->mortgage; ?>%</td>
                    <td class="kind1">收益明细</td>
                    <td class="kind2" style="color:#f1171a;">
                        <?php if (!empty($product->items)): ?>
                            <?php foreach ($product->items as $key => $value): ?>
                                <?php echo $value->buy_total . '&nbsp;' . $value->interest . '%<br/>'; ?>
                            <?php endforeach; ?>    
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="kind1">募集账号</td>
                    <td class="kind2" colspan="3"><?php echo str_replace("\n", "<br/>", $product->account); ?></td>
                </tr>
                <tr>
                    <td class="kind1">资金用途</td>
                    <td class="kind2" colspan="3"><?php echo str_replace("\n", "<br/>", $product->use_for); ?></td>
                </tr>
                <tr>
                    <td class="kind1">还款来源</td>
                    <td class="kind2" colspan="3"><?php echo str_replace("\n", "<br/>", $product->repayment_from); ?></td>
                </tr>
                <tr>
                    <td class="kind1">风控措施</td>
                    <td class="kind2" colspan="3"><?php echo str_replace("\n", "<br/>", $product->risk_control); ?></td>
                </tr>
                <tr>
                    <td class="kind1">项目亮点</td>
                    <td class="kind2" colspan="3"><?php echo str_replace("\n", "<br/>", $product->highlights); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="cb"></div>
</div>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=twitter"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/home/js/product.js"></script>