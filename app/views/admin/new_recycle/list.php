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
            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var title = $("#title").val();
                var search_name = $("#search_name").val();
                var ac_id = $("#ac_id").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_new_recycle/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'title': title, 'search_name': search_name, 'ac_id': ac_id},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td width="70">' + values.id + '</td>';
                                str += '<td width="350">' + values.title + '</td>';
                                str += '<td>' + values.search_name + '</td>';
                                str += '<td>' + values.typename + '</td>';
                                str += '<td width="150">' + values.article_time + '</td>';
                                str += '<td>';
                                if (values.sts == 0) {
                                    str += '否';
                                } else {
                                    str += '是';
                                }
                                str += '</td>';
                                str += '<td>';
                                str += '<a onclick="return recycle(' + values.id + ')" href="javascript:void(0);" class="tablelink">还原</a>';
                                str += '</td>';
                                str += '</tr>';
                            });
                        }
                        $("#datalist").html(str);
                        $("#page_url").html(data.pageurl);
                    }
                });
            }
            
            function recycle(id) {
                $.ajax({
                    url: '/admin_new_recycle/recycle/' + id + '/' + Math.random(),
                    success: function(data) {
                                location.href = "/admin_new_recycle/index";
                            }
                        });
            }
        </script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="/">首页</a></li>
                <li><a href="/admin_user/index">管理员操作</a></li>
                <li><a href="/admin_new_recycle/index">资讯回收站</a></li>
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
                        <th>自增ID</th>
                        <th>查询别名</th>
                        <th>资讯标题</th>
                        <th>资讯描述</th>
                        <th>添加时间</th>
                        <th>逻辑删除</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->search_name; ?></td>
                                <td width="350"><?php echo $value->title; ?></td>
                                <td width="200"><?php echo $value->discription; ?></td>
                                <td width="150"><?php echo date('Y-m-d, H:i:s',$value->article_time); ?></td>
                                <td><?php if ($value->sts == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink"  onclick="return recycle(<?php echo $value->id; ?>);"> 还原</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $url; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>