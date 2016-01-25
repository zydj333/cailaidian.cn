<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/common.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/pagerstyles.css"/>
    </head>
    <body>
        <div class="g-doc">
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
                                    <td class="style2" style="color:#f1171a;"><?php if (!empty($member)): ?><?php echo $product->fee_area; ?><?php else: ?><a href="<?php echo base_url('login/index'); ?>" style=" color:red;">登录可见</a><?php endif; ?></td>
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
                    <div class="cb"></div>
                </div>
                <div class="xintuo_mn">
                    <div class="xintuo_mn_nav">
                        <h4>产品详情</h4>
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
        </div>
    </body>
</html>