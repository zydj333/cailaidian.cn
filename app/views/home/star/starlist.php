<!--下面是主要内容-->
<div class="lpl_mn">
    <h2 class="lpl_mn_tt">个人主页</h2>
    <div class="lpl_mn_cont bg_f5">
        <div>
            <div class="lpl_mn_lcs_intro pr">
                <img src="<?php echo base_url() . $member->head_ico; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" class="lcs_uhead" alt=""/><!--用户头像-->
                <div class="lpl_mn_lcs_intro_detail f-fl">
                    <div>
                        <p style="font-size:16px;color:#333;">理财师</p>
                    </div>
                    <div>
                        <p class="inb">用户名 : <span><?php if ($member->truename != ''): ?><?php echo $member->truename; ?><?php else: ?><?php echo substr($member->account,0,3).'****'.substr($member->account,-4,4);?><?php endif; ?></span></p>
                        <p class="inb ml20">QQ : <span><?php echo $member->qq; ?></span></p>
                    </div>
                    <div>
                        <p class="inb">真实姓名 : <span><?php if ($member->is_true == 0): ?>未认证<?php else: ?>已认证<?php endif; ?></span></p>
                        <p class="inb ml20" style="width:90px;">省份 : <span><?php echo $member->province_id; ?></span></p>
                        <p class="inb " style="width:90px;">城市 : <span><?php echo $member->city_id; ?></span></p>
                    </div>
                    <div>
                        <p class="f-fl">手机号 : <span><?php echo substr($member->phone,0,3).'****'.substr($member->phone,-4,4);?></span></p>
                        <div class=" ml20 f-fl" style="height:24px;">
                            <i class="f-fl">个性签名 : </i>
                            <span class="f-fl ud_whatup"><?php echo $member->sign; ?></span>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <ul>
                        <li>
                            <img src="<?php echo base_url(); ?>static/home/image/huiyuanzx_icon_03.png" alt="email" <?php if ($member->email_status == 1): ?>id="yirenzheng"<?php endif; ?> />
                            <ul>
                                <li><li class="renzheng_tips"><?php if ($member->email_status == 1): ?>已认证邮箱<?php else:?>未认证邮箱<?php endif;?></li></li>
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo base_url(); ?>static/home/image/huiyuanzx_icon_05.png" alt="phone" id="yirenzheng" /><!--已认证-->
                            <ul>
                                <li><li class="renzheng_tips">已手机认证</li></li>
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo base_url(); ?>static/home/image/huiyuanzx_icon_07.png" alt="ID" <?php if ($member->is_true == 1): ?>id="yirenzheng"<?php endif; ?>/>
                            <ul>
                                <li><li class="renzheng_tips"><?php if ($member->is_true == 1): ?>已实名认证<?php else:?>未实名认证<?php endif;?></li></li>
                            </ul>
                        </li>
                        <div class="cb"></div>
                    </ul>
                    <div class="cb pr">
                        <span>用户等级 : </span>
                        <span class="ud_level pa"><i style="width:10%;"></i></span><!--会员等级进度-->
                        <img src="<?php echo base_url(); ?>static/home/image/lpl_medal_icon3.png" class="level_medal" alt="奖牌"/>
                        <!--<span style="margin-left:185px;color:#1dbb86;">游民</span>-->
                    </div>
                </div>  
                <div class="lpl_mn_lcs_intro_code f-fr"> 
                    <img src="<?php echo base_url() . $member->wechat_url; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/zhuce_ft_code2.jpg'" alt="微信二维码" />
                    <p>我的微信公众号</p>
                </div>
                <div class="cb"></div>
            </div>
        </div>
        <div class="lpl_mn_lcs_product_list">
            <h3 class="lpl_list_tt">上传的产品</h3>
            <div class="lpl_list_detail">
                <div class="lpl_list_detail_tt">
                    <table>
                        <tr>
                            <td class="lpl_tt_td">产品名称</td>
                            <td class="lpl_tt_td">发行机构</td>
                            <td class="lpl_tt_td">产品期限</td>
                            <td class="lpl_tt_td">收益类型</td>
                            <td class="lpl_tt_td" style="width:294px;">年化收益</td>
                        </tr>
                    </table>                    
                </div>
                <?php if (!empty($list)): ?>
                    <?php foreach ($list as $key => $value): ?>
                        <div class="lpl_list_detail_item">
                            <table>
                                <tr style="display:block;margin-bottom:10px;">
                                    <td>
                                        <div class="lpl_item_td"><a href="<?php echo base_url('star/detial') . '/' . $value->id; ?>" class="lpl_item_name"><?php echo $value->product_name; ?></a></div>
                                    </td>
                                    <td class="lpl_item_td"><?php echo $value->company; ?></td>
                                    <td class="lpl_item_td"><?php echo $value->month; ?>个月</td>
                                    <td class="lpl_item_td"><?php echo $value->earning; ?></td>
                                    <td class="lpl_item_td" style="width:294px;"><?php echo $value->interest; ?></td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>  
        <div class="lcmx_mn_pager">
            <?php echo $pagenation; ?>
            <!--<ul class="f-fr">
                <li><a href="#">首页</a></li>
                <li><a href="#">上一页</a></li>
                <li><a href="#">下一页</a></li>
                <li><a href="#">末页</a></li>
            </ul>
            <ul class="f-fr">
                <li>共2个产品</li>
                <li>共20页</li>
                <li><input type="text" class="pager_num"/></li>
                <li><span class="pager_go">确定</span></li>
            </ul> -->    
            <div class="cb"></div>
        </div>  
    </div>
</div>