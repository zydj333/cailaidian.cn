<div class="sq_sd f-fr bg_ff">
            <?php if (empty($userlogin)): ?>
                <!--登录前内容、start-->
                <div>
                    <div>
                        <a href="<?php echo base_url('login/index');?>" class="sq_sd_qiand">签到</a>
                    </div>
                    <div class="sq_sd_dongt">
                        <h4>最新动态</h4>
                        <?php if (!empty($feed)): ?>
                            <?php foreach ($feed as $key => $value): ?>
                                <div class="sq_sd_dongt_list bg_f5">
                                    <div class="sq_sd_dongt_list_img f-fl"><a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>" target="_blank"><img width="48px" height="38px" src="<?php echo base_url() . $value->imageurl; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/sq_news_pic_06.png'"/></a></div>
                                    <a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>" class="sq_sd_dongt_list_link"  target="_blank"><?php echo $value->title; ?></a>
                                    <div class="cb"></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!--登录前内容、end-->
            <?php else: ?>
                <!--登录后内容、start-->
                <div>
                    <div class="sq_loginon_hd">
                        <img src="<?php echo base_url() . $userlogin->head_ico; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" class="sq_uhead" alt=""/>
                        <div class="sq_loginon_hd_data f-fr">
                            <p>用户名 : <span><?php echo $userlogin->truename; ?></span></p>
                            <p>真实姓名 : <span><?php if ($userlogin->is_true == 1): ?>已认证<?php else: ?>未认证<?php endif; ?></span></p>
                            <p>手机号码 : <span><?php echo $userlogin->account; ?></span></p>
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>static/home/image/huiyuanzx_icon_03.png" alt="email" <?php if ($userlogin->email_status): ?> id="yirenzheng"<?php endif; ?>/>
                                    <ul>
                                        <li class="renzheng_tips"><?php if ($userlogin->email_status): ?>邮箱已认证<?php else: ?>未认证邮箱<?php endif; ?></li>
                                    </ul>
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>static/home/image/huiyuanzx_icon_05.png" alt="phone" id="yirenzheng"/><!--已认证-->
                                    <ul>
                                        <li class="renzheng_tips">已手机认证</li>
                                    </ul>
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>static/home/image/huiyuanzx_icon_07.png" alt="ID" <?php if ($userlogin->is_true): ?> id="yirenzheng"<?php endif; ?> />
                                    <ul>
                                        <li class="renzheng_tips"><?php if ($userlogin->is_true): ?>已实名认证<?php else: ?>未实名认证<?php endif; ?></li>
                                    </ul>
                                </li>
                                <div class="cb"></div>
                            </ul>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="sq_loginon_cont">
                        <a href="<?php echo base_url('bbs/myAnswer'); ?>" class="sq_loginon_cont_message">我的回答<span class="sq_loginon_cont_num"><?php echo $userlogin->answerCount; ?></span></a>
                        <a href="<?php echo base_url('bbs/myQuestion'); ?>" class="sq_loginon_cont_message">我的提问<span class="sq_loginon_cont_num"><?php echo $userlogin->questionCount; ?></span></a>
                        <a href="<?php echo base_url('login/logout'); ?>" class="sq_loginon_cont_btn">退出</a>
                    </div>
                </div>
                <!--登录后内容、end-->
            <?php endif; ?>
            <div class="sq_sd_guanz">
                <h4>关注</h4>
                <div style="margin-top:68px;">
                    <img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_code2.jpg" alt="微信二维码" class="sq_sd_guanz_code"/>
                    <span>扫描微信二维码</span>
                </div>
                <div>
                    <img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_code2.jpg" alt="官方二维码" class="sq_sd_guanz_code"/>
                    <span>扫描官方二维码</span>
                </div>
            </div>
        </div>
        <div class="cb"></div>
    </div>
