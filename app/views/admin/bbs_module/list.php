<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="">首页</a></li>
                <li><a href="/admin_bbs_module/index">社区管理</a></li>
                <li><a href="/admin_bbs_module/index">社区模块</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <a href='javascript:void(0);' onclick="return add();"><li class="click"><span><img src="/static/admin/images/t01.png" /></span>添加</li></a>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>图片预览</th>
                        <th>自增ID</th>
                        <th>父级ID</th>
                        <th>分类名称</th>
                        <th>话题数</th>
                        <th>描述</th>
                        <th>排序</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td width="100"><img src="<?php echo base_url() . '/' . $value->cate_image_url; ?>" style="width: 100px;height: 50px"</td>
                                <td><?php echo $value->cate_id; ?></td>
                                <td><?php echo $value->cate_pid; ?></td>
                                <td><?php echo $value->cate_name; ?></td>
                                <td><?php echo $value->cate_topic_num; ?></td>
                                <td><?php echo $value->cate_description; ?></td>
                                <td><?php echo $value->cate_salt; ?></td>
                                <td><?php echo date('Y-m-d H:i:s', $value->cate_create_time); ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $value->cate_id; ?>);">修改</a></td>
                            </tr>
                            <?php if (!empty($value->second)): ?>
                                <?php foreach ($value->second as $key => $value): ?>
                                    <tr align="center">
                                        <td width="100"><img src="<?php echo base_url() . '/' . $value->cate_image_url; ?>" style="width: 100px;height: 50px"</td>
                                        <td><?php echo $value->cate_id; ?></td>
                                        <td><?php echo $value->cate_pid; ?></td>
                                        <td><?php echo $value->cate_name; ?></td>
                                        <td><?php echo $value->cate_topic_num; ?></td>
                                        <td><?php echo $value->cate_description; ?></td>
                                        <td><?php echo $value->cate_salt; ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', $value->cate_create_time); ?></td>
                                        <td><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $value->cate_id; ?>);">修改</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue">
</script>
<script type="text/javascript">
    function add() {
        $.ajax({
            url: '/admin_bbs_module/add/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    //icon: 'succeed',
                    //cancel: true,
                    //ok:true,
                });
            },
            cache: false
        });
    }

    function edit(id) {
        $.ajax({
            url: '/admin_bbs_module/edit/' + id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    //icon: 'succeed',
                    //cancel: true,
                    //ok:true,
                });
            },
            cache: false
        });
    }
</script>