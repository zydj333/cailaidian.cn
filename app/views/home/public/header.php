<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php if (isset($title)): ?><?php echo $title; ?><?php else: ?>财来电 - 综合金融服务平台 理财师频道 一站式服务 最新的理财师资讯<?php endif; ?></title>
        <meta name="keywords" content="<?php if (isset($keywords)): ?><?php echo $keywords; ?><?php else: ?>财来电,金融投资,投资理财,理财服务,理财平台,理财师俱乐部,理财师，理财分析，理财资讯，理财师频道,信托<?php endif; ?>"/>
        <meta name="description" content="<?php if (isset($description)): ?><?php echo $description; ?><?php else: ?>财来电，您身边的理财平台！最专业的金融投资，理财师一站式理财服务！投资理财，收益高，风险小！值得信赖！<?php endif; ?>"/>
        <meta name="viewport" content="width=device-width"/>
        <meta name="robots" content="all" />
        <link rel="icon" href="<?php echo base_url(); ?>static/home/image/favicon.ico" mce_href="<?php echo base_url(); ?>static/home/image/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>static/home/image/favicon.ico" mce_href="<?php echo base_url(); ?>static/home/image/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/common.css"/>
        <?php if ($chosen == 'star'): ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/licaishi.css"/>
        <?php elseif ($chosen == 'launch'): ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/huiyuanzx.css"/>
        <?php else: ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>static/home/css/pagerstyles.css"/>
        <?php endif; ?>
        <!--轮播js-->
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/jquery-1.7.1.min.js"></script>
        <!--返回顶部-->
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/gotop.js"></script>
    </head>
    <script type="text/javascript">
        $(function() {
            $('#search_product_button').click(function(){
                var keyword=$('#keywords').val();
                if(keyword!=''){
                    $('#search_product_form').submit();
                }else{
                    return ;
                }
            });
        });
    </script>
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
            <script type="text/javascript">window.scrollTo(0, document.body.scrollHeight);</script>
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
                                    <li><a href="<?php echo base_url('bbs/articleDetial/55'); ?>" style="padding-right:0;border:none;">关于我们</a></li>
                                </ul>
                            </div>
                            <div class="cb"></div>
                        </div>
                    </div>
                    <div class="hd-middle">
                        <div class="hd-middle-mn">
                            <div class="logo f-fl">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url(); ?>static/home/image/logo_03.jpg" alt="财来电logo"/>
                                </a>
                            </div>
                            <div class="sch-upl f-fr">
                                <div class="u_sch f-fl">
                                    <form method="post" action="<?php echo base_url('product/search');?>" id='search_product_form'>
                                        <input type="text" name="keywords" id="keywords" class="u_sch_ipt_t"/>
                                        <input type="button" class="u_sch_ipt_btn" value="搜索" id='search_product_button'/>
                                        <div class="cb"></div>
                                    </form>
                                </div>
                                <div class="upl f-fr">
                                    <p class="f-fl">或者</p>
                                    <a href="<?php echo base_url('launch/index'); ?>" class="upl-btn f-fr">上传产品</a>
                                </div>
                            </div>
                            <div class="cb"></div>
                        </div>
                    </div>
                    <div class="hd-down">
                        <div class="hd-down-mn">
                            <div class="nav f-fl">
                                <ul class="f-fl">
                                    <li><a href="<?php echo base_url(); ?>" <?php if ($chosen == 'index'): ?>id="active"<?php endif; ?> style="padding:13px 37px">首页</a></li>
                                    <li><a href="<?php echo base_url('product/index/?cate=1'); ?>" <?php if ($chosen == 'trust'): ?>id="active"<?php endif; ?>>信托产品</a></li>
                                    <li><a href="<?php echo base_url('product/index/?cate=5'); ?>" <?php if ($chosen == 'plan'): ?>id="active"<?php endif; ?>>资管计划</a></li>
                                    <li><a href="<?php echo base_url('product/index/?cate=6'); ?>" <?php if ($chosen == 'privatesun'): ?>id="active"<?php endif; ?>>阳光私募</a></li>
                                    <li><a href="<?php echo base_url('product/index/?cate=7'); ?>" <?php if ($chosen == 'insurance'): ?>id="active"<?php endif; ?>>保险理财</a></li>
                                    <li><a href="<?php echo base_url('star'); ?>" <?php if ($chosen == 'star'): ?>id="active"<?php endif; ?>>理财明星</a></li>
                                    <li><a href="<?php echo base_url('bbs'); ?>" <?php if ($chosen == 'bbs'): ?>id="active"<?php endif; ?> target="_blank">理财社区</a></li>
                                    <li><a href="<?php echo base_url('download_apps'); ?>" <?php if ($chosen == 'download_apps'): ?>id="active"<?php endif; ?>>理财APP</a></li>
                                </ul>
                                <div class="nav_div_c f-fr">
                                    <a href="http://www.erongniu.com" target="_blank">融牛配资</a><a href="http://www.fandingwang.com" target="_blank">泛丁众筹</a><a href="http://www.cnaidai.com" target="_blank">爱贷理财</a>
                                </div>
                            </div>
                            <div class="m_hyzx f-fr"><a href="<?php echo base_url('center/index'); ?>">会员中心</a></div>
                            <div class="cb"></div>
                        </div>
                    </div>
                </div>
            </div>