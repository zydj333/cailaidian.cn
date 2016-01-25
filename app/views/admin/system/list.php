<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

            });
        </script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="/">首页</a></li>
                <li><a href="/admin_system/index">管理员操作</a></li>
                <li><a href="/admin_system/index">模块列表</a></li>
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
                        <th>模块名称</th>
                        <th>控制器</th>
                        <th>操作方法</th>
                        <th>父级ID</th>
                        <th>排序</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->controllers; ?></td>
                                <td><?php echo $value->actions; ?></td>
                                <td><?php echo $value->pid; ?></td>
                                <td><?php echo $value->salt; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$value->addtime); ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $value->id; ?>);">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink" onclick="return del(<?php echo $value->id; ?>);">删除</a></td>
                            </tr> 
                            <?php if (!empty($value->second)): ?>
                                <?php foreach ($value->second as $second_key => $second_value): ?>
                                    <tr align="center">
                                        <td><?php echo $second_value->id; ?></td>
                                        <td><?php echo $second_value->title; ?></td>
                                        <td><?php echo $second_value->controllers; ?></td>
                                        <td><?php echo $second_value->actions; ?></td>
                                        <td style="color: red;"><?php echo $second_value->pid; ?></td>
                                        <td><?php echo $second_value->salt; ?></td>
                                        <td><?php echo date('Y-m-d H:i:s',$second_value->addtime); ?></td>
                                        <td><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $second_value->id; ?>);">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink" onclick="return del(<?php echo $second_value->id; ?>);"> 删除</a></td>
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
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
            function add() {
                $.ajax({
                    url: '/admin_system/add/'+ Math.random(),
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
            
            function edit(id){
                $.ajax({
                    url: '/admin_system/edit/'+id+'/'+ Math.random(),
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
            
            function del(id){
                $.ajax({
                    url: '/admin_system/del/'+id+'/'+ Math.random(),
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