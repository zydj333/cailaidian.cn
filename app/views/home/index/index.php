<!--主要内容--> 
<div class="g-bd">
    <!--轮播--> 
    <div id="banner">
        <div class="slider">
            <?php if (!empty($banner)): ?>
                <?php foreach ($banner as $banner_key => $banner_value): ?>
                    <div class="pic_list <?php if ($banner_key == 0): ?>active<?php endif; ?>" style="background:<?php echo $banner_value->color; ?> url(<?php echo base_url() . $banner_value->imageurl; ?>) no-repeat scroll center 0px;"><a href="<?php echo $banner_value->url; ?>" target="_blank"></a></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="current_bar"></div>
            <a href="#" class="next_btn"></a>
            <a href="#" class="prev_btn"></a>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/Lz.js"></script>
    <script type="text/javascript">
        Lz.sliderShow();
    </script>
    <!--登陆框--> 
    <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=twitter"></script>
    <?php if (empty($member)): ?>
        <script type="text/javascript">
            $(function() {
                $("#login_button").click(function() {
                    $.ajax({
                        type: "POST",
                        url: "/login/checkLogin/" + Math.random(),
                        data: $("#login_form").serialize(),
                        dataType: "json",
                        success: function(msg) {
                            var str = msg.error;
                            if (msg.flag === 1) {
                                $("#login_form").submit();
                            } else if (msg.flag === 0) {
                                $.dialog({
                                    title: '登录提示',
                                    lock: true,
                                    background: '#DDD', // 背景色
                                    opacity: 0.75, // 透明度
                                    width: '500px',
                                    content: str,
                                    time: 2
                                });
                                return false;
                            } else {
                                $.dialog({
                                    content: '无法登录，错误未知',
                                    title: '登录提示',
                                    lock: true,
                                    background: '#DDD', // 背景色
                                    opacity: 0.75, // 透明度
                                    width: '600px',
                                    time: 2
                                });
                                return false;
                            }
                        }
                    });
                });
            });
        </script>
        <form method="post" action="<?php echo base_url('login/doLogin'); ?>" id="login_form">
            <div class="login">
                <div class="log-tt">
                    <p class="f-fl">快速登陆</p>
                    <a href="<?php echo base_url('register/index'); ?>" class="f-fr">注册新账户</a>
                    <div class="cb"></div>
                </div>
                <div class="log_name">
                    <input type="text" name="account" class="log_name_ipt" placeholder="填写你的手机号码"/>
                </div>
                <div class="log_pw">
                    <input type="password" name="password" class="log_pw_ipt" placeholder="填写登录密码"/>
                </div>
                <div class="log_submit">
                    <input type="button" value="登录" class="log_submit_ipt" id="login_button"/>
                </div>
                <div class="log-keep">
                    <label></label>
                    <a href="<?php echo base_url('forget/index'); ?>" class="f-fl inb">忘记密码？</a>           
                </div>
            </div>
        </form>
    <?php else: ?>
        <div class="login">
           <div class="log-tt">
               <p style="margin-left:10px;">欢迎登录财来电网上理财平台！</p>
               <div class="cb"></div>
           </div>
           <div class="login_on_name">
               您的登录账号 :
               <span style="color:#d1282b;"><?php echo substr($member->account,0,3).'****'.substr($member->account,-4,4);?></span>
           </div>
           <div class="login_on_btn cb">
               <a href="<?php echo base_url('center');?>" class="f-fl" style="background:#1dbb86;">会员中心</a>
               <a href="<?php echo base_url('product/index');?>?cate=1" class="f-fr" style="background:#f5383b;">产品中心</a>
               <div class="cb"></div>
           </div>
           <div class="login_out_btn">
               <a href="<?php echo base_url('login/logout');?>">安全退出</a>
           </div>
      </div>   
    <?php endif; ?>
    <!--主栏--> 
    <div class="g-bd-box">
        <!--第一栏--> 
        <div class="g-sd-1">
            <div class="g-sd-1-mn">
                <ul>
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url(); ?>static/home/image/icon_13.jpg"/>
                            <h2>产品多&nbsp;&nbsp;&nbsp;尽情挑选</h2>
                            <p>不同收益期限、付息方式、类型、地域<br>
                                <span style="color:#e80c0f;">100</span>余款产品满足客户多样化需求 
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url(); ?>static/home/image/icon_15.jpg"/>
                            <h2>佣金高&nbsp;&nbsp;&nbsp;欢迎比价</h2>
                            <p>高出市场价千<span style="color:#e80c0f;">8</span>以上的佣金，使理财师<br>
                                客户的利益最大化 
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url(); ?>static/home/image/icon_17.jpg"/>
                            <h2>结账快&nbsp;&nbsp;&nbsp;安全保障</h2>
                            <p>数千万资金储备，成立<span style="color:#e80c0f;">24</span>小时内快速现结，<br>
                                保证理财师及客户的切身利益 
                            </p>
                        </a>
                    </li>
                </ul>
                <div class="cb"></div>
            </div>
        </div>
        <!--主要产品-->         
        <div class="g-mn">
            <!--tab--> 
            <div id="cptab" style="margin-bottom:20px;">
                <h2 class="cp-tt">
                    <b>
                        <ul>
                            <?php if (!empty($count)): ?>
                                <?php foreach ($count as $count_key => $count_value): ?>
                                    <li <?php if ($count_key == 0): ?>class="lixz"<?php endif; ?>><?php echo $count_value->title; ?>共（<?php echo $count_value->totlecount; ?>）款</li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </b>
                    <a href="<?php echo base_url('product/index'); ?>" class="f-fr">更多</a>
                </h2>     
                <!--信托-->
                <?php if (!empty($product)): ?>
                    <?php foreach ($product as $product_key => $product_value): ?>
                        <object class="div<?php if ($product_key == 0): ?>xz<?php endif; ?>">
                            <div class="m-mnc-2">
                                <?php foreach ($product_value->project as $project_key => $project_value): ?>
                                    <div class="item-<?php echo $project_key + 1; ?> f-fl">
                                        <table >
                                            <tr>
                                                <td rowspan="5" style="width:582px;">
                                                    <div class="table-mn">
                                                        <div class="table-mn-tt">
                                                            <h2 class="tl"><a href="<?php echo base_url('product/detial') . '/' . $project_value->id; ?>"><?php echo $project_value->product_name; ?></a></h2>
                                                            <img src="<?php echo base_url(); ?>static/home/image/baoxiao_icon.png" alt="包销图标"/>
                                                        </div>
                                                        <div class="table-mn-list">
                                                            <div>
                                                                <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_1.png) 0% 50% no-repeat;"><?php echo $project_value->month; ?>个月</p>
                                                                <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_2.png) 0% 50% no-repeat;"><?php echo $project_value->tender_area; ?></p>
                                                                <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_3.png) 0% 50% no-repeat;"><?php echo $project_value->pay_way; ?></p>
                                                                <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_4.png) 0% 50% no-repeat;"><?php echo $project_value->interest_area; ?></p>
                                                                <div class="cb"></div>
                                                            </div>
                                                        </div>
                                                        <div class="table-mn-progress mt20">
                                                            <p class="f-fl" style="color:#f63e4f;font-size:12px;">募集进度:</p>
                                                            <div class="pg-bar f-fr">
                                                                <div style="width:<?php echo $project_value->progress; ?>%;height:12px;background:#1dbb86;border-radius:15px;text-align:right;font-size:12px;color:#fff;padding-right:10px;"><p style="line-height:1.2em;"><?php echo $project_value->progress; ?>%</p></div>
                                                            </div>
                                                            <div class="cb"></div>
                                                        </div>
                                                        <div class="table-mn-update">
                                                            <p class="tl"><?php echo $project_value->support_log; ?></p>
                                                        </div>
                                                        <div class="cb"></div>
                                                    </div>                          
                                                </td>
                                                <td height="39px"><b>认购金额</b></td>
                                                <td><b>预期收益</b></td>
                                                <td><b>返佣比例</b></td>
                                            </tr>
                                            <?php if (!empty($project_value->items)): ?>
                                                <?php foreach ($project_value->items as $items_key => $items_value): ?>
                                                    <tr>
                                                        <td height="39px"><?php echo $items_value->buy_total; ?></td>
                                                        <td><?php echo $items_value->interest; ?>%</td>
                                                        <td><?php if (!empty($memeber)): ?><?php echo $items_value->fee; ?>%<?php else: ?><a href="<?php echo base_url('login/index'); ?>" style="color:#f1171a">登陆可见</a><?php endif; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="f-fl ml30"><a href="<?php echo base_url('download/index?type=') . base64_encode($project_value->id); ?>" target="_blank" class="data-btn tc">资料下载</a></div>
                                                    <div class="f-fr">
                                                        <div class="f-fl mr24"><a href="javascript:void(0);" onclick="return getMail(<?php echo $project_value->id; ?>)" class="email-btn">发送邮件</a></div>
                                                        <div class="f-fr mr30"><a href="<?php echo base_url('product/detial') . '/' . $project_value->id; ?>" class="order-btn">立即预约</a></div>
                                                    </div>                           
                                                </td>
                                            </tr>
                                        </table>
                                         <div class="cb"></div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="cb"></div>
                            </div>
                        </object>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <script type="text/javascript">
                function chageSelect(nIndex) {
                    var oLis = document.getElementById("cptab").getElementsByTagName("li");
                    var oDivs = document.getElementById("cptab").getElementsByTagName("object");
                    for (var i = 0; i < oLis.length; i++) {
                        oLis.item(i).className = null;
                        oDivs.item(i).className = null;
                    }
                    oLis.item(nIndex).className = "lixz";
                    oDivs.item(nIndex).className = "divxz";
                }

                var oLis = document.getElementById("cptab").getElementsByTagName("li");
                oLis.item(0).onclick = function() {
                    chageSelect(0);
                }
                oLis.item(1).onclick = function() {
                    chageSelect(1);
                }
                oLis.item(2).onclick = function() {
                    chageSelect(2);
                }
                oLis.item(3).onclick = function() {
                    chageSelect(3);
                }
            </script>
        </div>
        <!--第二栏--> 
        <div class="g-sd-2">
            <div class="m-sdc-1">
                <div class="m-news f-fl">
                    <div class="m-news-tt">
                        <div class="f-fl"><h2>信托快报</h2></div>
                        <div class="f-fr pb10"><a href="<?php echo base_url('bbs/article'); ?>">更多</a></div>
                        <div class="cb"></div>  
                    </div>
                    <div class="m-news-list">
                        <ul>
                            <?php if (!empty($news)): ?>
                                <?php foreach ($news as $news_key => $news_values): ?>
                                    <li>
                                        <a href="<?php echo base_url('bbs/articleDetial') . '/' . $news_values->id; ?>"><?php echo $news_values->title; ?></a>
                                        <span class="f-fr"><?php echo date('Y/m/d', strtotime($news_values->article_time)); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="m-help f-fr">
                    <div class="m-help-tt">
                        <div class="f-fl"><h2>新手帮助</h2></div>
                        <div class="f-fr pb10"><a href="<?php echo base_url('bbs/article'); ?>">更多</a></div>
                        <div class="cb"></div>  
                    </div>
                    <div class="m-help-list">
                        <ul>
                            <?php if (!empty($help)): ?>
                                <?php foreach ($help as $help_key => $help_values): ?>
                                    <li>
                                        <a href="<?php echo base_url('bbs/articleDetial') . '/' . $help_values->id; ?>"><?php echo $help_values->title; ?></a>
                                        <span class="f-fr"><?php echo date('Y/m/d', strtotime($help_values->article_time)); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="cb"></div>
            </div>
            <div class="m-sdc-2">
                <div class="m-sdc-2-tt">
                    <h2 class="f-fl">合作伙伴</h2>
                    <a href="javascript:void(0);" class="f-fr">更多</a>
                    <div class="cb"></div>
                </div>
                <?php if (!empty($partner)): ?>
                    <div class="m-sdc-2-list">
                        <?php foreach ($partner as $partner_key => $partner_values): ?>
                            <?php if ($partner_key % 6 == 0): ?><ul <?php if ($partner_key == 0): ?>style="border-bottom:1px solid #dadada;"<?php endif; ?>><?php endif; ?>
                                <li><a href="<?php echo $partner_values->url; ?>" title="<?php echo $partner_values->title; ?>" target="_blank"><img src="<?php echo base_url() . $partner_values->imageurl; ?>" alt="<?php echo $partner_values->title; ?>" width="96px" height="34px" /></a></li>
                                <?php if ($partner_key % 6 == 5 || ($partner_key + 1) == count($partner)): ?>
                                    <div class="cb"></div>
                                </ul>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="cb"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/getmail.js" ></script>