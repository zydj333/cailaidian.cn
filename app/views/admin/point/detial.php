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
                <li><a href="<?php echo base_url(); ?>admin_point">商品管理</a></li>
                <li><a href="<?php echo base_url(); ?>admin_point/detial/<?php echo $new->id; ?>">商品详情</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left">
                    <td>封面图片：<img style="width: 30px;height: 30px;" src="<?php echo base_url().$new->img; ?>"</td>
                </tr>
                <tr align="left">
                    <td>封面图片2：<img style="width: 30px;height: 30px;" src="<?php echo base_url().$new->img2; ?>"</td>
                </tr>
                <tr align="left">
                    <td>封面图片3：<img style="width: 30px;height: 30px;" src="<?php echo base_url().$new->img3; ?>"</td>
                </tr>
                <tr align="left">
                    <td>封面图片4：<img style="width: 30px;height: 30px;" src="<?php echo base_url().$new->img4; ?>"</td>
                </tr>
                <tr align="left">
                    <td>商品类别：
                        <?php foreach ($category as $k => $v) : ?>
                        <?php if ($new->type_id == $v->id): ?>
                            <?php echo $v->name ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr align="left">
                    <td>商品标题：<?php echo $new->name; ?></td>
                </tr>
                <tr align="left">
                    <td>市场价格：<?php echo $new->price; ?></td>
                </tr>
                <tr align="left">
                    <td>所需积分：<?php echo $new->points; ?></td>
                </tr>
                <tr align="left">
                    <td>商品介绍：<?php echo $new->content; ?></td>
                </tr>
                <tr align="left">
                    <td>添加时间：<?php echo date('Y-m-d H:i:s',$new->addtime); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>