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
                <li><a href="/admin_setpower/index">模块列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <!--<div class="tools">
                <ul class="toolbar">
                    <a href='javascript:void(0);' onclick="return add();"><li class="click"><span><img src="/static/admin/images/t01.png" /></span>添加</li></a>
                    <a><li class="click"><span><img src="/static/admin/images/t02.png" /></span>修改</li></a>
                    <a><li><span><img src="/static/admin/images/t03.png" /></span>删除</li></a>
                    <a><li><span><img src="/static/admin/images/t04.png" /></span>统计</li></a>
                </ul>
            </div>-->
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>用户ID</th>
                        <th>登录帐号</th>
                        <th>用户名称</th>
                        <th>当前权限</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->account; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td><?php if ($value->power == 0 || $value->powername == ''): ?><span style="color:red;">还未分配</span><?php else: ?><span style="color:blue;"><?php echo $value->powername; ?></span><?php endif; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $value->id; ?>);">分配权限</a></td>
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
            function edit(uid) {
                $.ajax({
                    url: '/admin_setpower/edit/' + uid + '/' + Math.random(),
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