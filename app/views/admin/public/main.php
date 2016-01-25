<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>正文部分</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script src="/static/admin/js/jquery.js" type="text/javascript" ></script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="#">首页</a></li>
            </ul>
        </div>
        <div class="mainindex">
            <div class="welinfo">
                <span><img src="/static/admin/images/sun.png" alt="天气" /></span>
                <b><?php echo $userinfo->user_account; ?>您好，欢迎使用财来电后台管理系统</b>(<?php echo $userinfo->user_email; ?>)
            </div>
            <div class="xline"></div>
            <div class="box"></div>
            <div class="welinfo">
                <span><img src="/static/admin/images/time.png" alt="时间" /></span>
                <b>本周动态</b>
            </div>
            <ul class="iconlist">
                <li><img src="/static/admin/images/ico03.png" /><p style="color:red;">今日新增会员数：<?php echo $yesterday ;?>人</p></li>
                <li><img src="/static/admin/images/ico03.png" /><p style="color:red;">本周新增会员数：<?php echo $week ;?>人</p></li>
                <li><img src="/static/admin/images/ico02.png" /><p style="color:red;">今日新增订单：<?php echo $yesorder ;?>单</p></li>
                <li><img src="/static/admin/images/ico02.png" /><p style="color:red;">本周新增订单：<?php echo $weekorder ;?>单</p></li>
            </ul>
            <div class="xline"></div>
            <div class="box"></div>
            <div class="welinfo">
                <span><img src="/static/admin/images/dp.png" alt="提醒" /></span>
                <b>统计数据</b>
            </div>
            <ul class="iconlist">
                <li><img src="/static/admin/images/ico01.png" /><p style="color:red;">会员总数：<?php echo $count ;?>人</p></li>
                <li><img src="/static/admin/images/ico05.png" /><p style="color:red;">产品总数：<?php echo $pro ;?>个</p></li>
                <li><img src="/static/admin/images/ico03.png" /><p style="color:red;">订单总数：<?php echo $order ;?>单</p></li>
                <li><img src="/static/admin/images/ico02.png" /><p style="color:red;">留言总数：<?php echo $message ;?>条</p></li>
                <li><img src="/static/admin/images/ico06.png" /><p style="color:red;">订单总金额：<?php echo $num ;?>元</p></li>
            </ul>
            <div class="xline"></div>
            <div class="uimakerinfo"><b>系统信息</b></div>
            <ul class="umlist">
                <li style="padding-right: 17px;">服务器操作系统:<p style="color:red;"><?php echo php_uname('s');?></p></li>
                <li style="padding-right: 17px;">数据库版本:<p style="color:red;">MySQL <?php echo $mysql; ?></p></li>
                <li style="padding-right: 17px;">运行环境:<p style="color:red;"><?php echo apache_get_version();?></p></li>
            </ul>
        </div>
    </body>
</html>
