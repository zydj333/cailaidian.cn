<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="/">首页</a></li>
                <li><a href="/admin_user/index">管理员操作</a></li>
                <li><a href="/admin_newcate/index">资讯分类</a></li>
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
                        <th>自增ID</th>
                        <th>分类名称</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->ac_id; ?></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->listorder; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $value->ac_id; ?>);">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink"  onclick="return del(<?php echo $value->ac_id; ?>);"> 删除</a></td>
                            </tr>
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
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
            function add() {
                $.ajax({
                    url: '/admin_newcate/add/' + Math.random(),
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
                    url: '/admin_newcate/edit/' + id + '/' + Math.random(),
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

            function del(id) {
                $.ajax({
                    url: '/admin_newcate/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data,
                            //icon: 'succeed',
                            //cancel: true,
                            ok: function() {
                                location.href = "/admin_newcate/index";
                            }
                        });
                    },
                    cache: false
                });
            }
</script>