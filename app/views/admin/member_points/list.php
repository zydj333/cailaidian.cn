<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
            function dialogalert(value) {
                $.ajax({
                    url: '/admin_financial_points/detial/' + value + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#DDD', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            //icon: 'succeed',
                            //cancel: true,
                        });
                    },
                    cache: false
                });
            }
            function getLocalTime(nS) {
                return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
            }
            
            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var account = $("#account").val();
                var type = $("#type").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_financial_points/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'account': account, 'type': type},
                    dataType: "json",
                    success: function (data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function (key, values) {
                                str += '<tr align="left">';
                                str += '<td width="70">' + values.id + '</td>';
                                str += '<td>' + values.account + '</td>';
                                str += '<td>' + values.change + '</td>';
                                str += '<td>' + values.points + '</td>';
                                str += '<td>' + values.pointsuse + '</td>';
                                str += '<td>' + values.pointsnow + '</td>';
                                str += '<td>' + values.type + '</td>';
                                str += '<td width="150">' + getLocalTime(values.createtime) + '</td>';
                                str += '<td>';
                                str += '<a onclick="return dialogalert(' + values.id + ')" href="javascript:void(0);" class="tablelink">详情</a>';
                                str += '</td>';
                                str += '</tr>';
                            });
                        }
                        $("#datalist").html(str);
                        $("#url").html(data.pageurl);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="">首页</a></li>
                <li><a href="">财务管理</a></li>
                <li><a href="/admin_financial_points/index">用户积分</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <ul class="seachform">
                <li><label>积分类型</label><input name="type" id="type" type="text" class="scinput" /></li>
                <li><label>用户手机</label><input name="account" id="account" type="type" class="scinput" /></li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="查询"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>用户手机</th>
                        <th>本次变动</th>
                        <th>总积分</th>
                        <th>已用积分</th>
                        <th>剩余积分</th>
                        <th>变动类型</th>
                        <th>变更时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->account; ?></td>
                                <td><?php echo $value->change; ?></td>
                                <td><?php echo $value->points; ?></td>
                                <td><?php echo $value->pointsuse; ?></td>
                                <td><?php echo $value->pointsnow; ?></td>
                                <td><?php echo $value->type; ?></td>
                                <td><?php echo date('Y-m-d H:i:s', $value->createtime); ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return dialogalert(<?php echo $value->id; ?>)">详情</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="url"><?php echo $url; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>