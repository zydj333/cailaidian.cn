<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>您所访问的页面未找到</title>
        <meta name="viewport" content="width=device-width"/>
        <meta name="robots" content="all" />
        <link href="/static/home/css/common.css" rel="stylesheet" />
        <link href="/static/home/css/pagerstyles.css" rel="stylesheet" />
         <script type="text/javascript" src="/static/home/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/static/home/js/gotop.js"></script>
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
                                    <li><a href="/login">登录</a></li>
                                    <li><a href="/register">注册</a></li>
                                    <li><a href="/download">理财APP</a></li>
                                    <li><a href="/help/about_us" style="padding-right:0;border:none;">关于我们</a></li>
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
                                    <a href="/">
                                        <img src="/static/home/image/logo_03.jpg" alt="财来电logo"/>
                                    </a>
                                </div>
                                <div class="back_to_home f-fr">
                                    <img src="/static/home/image/shouye_icon.png" class="f-fl" alt=""/><a href="/" class="f-fr">财来电首页</a>
                                </div>
                                <div class="cb"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--下面是主体-->
            <div class="denglu_main_bg">
                <h2 style=" font-size: 24px; padding-top: 100px;padding-bottom: 100px; width: 100%; text-align: center;">出错啦！<?php echo $message;?><?php if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!=''):?><a href="<?php echo $_SERVER['HTTP_REFERER'];?>"></a> 或者 <?php endif;?><a href="<?php echo base_url();?>">首页</a></h2>
                <div style=" height: 250px;"></div>
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