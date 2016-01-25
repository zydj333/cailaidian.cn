<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>登录 - 财来电 - 综合金融服务平台 理财师频道 一站式服务 最新的理财师资讯</title>
        <meta name="keywords" content="财来电,金融投资,投资理财,理财服务,理财平台,理财师俱乐部,理财师，理财分析，理财资讯，理财师频道,信托,"/>
        <meta name="description" content="财来电，您身边的理财平台！最专业的金融投资，理财师一站式理财服务！投资理财，收益高，风险小！值得信赖！"/>
        <meta name="viewport" content="width=device-width"/>
        <meta name="robots" content="all" />
        <link href="<?php echo base_url(); ?>static/home/css/common.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>static/home/css/pagerstyles.css" rel="stylesheet" />
         <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/gotop.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/jquery.artDialog.js?skin=twitter"></script>
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
                            <li><a href="#"><img src="<?php echo base_url(); ?>static/home/image/kefu_icon_dianji_09.png" /></a></li>
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
                        <div class="f-fl"><img src="<?php echo base_url(); ?>static/home/image/logo_bg_l.png"/></div>
                        <div class="f-fr"><img src="<?php echo base_url(); ?>static/home/image/logo_bg_r.png"/></div>
                        <div class="hd-middle-b"> 
                            <div class="hd-middle-mn" style="padding:20px 0 0 0;">
                                <div class="logo f-fl">
                                    <a href="<?php echo base_url(); ?>">
                                        <img src="<?php echo base_url(); ?>static/home/image/logo_03.jpg" alt="财来电logo"/>
                                    </a>
                                </div>
                                <div class="back_to_home f-fr">
                                    <img src="<?php echo base_url(); ?>static/home/image/shouye_icon.png" class="f-fl" alt=""/><a href="<?php echo base_url(); ?>" class="f-fr">财来电首页</a>
                                </div>
                                <div class="cb"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--下面是主体-->
            <div class="denglu_main_bg">
                <div class="denglu_main">
                    <div class="f-fl" style="width:596px;height:548px;"></div>
                    <div class="f-fr">
                        <div class="denglu_main_tt">
                            <h2 class="f-fl">欢迎登陆</h2>
                            <p class="f-fr">没有财来电账号？<a href="<?php echo base_url('register'); ?>" style="color:#0088cc;">免费注册</a></p>
                            <div class="cb"></div>
                        </div>
                        <div class="denglu_main_fm">
                            <form action="<?php echo base_url('login/doLogin'); ?>" id="login_form" method="post">
                                <input type="hidden" name="from_url" value="<?php echo $from;?>" />
                                <input type="text" placeholder="手机号码" name="account" style="background:url(<?php echo base_url(); ?>static/home/image/input_bg_1.png);" class="denglu_main_fm_ipt"/>
                                <input type="password" placeholder="登录密码" name="password" style="background:url(<?php echo base_url(); ?>static/home/image/input_bg_2.png);" class="denglu_main_fm_ipt"/>
                                <div>
                                    <input type="text" placeholder="验证码" class="denglu_main_fm_ipt" name="safeCode" style="width:118px;" />
                                    <!--<input type="submit" name="验证码" value="" id="yzm"/>单击获取验证码-->
                                    <img src="<?php echo base_url('validate/doimg'); ?>" width="100px" height="40px" style="float:right;" alt="验证码" id="varifyCode"/>
                                    <div class="cb"></div>
                                </div>
                                <input type="checkbox" name="remember" class="inb f-fl" style="margin-right:5px;" checked="checked" /><p class="inb f-fl">记住用户名</p>
                                <a href="<?php echo base_url('forget/index'); ?>" class="f-fr" style="color:#0088cc;">忘记密码？</a>
                                <input type="button" value="登录" id="login" class="denglu_main_fm_ipt_login"/>
                            </form>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="cb"></div>
                </div>
            </div>
            <!--尾部-->
            <div class="g-ft-b"> 
                <div class="g-ft-box-b">
                    <div class="g-ft-box-1 f-fl">
                        <div class="m-cont f-fl">
                            <img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_icon_09.png" alt=""/>
                            <p class="f-fr" style="">联系电话&nbsp;:<span style="font-size:24px;">&nbsp;4008-313-668</span></p>
                        </div>
                        <div class="f-fl" style="width:400px;">
                            <div>
                                <ul>
                                    <li style="position:relative;">
                                        <img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_icon_06.png" class="db f-fl" alt="weixin"/>
                                        <ul>
                                            <li><img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_code.jpg" /></li>
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
                        <img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_code2.jpg"/>
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
    <script type="text/javascript">
        $(function() {
            $("#login").click(function() {
                $.ajax({
                    type: "POST",
                    url: "/login/checkLogin/" + Math.random(),
                    data: $("#login_form").serialize(),
                    dataType: "json",
                    success: function(msg) {
                        var str = msg.error;
                        if (msg.flag === 1) {
                            $.dialog('验证成功，正在登录');
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
            
            $("#varifyCode").click(function(){
                $("#varifyCode").attr('src','/validate/doimg/'+Math.random());
            });
        });
    </script>
</html>