<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>资讯详情</title>
        <link href="<?php echo base_url(); ?>static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
            function del(id) {
                $.ajax({
                    url: '/admin_bbs_question/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        location.href = "/admin_bbs_question/index";
                    },
                    cache: false
                });
            }
        </script>
    </head>
    <body>
        <div class="place">
            <span>位置</span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/index">首页</a></li>
                <li><a href="">资讯管理</a></li>
                <li><a href="">问答详情</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <?php if (!empty($info)): ?>
                <thead>
                    <tr align="left" style="border-bottom:1px dotted #CBCBCB">
                        <td>回复内容</td>
                        <td>回复者</td>
                        <td>是否采纳</td>
                        <td>回复时间</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <?php foreach ($info as $key => $value):?>
                <tr align="left" style="border-bottom:1px dotted #CBCBCB">
                    <td style="width:300px;"><?php echo $value->content; ?></td>
                    <td><?php echo $value->username; ?></td>
                    <td>
                        <?php 
                            if($value->assist == 1){
                                echo '已采纳答案';
                            } else {
                                echo '未采纳';
                            }
                        ?>
                    </td>
                    <td><?php echo date('Y-m-d H:i:s',$value->create_time); ?></td>
                    <td><a href="" onclick="return del(<?php echo $value->id; ?>)">删除该回复</a></td>
                </tr>
                <?php endforeach;?>
                <?php else:?>
                <tr align="left">
                    <td>没有回复</td>
                </tr>
                <?php endif;?>
            </table>
        </div>
    </body>
</html>