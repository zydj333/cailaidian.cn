<!--下面是主要内容-->
<script type="text/javascript" src="<?php echo base_url('static/home/'); ?>/js/list.min.js"></script>
<!--筛选开始--> 
<div class="sx">
    <!--搜索框-->
    <div class="sch">
        <div class="sch-tt f-fl">搜索结果</div>
        <div class="f-fr">
            <p class="sch_p f-fl">产品关键字 :</p>
            <div class="f-fr">
                <form method="post" action="<?php echo base_url('product/search');?>">
                    <input type="text" class="sch_p_ipt_t" name="keywords" value="<?php echo $keyword;?>"/>
                    <input type="submit" value="" class="sch_p_ipt_btn"/>
                </form>
            </div>
        </div>
        <div class="cb"></div>
    </div>
</div>
<div class="g-mn">
    <div id="cptab_xt">
        <!--信托-->
        <object class="divxz">
            <div class="m-mnc-2">    
                <?php if (!empty($product)): ?>
                    <?php foreach ($product as $key => $value): ?>
                        <div class="item-<?php echo $key+1;?> f-fl">
                            <table >
                                <tr>
                                    <td rowspan="5" style="width:582px;">
                                        <div class="table-mn">
                                            <div class="table-mn-tt">
                                                <h2 class="tl"><a href="<?php echo base_url('product/detial') . '/' . $value->id; ?>" target="_blank"><?php echo $value->product_name; ?></a></h2>
                                                <img src="<?php echo base_url(); ?>static/home/image/baoxiao_icon.png" alt="包销图标"/></div>
                                            <div class="table-mn-list">
                                                <div class="mt20">
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_1.png) 0% 50% no-repeat;"><?php echo $value->month; ?>个月</p>
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_2.png) 0% 50% no-repeat;"><?php echo $value->tender_area; ?></p>
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_3.png) 0% 50% no-repeat;"><?php echo $value->pay_way; ?></p>
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_4.png) 0% 50% no-repeat;"><?php echo $value->interest_area; ?></p>
                                                    <div class="cb"></div>
                                                </div>
                                            </div>
                                            <div class="table-mn-progress mt20">
                                                <p class="f-fl" style="color:#f63e4f;font-size:12px;">募集进度:</p>
                                                <div class="pg-bar f-fr">
                                                    <div style="width:<?php echo $value->progress; ?>%;height:12px;background:#1dbb86;border-radius:15px;text-align:right;font-size:12px;color:#fff;padding-right:10px;"><p style="line-height:1.2em;"><?php echo $value->progress; ?>%</p></div>
                                                </div>
                                                <div class="cb"></div>
                                            </div>
                                            <div class="table-mn-update">
                                                <p class="tl"><?php echo $value->support_log; ?></p>
                                            </div>
                                            <div class="cb"></div>
                                        </div>                          
                                    </td>
                                    <td height="39px"><b>认购金额</b></td>
                                    <td><b>预期收益</b></td>
                                    <td><b>返佣比例</b></td>
                                </tr>
                                <?php if (!empty($value->items)): ?>
                                    <?php foreach ($value->items as $items_key => $items_value): ?>
                                        <tr>
                                            <td height="39px"><?php echo $items_value->buy_total; ?></td>
                                            <td><?php echo $items_value->interest; ?>%</td>
                                            <td><?php if (!empty($memeber)): ?><?php echo $items_value->fee; ?>%<?php else: ?><a href="<?php echo base_url('login/index'); ?>" style="color:#f1171a">登陆可见</a><?php endif; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="f-fl ml30"><a href="<?php echo base_url('download/index?type=') . base64_encode($value->id); ?>" target="_blank" class="data-btn tc">资料下载</a></div>
                                        <div class="f-fr">
                                            <div class="f-fl mr24"><a href="javascript:void(0);" onclick="return getMail(<?php echo $value->id; ?>)"  class="email-btn">发送邮件</a></div>
                                            <div class="f-fr mr30"><a href="<?php echo base_url('product/detial') . '/' . $value->id; ?>" target="_blank" class="order-btn">立即预约</a></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="cb"></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="cb"></div>
            </div>
        </object>
    </div>
</div>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=twitter"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/getmail.js" ></script>