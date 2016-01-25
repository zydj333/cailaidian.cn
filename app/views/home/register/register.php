<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>注册 - 财来电 - 综合金融服务平台 理财师频道 一站式服务 最新的理财师资讯</title>
        <meta name="keywords" content="财来电,金融投资,投资理财,理财服务,理财平台,理财师俱乐部,理财师，理财分析，理财资讯，理财师频道,信托,"/>
        <meta name="description" content="财来电，您身边的理财平台！最专业的金融投资，理财师一站式理财服务！投资理财，收益高，风险小！值得信赖！"/>
        <meta name="viewport" content="width=device-width"/>
        <meta name="robots" content="all" />
        <link rel="stylesheet" href="/static/home/css/common.css"/>
        <link rel="stylesheet" href="/static/home/css/pagerstyles.css"/>
        <script type="text/javascript" src="/static/home/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/static/home/js/gotop.js"></script>
        <script type="text/javascript" src="/static/home/js/register.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=twitter"></script>
    </head>
    <body>
        <div class="g-doc">
            <!--在线客服-->
            <div class="kefu">
                <ul>
                    <li>
                        <p class="phone"></p>
                        <ul style="position:absolute;left:-171px;top:-2px;">
                            <li><a href="#"><img src="/static/home/image/kefu_icon_dianji_03.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="qq"></p>
                        <ul style="position:absolute;left:-171px;top:-1px;">
                            <li><a href="#"><img src="/static/home/image/kefu_icon_dianji_09.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="weixin"></p>
                        <ul style="position:absolute;left:-147px;top:-34px;">
                            <li><a href="#"><img src="/static/home/image/kefu_dianji_weixin_03.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="code"></p>
                        <ul style="position:absolute;left:-147px;top:-39px;">
                            <li><a href="#"><img src="/static/home/image/kefu_dianji_code_05.png" /></a></li>
                        </ul>
                    </li>
                    <li>
                        <div onClick="GoTop()"><p class="top"></p></div>
                    </li>
                </ul>
            </div>
            <!--头部-->
            <div class="g-hd">
                <div class="g-hd-box">
                    <div class="hd-top">
                        <div class="hd-top-mn">
                            <div class="hd-top-l f-fl">
                                <div class="f-fl">
                                    <p>财来电全国客服热线&nbsp;:&nbsp;</p>
                                </div>
                                <div class="f-fl"><img src="/static/home/image/phone_icon.png" class="f-fl" alt="联系电话图标"/><p class="f-fr" style="color:#525252;">4008-313-668</p></div>
                            </div>
                            <div class="hd-top-r f-fr">
                                <ul>
                                    <li><a href="<?php echo base_url('login'); ?>">登录</a></li>
                                    <li><a href="<?php echo base_url('register'); ?>">注册</a></li>
                                    <li><a href="<?php echo base_url('download'); ?>">理财APP</a></li>
                                    <li><a href="<?php echo base_url('help/about_us'); ?>" style="padding-right:0;border:none;">关于我们</a></li>
                                </ul>
                            </div>
                            <div class="cb"></div>
                        </div>
                    </div>
                    <div class="hd-middle-box">
                        <div class="f-fl"><img src="/static/home/image/logo_bg_l.png"/></div>
                        <div class="f-fr"><img src="/static/home/image/logo_bg_r.png"/></div>
                        <div class="hd-middle-b"> 
                            <div class="hd-middle-mn" style="padding:20px 0 0 0;">
                                <div class="logo f-fl">
                                    <a href="<?php echo base_url(); ?>">
                                        <img src="/static/home/image/logo_03.jpg" alt="财来电logo"/>
                                    </a>
                                </div>
                                <div class="back_to_home f-fr">
                                    <img src="/static/home/image/shouye_icon.png" class="f-fl" alt=""/><a href="<?php echo base_url(); ?>" class="f-fr">财来电首页</a>
                                </div>
                                <div class="cb"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--下面是主体-->
            <div class="zhuce_main_bg">
                <div class="zhuce_main">
                    <div class="f-fl">
                        <div class="zhuce_main_tt">
                            <h2 class="f-fl">用户注册</h2>
                            <p class="f-fr">我已经注册，现在<a href="<?php echo base_url('login'); ?>" style="color:#d21e1e;">登录</a></p>
                            <div class="cb"></div>
                        </div>
                        <div class="zhuce_main_fm">
                            <form id="register_form" method="post" action="">
                                <p>手机号码</p><input type="text" id="account" name="account" class="zhuce_main_fm_ipt" placeholder="请输入手机号码" /><br/>
                                <p>登录密码</p><input type="password" id="password" name="password" class="zhuce_main_fm_ipt" placeholder="请输入登录密码"/><br/>
                                <p>确认密码</p><input type="password" id="repassword" name="repassword" class="zhuce_main_fm_ipt" placeholder="请再次输入登录密码"/><br/>
                                <span style="display:inline-block;width:66px;font-size:14px;text-align:right;margin-right:18px;">推荐手机</span><input type="text" id="cardno" name="cardno" class="zhuce_main_fm_ipt" placeholder="请输入推荐人手机"/><br/>
                                <p>验证码</p><input type="text" id="phonecode" name="phonecode" class="zhuce_main_fm_ipt" placeholder="请输入手机验证码" style="width:83px;margin-right:0;border-right:none;"/>
                                <input type="button" name="button" value="获取验证码" class="yanzheng" id="get_phonecode"/>
                                <input type="button" name="button" value="60秒重新获取" class="yanzheng" id="noget_phonecode" style=" display: none"/>
                                <span id="timeb2" style=" display: none" >60</span>
                                <br/>
                                <div class="f-fr">
                                    <input class="input-hide f-fl" hidden="" type="checkbox" name="xieyi" value="1">
                                    <label class="checkbox f-fl"></label>
                                    <span class="f-fr">我已阅读并同意<a href="javascript:void(0);" style="color:#08c;" onclick="return showContent()">《注册服务协议》</a></span>
                                </div>
                                <input type="hidden" name="codetype" value="register" /><br/>
                                <input type="button" class="zhuce_main_fm_rig" id="register_sub_form" value="注册"/>
                            </form>
                            <script>
                                $(function() {// checkbox定义
                                    $('.checkbox').on('click', function() {
                                        if ($(this).siblings("input[type='checkbox']").is(':checked')) {
                                            $(this).removeClass('checked');
                                            $(this).siblings("input[type='checkbox']").removeAttr('checked')
                                        }
                                        else {
                                            $(this).addClass('checked');
                                            $(this).siblings("input[type='checkbox']").attr('checked', 'checked')
                                        }
                                    });
                                })
                            </script>  
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="f-fr" style="width:480px;height:548px;"></div>
                    <div class="cb"></div>
                </div>
            </div>
            <!--尾部-->
            <div class="g-ft-b"> 
                <div class="g-ft-box-b">
                    <div class="g-ft-box-1 f-fl">
                        <div class="m-cont f-fl">
                            <img src="/static/home/image/zhuce_ft_icon_09.png" alt=""/>
                            <p class="f-fr" style="">联系电话&nbsp;:<span style="font-size:24px;">&nbsp;4008-313-668</span></p>
                        </div>
                        <div class="f-fl" style="width:400px;">
                            <div>
                                <ul>
                                    <li style="position:relative;">
                                        <img src="/static/home/image/zhuce_ft_icon_06.png" class="db f-fl" alt="weixin"/>
                                        <ul>
                                            <li><img src="/static/home/image/zhuce_ft_code.jpg" /></li>
                                        </ul>
                                    </li>
                                </ul>
                                <p class="f-fl" style="padding:40px 0;">关注微信</p>
                                <div class="cb"></div>
                            </div>
                            <p style="font-size:12px;">工作时间： 9：00-21：00<br/>
                                地址：浙江省杭州市拱墅区湖州街168号，美好国际大厦12F
                            </p>
                        </div>
                    </div>
                    <div class="g-ft-box-2 f-fr">
                        <img src="/static/home/image/zhuce_ft_code2.jpg"/>
                        <p  style="text-align:center;">扫描官方二维码</p>
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
                </div>  
            </div>  
        </div>
    </body>
</html>