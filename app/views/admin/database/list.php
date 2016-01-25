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
                <li><a href="/admin_system/index">开发者中心</a></li>
                <li><a href="/admin_database/index">数据库结构</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>表名称</th>
                        <th>表类型</th>
                        <th>表引擎</th>
                        <th>数据大小</th>
                        <th>碎片空间</th>
                        <th>添加时间</th>
                        <th>表描述</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value->TABLE_NAME; ?></td>
                                <td><?php echo $value->TABLE_TYPE; ?></td>
                                <td><?php echo $value->ENGINE; ?></td>
                                <td><?php echo $value->DATA_LENGTH; ?>(Bit)</td>
                                <td><?php echo $value->DATA_FREE; ?>(Bit)</td>
                                <td><?php echo $value->CREATE_TIME; ?></td>
                                <td><?php  echo $value->TABLE_COMMENT; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return detial('<?php echo $value->TABLE_NAME; ?>');">查看字段</a></td>
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
            function detial(table_name) {
                $.ajax({
                    url: '/admin_database/detial/' + table_name + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data,
                            //icon: 'succeed',
                            //cancel: true,
                            ok:true,
                        });
                    },
                    cache: false
                });
            }
</script>