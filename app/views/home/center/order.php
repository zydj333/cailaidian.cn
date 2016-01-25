<!--主栏-->
<div class="dingdan_mn f-fr bg_ff">
    <div class="dingdan_mn_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">订单详情</p>
        <div class="cb"></div>
    </div>
    <div id="cptab">
        <h2 class="dingdan_mn_tab">
            <b>
                <ul>
                    <a href="<?php echo base_url('center/order');?>?status=0"><li <?php if ($status == 0): ?>class="lixz"<?php endif; ?>>待审核订单（<?php echo $order_wait->total_count; ?> )</li></a>
                    <a href="<?php echo base_url('center/order');?>?status=1"><li <?php if ($status == 1): ?>class="lixz"<?php endif; ?>>已通过订单（<?php echo $order_success->total_count; ?>）</li></a>
                    <a href="<?php echo base_url('center/order');?>?status=2"><li <?php if ($status == 2): ?>class="lixz"<?php endif; ?>>已驳回订单（<?php echo $order_faild->total_count; ?>）</li></a>
                    <a href="<?php echo base_url('center/order');?>?status=3"><li <?php if ($status == 3): ?>class="lixz"<?php endif; ?>>所有订单（<?php echo $order_all->total_count; ?>）</li></a>
                </ul>
            </b>
        </h2>  
        <!--所有订单-->
        <object class="divxz">  
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <div class="dingdan_item">
                        <div class="dingdan_item_cont f-fl">
                            <div class="dingdan_item_cont_tt">
                                <h2 class="tl f-fl"><a href="<?php echo base_url('product/detial') . '/' . $value->product_id; ?>"><?php echo $value->product_name; ?></a></h2>
                                <img src="<?php echo base_url() ?>static/home/image/baoxiao_icon.png" alt="包销图标" class="f-fl ml30"/> 
                                <div class="cb"></div>                                   
                            </div>
                            <div class="dingdan_item_cont_itd">
                                <p class="ddicon1 f-fl"><?php echo $value->name; ?></p>
                                <p class="ddicon2 f-fl"><?php echo $value->money; ?>万</p>
                                <!--<p class="ddicon3 f-fl">成交价 : <a href="#" class="c_fe3638">审核中</a></p>-->
                                <p class="ddicon4 f-fl">佣金 : <a class="c_1dbb86"><?php if($value->order_status==1):?><?php echo $value->fee;?><?php elseif($value->order_status==0):?>待审核<?php else:?>已驳回<?php endif;?></a></p>
                                <div class="cb"></div>
                            </div>
                            <div class="dingdan_item_cont_sit">
                                <p class="f-fl <?php if($value->order_status>=0):?>c_fe3638<?php endif;?>" style="margin-right:60px;">提交订单</p>
                                <p class="f-fl <?php if($value->order_status>=0):?>c_fe3638<?php endif;?>" style="margin-right:42px;">订单审核中</p>
                                <p class="f-fl" style="margin-right:61px;">项目成立中</p>
                                <p class="f-fl" style="margin-right:74px;">结算中</p>
                                <p class="f-fl <?php if($value->order_status>0):?>c_fe3638<?php endif;?>">审核完成</p>
                                <div class="cb"></div>
                            </div>
                            <div class="dingdan_item_cont_bar"><img src="<?php echo base_url() ?>static/home/image/dingdan_bar_<?php if($value->order_status==0):?>1<?php else:?>4<?php endif;?>.png"/></div>
                            <div class="dingdan_item_cont_time">
                                <p><?php echo date('Y.m.d H:i',$value->post_time);?></p>
                                <p><?php echo date('Y.m.d H:i',$value->	post_time);?></p>
                                <p>暂无</p>
                                <p>暂无</p>
                                <p><?php if($value->order_status!=0):?><?php echo date('Y.m.d H:i',$value->status_time);?><?php endif;?></p>
                                <div class="cb"></div>
                            </div>
                            <div class="cb"></div>
                        </div>
                        <div class="f-fr dingdan_item_btn"><?php if($value->order_status==0):?><a href="<?php base_url('center/editOrder');?>/<?php echo $value->id;?>">修改订单</a><?php else:?><a>禁止修改</a><?php endif;?></div>
                        <div class="cb"></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
            <h4 style="padding-left: 100px;"><strong>该状态下您还没有订单</strong></h4>
            <?php endif; ?>
        </object>
    </div>
    <div class="dingdan_mn_submit">
        <a href="<?php echo base_url('center/trade');?>" class="dingdan_mn_btn" >我要报单</a>
    </div>
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>