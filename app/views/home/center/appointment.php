<!--主栏-->
<div class="yuyue_mn f-fr bg_ff">
    <div class="yuyue_mn_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">我的预约</p>
        <div class="cb"></div>
    </div>
    <?php if (!empty($list)): ?>
        <?php foreach ($list as $key => $value): ?>
            <div class="yuyue_mn_cont">
                <div class="yuyue_mn_cont_detail">
                    <div class="f-fl">
                        <div class="yuyue_mn_cont_tt">
                            <h2 class="tl f-fl"><a href="<?php echo base_url('product/detial') . '/' . $value->pid; ?>" target="_blank"><?php echo $value->product_name; ?></a></h2>
                            <img src="<?php echo base_url(); ?>static/home/image/baoxiao_icon.png" alt="包销图标" class="f-fl ml30"/> 
                            <div class="cb"></div>                                   
                        </div>
                        <div class="yuyue_mn_cont_xq">
                            <p class="yuyue_mn_xq1" style="background:url(<?php echo base_url() ?>static/home/image/item_sicon_1.png) left no-repeat;"><?php echo $value->month; ?>个月</p>
                            <p class="yuyue_mn_xq2" style="background:url(<?php echo base_url() ?>static/home/image/item_sicon_2.png) left no-repeat;"><?php echo $value->tender_area; ?></p>
                            <p class="yuyue_mn_xq1" style="background:url(<?php echo base_url() ?>static/home/image/item_sicon_3.png) left no-repeat;"><?php echo $value->pay_way; ?></p>
                            <p class="yuyue_mn_xq2" style="background:url(<?php echo base_url() ?>static/home/image/item_sicon_4.png) left no-repeat;"><?php echo $value->interest_area; ?></p>
                            <div class="cb"></div>
                        </div>
                    </div>
                    <div class="f-fl yuyue_mn_cont_user">
                        <p>客户姓名&nbsp;:&nbsp;<span><?php echo $value->username; ?></span></p>
                        <p>预约金额&nbsp;:&nbsp;<span><?php echo $value->amount; ?>万</span></p>
                        <p>手机号码&nbsp;:&nbsp;<span><?php echo $value->telephone; ?></span></p>
                    </div>
                    <div class="f-fl yuyue_mn_cont_beizhu">
                        <p>备注:<?php echo $value->description; ?></p>
                    </div>
                    <div class="cb"></div>
                </div>
                <div class="yuyue_mn_cont_sit f-fr pr">
                    <?php if ($value->is_success == 0): ?>
                        <span class="product_sit ps_waiting">等待处理</span>
                    <?php else: ?>
                        <span class="product_sit ps_handled">已处理</span>
                    <?php endif; ?>
                    <div class="yuyue_mn_cont_sit_2">
                        <a href="<?php echo base_url('center/trade') ?>" class="yuyue_mn_cont_sit_btn">我要报单</a>
                    </div>
                    <div class="cb"></div>
                </div>
                <div class="cb"></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="jfdh_mn_pager">
        <?php echo $pagenation; ?>
    </div>
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>