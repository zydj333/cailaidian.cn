<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>资讯详情</title>
        <link href="<?php echo base_url(); ?>static/admin/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php foreach ($member as $value): ?>
            <div class="place">
                <span>位置</span>
                <ul class="placeul">
                    <li><a href="<?php echo base_url(); ?>admin_index/index">首页</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_member">前台用户管理</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_member/detial/<?php echo $value->id; ?>">用户详情</a></li>
                </ul>
            </div>
            <div class="rightinfo">
                <table class="tablelist">
                    <tr align="left">
                        <td>用户头像：<img src="<?php echo base_url() . $value->head_ico; ?>" onerror="this.onerror='';this.src='/static/admin/images/img14.png'" /></td>
                        <td>用户名片：<img src="<?php echo base_url() . $value->businesscard; ?>" onerror="this.onerror='';this.src='/static/admin/images/img14.png'" /></td>
                        <td>自增ID：<?php echo $value->id; ?></td>
                    </tr>
                    <tr align="left">
                        <td>用户名：<?php echo $value->account; ?></td>
                        <td>手机号码：<?php echo $value->phone; ?></td>
                        <td>邮箱：<?php echo $value->email; ?></td>
                    </tr>
                    <tr align="left">
                        <td>是否审核通过：<?php if ($value->ischeck == 1): ?>是<?php else: ?><span style="color:red;">否</span><?php endif; ?></td>
                        <td>帐号是否删除：<?php if ($value->is_del == 0): ?>否<?php else: ?><span style="color:red;">是</span><?php endif; ?></td>
                        <td>性别：<?php if ($value->sex == 0): ?>男<?php else: ?>女<?php endif; ?></td>
                    </tr>
                    <tr align="left">
                        <td>真实姓名：<?php echo $value->truename; ?></td>
                        <?php if (!empty($card)): ?>
                            <?php foreach ($card as $v): ?>
                                <?php if ($v->account = $value->cardno): ?>
                                    <td>推荐人姓名：<?php echo $v->truename; ?></td>
                                    <td>推荐人电话：<?php echo $v->cardno; ?></td>
                                <?php else: ?>
                                    <td>推荐人姓名：未填写</td>
                                    <td>推荐人电话：未填写</td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>  
                    </tr>
                    <tr align="left">
                        <td>金币总数：<?php echo $value->goldnum; ?></td>
                        <td>已用金币：<?php echo $value->golduse; ?></td>
                        <td>剩余金币：<?php echo $value->goldnow; ?></td>
                    </tr>
                    <tr align="left">
                        <td>用户积分：<?php echo $value->points; ?></td>
                        <td>已用积分：<?php echo $value->pointsuse; ?></td>
                        <td>剩余积分：<?php echo $value->pointsnow; ?></td>
                    </tr>
                    <tr align="left">
                        <td>可用余额：<?php echo $value->available_predeposit; ?></td>
                        <td>冻结余额：<?php echo $value->freeze_predeposit; ?></td>
                        <td>地址：<?php echo $value->address; ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
        </div>
    </body>
</html>