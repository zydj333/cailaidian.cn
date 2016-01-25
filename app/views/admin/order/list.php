<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>static/admin/css/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/select-ui.min.js"></script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="/">首页</a></li>
                <li><a href="/admin_order/index">产品订单管理</a></li>
                <li><a href="/admin_order/index">产品订单列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>订单编号</label><input name="order_sn" id="order_sn" type="text" class="scinput" /></li>
                    <li><label>用户名称</label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label>当前状态</label>
                        <div class="vocation">
                            <select class="select1" name="order_status" id="order_status">
                                <option value="-1">全部</option>
                                <option value="0">待审核</option>
                                <option value="1">已通过</option>
                                <option value="2">已驳回</option>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="搜索"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>订单编号</th>
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>用户名称</th>
                        <th>预约金额</th>
                        <th>报单人员</th>
                        <th>打款时间</th>
                        <th>当前状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->order_sn; ?></td>
                                <td><?php echo $value->	product_id; ?></td>
                                <td><?php echo $value->product_name; ?></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->money; ?>万</td>
                                <td><?php echo $value->poster; ?></td>
                                <td><?php echo $value->date; ?></td>
                                <td><?php if ($value->order_status == 0): ?><span style="color: blue;">未审核</span><?php elseif ($value->order_status == 1): ?><span style="color: red;">审核通过</span><?php else: ?><span style="color: gray;">已驳回</span><?php endif; ?></td>
                                <td><a href="javascript:void(0);" onclick="return delorder(<?php echo $value->id; ?>);" class="tablelink">进行审核操作</a></td>
                            </tr> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $page_url; ?> </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">

$(document).ready(function(e) {
    $(".select1").uedSelect({
        width: 150
    });

    $('.tablelist tbody tr:odd').addClass('odd');
});
//搜索
function searchItemsList() {
    getPageUrl(1);
}
//分页
function getPageUrl(nowpage) {
    var order_sn = $("#order_sn").val();
    var username = $("#username").val();
    var order_status = $("#order_status").val();
    $.ajax({
        type: "POST",
        url: "/admin_order/ajaxList/" + Math.random(),
        data: {'nowpage': nowpage, 'order_sn': order_sn, 'username': username, 'order_status': order_status},
        dataType: "json",
        success: function(data) {
            var str = '';
            if (data.flag == 0) {
                str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
            } else {
                $.each(data.error, function(key, values) {
                    str += '<tr>';
                    str += '<td>' + values.id + '</td>';
                    str += '<td>' + values.order_sn + '</td>';
                    str += '<td>' + values.product_id + '</td>';
                    str += '<td>' + values.product_name + '</td>';
                    str += '<td>' + values.name + '</td>';
                    str += '<td>' + values.money + '万</td>';
                    str += '<td>' + values.poster + '</td>';
                    str += '<td>' + values.date + '</td>';
                    str += '<td>';
                    if (values.order_status == 0) {
                        str += '<span style="color: blue;">未审核</span>';
                    } else if (values.order_status == 1) {
                        str += '<span style="color: red;">审核通过</span>';
                    }else{
                        str += '<span style="color: gray;">已驳回</span>';
                    }
                    str += '</td>';
                    str += '<td>';
                    str += '<a href="javascript:void(0);" onclick="return delorder(' + values.id + ')" class="tablelink">进行审核操作</a></td>';
                    str += '</td>';
                    str += '</tr>';
                });
            }
            $("#datalist").html(str);
            $("#page_url").html(data.pageurl);
        }
    });
}

function delorder(order_id) {
    $.ajax({
        url: '/admin_order/delOrder/' + order_id + '/' + Math.random(),
        success: function(data) {
            art.dialog({
                lock: true,
                background: '#600', // 背景色
                opacity: 0.90, // 透明度
                content: data,
                //icon: 'succeed',
                cancel: function() {
                    location.href = "/admin_order/index";
                },
                ok: function() {
                    location.href = "/admin_order/index";
                }
            });
        },
        cache: false
    });
}
</script>