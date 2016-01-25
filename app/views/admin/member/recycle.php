<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript">
            function recycle(id) {
                $.ajax({
                    url: '/admin_member_recycle/recycle/' + id + '/' + Math.random(),
                    success: function() {
                        location.href = "/admin_member_recycle/index";
                    },
                    cache: false
                });
            }
            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var account = $("#account").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_member_recycle/ajaxList/" + Math.random(),
                    data: { 'nowpage': nowpage,'account': account},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td width="70">' + values.id + '</td>';
                                str += '<td width="350">' + values.account + '</td>';
                                str += '<td>' + values.truename + '</td>';
                                str += '<td>' + values.cardno + '</td>';
                                str += '<td width="150">' + values.email + '</td>';
                                str += '<td width="150">' + values.phone + '</td>';
                                str += '<td>';
                                if (values.is_del == 0) {
                                    str += '否';
                                } else {
                                    str += '已删除';
                                }
                                str += '</td>';
                                str += '<td>';
                                str += '<a onclick="return check(' + values.id + ')" href="javascript:void(0);" class="tablelink">还原</a>';
                                str += '</td>';
                                str += '</tr>';
                            });
                        }
                        $("#datalist").html(str);
                        $("#page_url").html(data.pageurl);
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
                <li><a href="/admin_member/index">管理员操作</a></li>
                <li><a href="/admin_member_recycle/index">用户回收站</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <ul class="seachform">
                <li><label>查询用户名</label><input name="account" id="account" type="text" class="scinput" /></li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="查询"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>登录帐号</th>
                        <th>用户姓名</th>
                        <th>推荐人手机</th>
                        <th>邮箱地址</th>
                        <th>联系电话</th>
                        <th>是否删除</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->account; ?></td>
                                <td><?php echo $value->truename; ?></td>
                                <td><?php echo $value->cardno; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->phone; ?></td>
                                <td><?php if ($value->is_del == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><a onclick="return recycle(<?php echo $value->id; ?>)" href="javascript:void(0);" class="tablelink">还原</a></td>
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