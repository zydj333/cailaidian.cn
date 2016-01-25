<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>资讯详情</title>
        <link href="<?php echo base_url(); ?>static/admin/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="place">
            <span>位置</span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/index">首页</a></li>
                <li><a href="">其他管理</a></li>
                <li><a href="<?php echo base_url(); ?>admin_email/detial/<?php echo $new->id; ?>">邮件详情</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left" style="border-bottom:1px dotted #CBCBCB">
                    <td>邮箱地址：<?php echo $new->email; ?></td>
                </tr>
                <tr align="left" style="border-bottom:1px dotted #CBCBCB">
                    <td>邮件标题：<?php echo $new->title; ?></td>
                </tr>
                <tr align="left" style="border-bottom:1px dotted #CBCBCB">
                    <td width="850px;">邮件内容：<?php echo $new->content; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>