</div>
<!--尾部-->
<div class="g-ft"> 
    <div class="sq_ft_box1">
        <div class="sq_ft_yqlj">
            <h3>友情链接</h3>
            <div class="sq_ft_yqlj_item">
                <ul>
                    <?php if (!empty($link)): ?>
                        <?php foreach ($link as $key => $value): ?>
                    <li <?php if (($key + 1) % 8 == 1): ?>style="width:110px;text-align:left;"<?php elseif (($key + 1) % 8 == 0): ?>style="width:110px;text-align:right;"<?php endif; ?>><a href="<?php echo $value->url; ?>" target="_blank"><?php echo $value->title; ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <div class="cb"></div>
            </div>
        </div>
    </div>
    <div class="sq_ft_box2">
        <div class="sq_ft_lianxi">
            <ul class="f-fl">
                <li class="pr">
                    <img src="<?php echo base_url(); ?>static/home/image/ft_lianxi_wweixin.png" alt=""/>
                    <ul>
                        <li><img src="<?php echo base_url(); ?>static/home/image/ft_lianxi_codew.png" alt=""/></li>
                    </ul>
                    <p>关注公众微信</p>
                </li>
                <li>
                    <a href="#"><img src="<?php echo base_url(); ?>static/home/image/ft_lianxi_weibo.png" alt=""/></a>
                    <p>新浪微博</p>
                </li>
                <li class="pr">
                    <img src="<?php echo base_url(); ?>static/home/image/ft_lianxi_code.png" alt=""/>
                    <ul>
                        <li><img src="<?php echo base_url(); ?>static/home/image/ft_lianxi_codeg.png" alt=""/></li>
                    </ul>
                    <p>官方二维码</p>
                </li>
                <div class="cb"></div>
            </ul>
            <div class="f-fl sq_ft_fwrx">
                <p>服务热线</p>
                <span>4008-313-668</span>
            </div>
            <div class="cb"></div>
        </div>
        <div class="cb"></div>
    </div> 
    <!--版权-->
    <div class="ft-cont">
        <div class="ft-cont-mn">  
            <p class="f-fl tc">Copyright © 2014财来电 cailaidian.cn All Rights Reserved 版权所有 浙ICP备12023130号-4</p>
            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                document.write(unescape("%3Cspan id='cnzz_stat_icon_1255407206'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/stat.php%3Fid%3D1255407206%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
            <div class="cb"></div>
        </div>
        <div class="cb"></div>
    </div>
</div>
</div>
<script>
    /*
     * 模拟网页中所有的下拉列表select
     */
    function selectModel() {
        var $box = $('div.model-select-box');
        var $option = $('ul.model-select-option', $box);
        var $txt = $('div.model-select-text', $box);
        var speed = 10;
        /*
         * 当机某个下拉列表时，显示当前下拉列表的下拉列表框
         * 并隐藏页面中其他下拉列表
         */
        $txt.click(function(e) {
            $option.not($(this).siblings('ul.model-select-option')).slideUp(speed, function() {
                int($(this));
            });
            $(this).siblings('ul.model-select-option').slideToggle(speed, function() {
                int($(this));
            });
            return false;
        });
        //点击选择，关闭其他下拉
        /*
         * 为每个下拉列表框中的选项设置默认选中标识 data-selected
         * 点击下拉列表框中的选项时，将选项的 data-option 属性的属性值赋给下拉列表的 data-value 属性，并改变默认选中标识 data-selected
         
         * 为选项添加 mouseover 事件
         */
        $option.find('li')
                .each(function(index, element) {
                    if ($(this).hasClass('seleced')) {
                        $(this).addClass('data-selected');
                    }
                })
                .mousedown(function() {
                    //赋值操作
                    $(this).parent().siblings('div.model-select-text').text($(this).text())
                            .attr('data-value', $(this).attr('data-option'));
                    $option.slideUp(speed, function() {
                        int($(this));
                    });
                    $(this).addClass('seleced data-selected').siblings('li').removeClass('seleced data-selected');
                    return false;
                })
                .mouseover(function() {
                    $(this).addClass('seleced').siblings('li').removeClass('seleced');
                });
        //点击文档，隐藏所有下拉
        $(document).click(function(e) {
            $option.slideUp(speed, function() {
                int($(this));
            });
        });
        //初始化默认选择
        function int(obj) {
            obj.find('li.data-selected').addClass('seleced').siblings('li').removeClass('seleced');
        }
    }
    $(function() {
        selectModel();
    })
</script>
</body>

</html>