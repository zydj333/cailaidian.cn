<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title><?php if (isset($title) && $title != ''): ?><?php echo $title; ?>_财来电 <?php else: ?>财来电 - 综合金融服务平台 理财师频道 一站式服务 最新的理财师资讯<?php endif; ?></title>
        <meta name="keywords" content="<?php if (isset($keywords) && $keywords != ''): ?><?php echo $keywords; ?><?php else: ?>财来电,金融投资,投资理财,理财服务,理财平台,理财师俱乐部,理财师，理财分析，理财资讯，理财师频道,信托<?php endif; ?>"/>
        <meta name="description" content="<?php if (isset($description) && $description != ''): ?><?php echo $description; ?><?php else: ?>财来电，您身边的理财平台！最专业的金融投资，理财师一站式理财服务！投资理财，收益高，风险小！值得信赖！<?php endif; ?>"/>
        <meta name="viewport" content="width=device-width"/>
        <meta name="robots" content="all" />
        <link rel="icon" href="<?php echo base_url(); ?>static/home/image/favicon.ico" mce_href="<?php echo base_url(); ?>static/home/image/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>static/home/image/favicon.ico" mce_href="<?php echo base_url(); ?>static/home/image/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/common.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/community.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/jquery-1.7.1.min.js"></script>
        <!--返回顶部-->
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/gotop.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                jQuery.jqtab = function(tabtit, tab_conbox, shijian) {
                    $(tab_conbox).find("li").hide();
                    $(tabtit).find("li:first").addClass("thistab").show();
                    $(tab_conbox).find("li:first").show();
                    $(tabtit).find("li").bind(shijian, function() {
                        $(this).addClass("thistab").siblings("li").removeClass("thistab");
                        var activeindex = $(tabtit).find("li").index(this);
                        $(tab_conbox).children().eq(activeindex).show().siblings().hide();
                        return false;
                    });

                };
                /*调用方法如下：*/
                $.jqtab("#tabs2", "#tab_conbox2", "mouseenter");

            });
        </script>
    </head>
    <body>
        <div class="g-doc">
            <!--在线客服-->
            <div class="kefu">
                <ul>
                    <li>
                        <p class="phone"></p>
                        <ul style="position:absolute;left:-171px;top:-2px;">
                            <li><a href="#"><img src="<?php echo base_url(); ?>static/home/image/kefu_icon_dianji_03.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="qq"></p>
                        <ul style="position:absolute;left:-171px;top:-1px;">
                            <li>
                                <a href="http://wpa.qq.com/msgrd?V=3&uin=3257477956&Site=cailaidian.cn&Menu=yes" target="_blank"><img src="<?php echo base_url(); ?>static/home/image/kefu_icon_dianji_09.png" /></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p class="weixin"></p>
                        <ul style="position:absolute;left:-147px;top:-34px;">
                            <li><a href="#"><img src="<?php echo base_url(); ?>static/home/image/kefu_dianji_weixin_03.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="code"></p>
                        <ul style="position:absolute;left:-147px;top:-39px;">
                            <li><a href="#"><img src="<?php echo base_url(); ?>static/home/image/kefu_dianji_code_05.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <div onClick="GoTop()"><p class="top"></p></div>
                    </li>
                </ul>
            </div>
            <!--返回顶部-->
            <script type="text/javascript">
                window.scrollTo(0, 0);

                $(function() {
                    $('#search_button').click(function() {
                        var type=$('.model-select-text').attr('data-value');
                        $('#searchtype').val(type);
                        var keywords=$('#keywords').val();
                        if(keywords==''){
                            return;
                        }
                        $('#search_form').submit();
                    });
                });
            </script> 
            <!--头部-->
            <div class="g-hd">
                <div class="g-hd-box">
                    <div class="hd-top">
                        <div class="hd-top-mn">
                            <div class="hd-top-l f-fl">
                                <div class="f-fl">
                                    <p>财来电全国客服热线&nbsp;:&nbsp;</p>
                                </div>
                                <div class="f-fl"><img src="<?php echo base_url(); ?>static/home/image/phone_icon.png" class="f-fl" alt="联系电话图标"/><p class="f-fr" style="color:#525252;">4008-313-668</p></div>
                            </div>
                            <div class="hd-top-r f-fr">
                                <ul>
                                    <?php if (!empty($member)): ?>
                                        <li><a href="<?php echo base_url('center/index'); ?>"><?php echo substr($member->account, 0, 3) . '****' . substr($member->account, -4, 4); ?></a></li>
                                        <li><a href="<?php echo base_url('login/logout'); ?>">退出</a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo base_url('login/index'); ?>">登录</a></li>
                                        <li><a href="<?php echo base_url('register/index'); ?>">注册</a></li>
                                    <?php endif; ?>
                                    <li><a href="javascript:void(0);">理财APP</a></li>
                                    <li><a href="<?php echo base_url('help/about_us'); ?>" style="padding-right:0;border:none;">关于我们</a></li>
                                </ul>
                            </div>
                            <div class="cb"></div>
                        </div>
                    </div>
                    <div class="hd-middle">
                        <div class="hd-middle-mn">
                            <div class="logo f-fl">
                                <a href="<?php echo base_url('bbs/index'); ?>">
                                    <img src="<?php echo base_url(); ?>static/home/image/shequ_logo.png" alt="财来电社区"/>
                                </a>
                            </div>
                            <div class="sch-quest f-fr">
                                <div class="sq_sch f-fl">
                                    <form action="<?php echo base_url('bbs/search'); ?>" id="search_form" method="post" >
                                        <div class="model-select-box" style="z-index:18;">
                                            <div class="model-select-text" data-value="2">资讯</div>
                                            <ul class="model-select-option">
                                                <li data-option="2" style="border:none;">资讯</li>
                                                <li data-option="1">问答</li>
                                                <li data-option="2" style="border-top:none;">新闻</li>
                                            </ul>
                                        </div>
                                        <input type="hidden" name="searchtype" id="searchtype" value="2" />
                                        <input type="text" placeholder="请输入关键字" class="sq_sch_ipt_t" name="keywords" id="keywords"/>
                                        <a href="javascript:void(0);" class="sq_sch_ipt_btn" id="search_button">搜索</a>
                                        <div class="cb"></div>
                                    </form>
                                </div>
                                <div class="quest f-fr">
                                    <a href="<?php echo base_url('bbs/askQuestion'); ?>" class="quest-btn f-fr">提问</a>
                                </div>
                            </div>
                            <div class="cb"></div>
                        </div>
                    </div>
                    <div class="hd-down">
                        <div class="hd-down-mn">
                            <div class="sq_nav f-fl">
                                <ul style="width:1080px;">
                                    <li><a href="<?php echo base_url('bbs/question'); ?>" class="f-fr" <?php if ($chosen == 'question'): ?>id="sq_active"<?php endif; ?>>理财问答</a></li>
                                    <li><a href="<?php echo base_url('bbs/article'); ?>" class="f-fr" <?php if ($chosen == 'article'): ?>id="sq_active"<?php endif; ?> style="margin-right:163px;">金融资讯</a></li>
                                    <li><a href="<?php echo base_url('bbs/index'); ?>" class="f-fl" <?php if ($chosen == 'index'): ?>id="sq_active"<?php endif; ?>>社区首页</a></li>
                                </ul>
                            </div>
                            <div class="cb"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--下面是主要内容-->
            <div class="sq_bd">
                <div style="width:1080px;margin:0 auto;">