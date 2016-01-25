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
                <li><a href="/admin_product_order/index">产品预约订单管理</a></li>
                <li><a href="/admin_product_order/index">产品预约订单列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>订单编号</label><input name="order_sn" id="order_sn" type="text" class="scinput" /></li>
                    <li><label>手机号码</label><input name="celephone" id="celephone" type="text" class="scinput" /></li>
                    <li><label>用户名称</label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label>当前状态</label>
                        <div class="vocation">
                            <select class="select1" name="is_success" id="is_success">
                                <option value="-1">全部</option>
                                <option value="0">未处理</option>
                                <option value="1">已处理</option>
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
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>联系电话</th>
                        <th>预约金额</th>
                        <th>客户描述</th>
                        <th>预约时间</th>
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
                                <td><?php echo $value->pid; ?></td>
                                <td><?php echo $value->product_name; ?></td>
                                <td><?php echo $value->uid; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td><?php echo $value->telephone; ?></td>
                                <td><?php echo $value->amount; ?>万</td>
                                <td><?php echo $value->description; ?></td>
                                <td><?php echo date('Y-m-d H:i:s', $value->createtime); ?></td>
                                <td><?php if ($value->is_success == 0): ?><span style="color: blue;">未处理</span><?php elseif ($value->is_success == 1): ?><span style="color: red;">已处理</span><?php endif; ?></td>
                                <td><?php if ($value->is_success == 0): ?><a href="javascript:void(0);" onclick="return delOrder(<?php echo $value->id; ?>)" class="tablelink">设为已处理</a><?php else: ?>您不能做任何操作<?php endif; ?></td>
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
        var celephone = $("#celephone").val();
        var username = $("#username").val();
        var is_success = $("#is_success").val();
        $.ajax({
            type: "POST",
            url: "/admin_product_order/ajaxList/" + Math.random(),
            data: {'nowpage': nowpage, 'order_sn': order_sn, 'celephone': celephone, 'username': username, 'is_success': is_success},
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
                        str += '<td>' + values.pid + '</td>';
                        str += '<td>' + values.product_name + '</td>';
                        str += '<td>' + values.uid + '</td>';
                        str += '<td>' + values.username + '</td>';
                        str += '<td>' + values.telephone + '</td>';
                        str += '<td>' + values.amount + '万</td>';
                        str += '<td>' + values.description + '</td>';
                        str += '<td>' + values.createtime + '</td>';
                        str += '<td>';
                        if (values.is_success == 0) {
                            str += '<span style="color: blue;">未处理</span>';
                        } else if (values.is_success == 1) {
                            str += '<span style="color: red;">已处理</span>';
                        }
                        str += '</td>';
                        str += '<td>';
                        if (values.is_success == 0) {
                            str += '<a href="javascript:void(0);" onclick="return delOrder(' + values.id + ')" class="tablelink">设为已处理</a></td>';
                        } else {
                            str += '你不能做任何操作';
                        }
                        str += '</td>';
                        str += '</tr>';
                    });
                }
                $("#datalist").html(str);
                $("#page_url").html(data.pageurl);
            }
        });
    }

    function delOrder(order_id) {
        $.ajax({
            url: '/admin_product_order/cancelOrder/' + order_id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    //icon: 'succeed',
                    //cancel: true,
                    ok: function() {
                        location.href = "/admin_product_order/index";
                    }
                });
            },
            cache: false
        });
    }
</script>