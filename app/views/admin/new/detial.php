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
                <li><a href="<?php echo base_url(); ?>admin_new">资讯管理</a></li>
                <li><a href="<?php echo base_url(); ?>admin_new/detial/<?php echo $new->id; ?>">资讯详情</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left">
                    <td>封面图片：<img style="width:200px;height:200px;" src="<?php echo base_url().$new->imageurl; ?>"></img></td>
                </tr>
                <tr align="left">
                    <td>资讯类别：
                        <?php foreach ($category as $k => $v) : ?>
                        <?php if ($new->ac_id == $v->ac_id): ?>
                            <?php echo $v->name ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr align="left">
                    <td>资讯标题：<?php echo $new->title; ?></td>
                </tr>
                <tr align="left">
                    <td>资讯描述：<?php echo $new->discription; ?></td>
                </tr>
                <tr align="left">
                    <td>查询别名：<?php echo $new->search_name; ?></td>
                </tr>
                <tr align="left">
                    <td>优化标题：<?php echo $new->seo_title; ?></td>
                </tr>
                <tr align="left">
                    <td>优化关键字：<?php echo $new->seo_keyword; ?></td>
                </tr>
                <tr align="left">
                    <td>优化描述：<?php echo $new->seo_discription; ?></td>
                </tr>
                <tr align="left">
                    <td>浏览量：<?php echo $new->views; ?></td>
                </tr>
                <tr align="left">
                    <td>回复数：<?php echo $new->replay; ?></td>
                </tr>
                <tr align="left">
                    <td>资讯内容：<?php echo $new->content; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>