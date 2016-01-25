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
                <li><a href="">首页</a></li>
                <li><a href="">财务管理</a></li>
                <li><a href="">积分详情</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left">
                    <td style="width:300px">自增ID：<?php echo $new->id; ?></td>
                </tr>
                <tr align="left">
                    <td>用户手机：<?php echo $new->account; ?></td>
                </tr>
                <tr align="left">
                    <td>总积分：<?php echo $new->points; ?></td>
                </tr>
                <tr align="left">
                    <td>已用积分：<?php echo $new->pointsuse; ?></td>
                </tr>
                <tr align="left">
                    <td>可用积分：<?php echo $new->pointsnow; ?></td>
                </tr>
                <tr align="left">
                    <td>变动类型：<?php echo $new->type; ?></td>
                </tr>
                <tr align="left">
                    <td>变更时间：<?php echo date('Y-m-d H:i:s',$new->createtime); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>