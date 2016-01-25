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
                <li><a href="/admin_planner/index">理财师管理</a></li>
                <li><a href="/admin_planner_product/index">理财师产品列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>项目名称</label><input name="product_name" id="product_name" type="text" class="scinput" /></li>
                    <li><label>上传者</label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label>产品分类</label>
                        <div class="vocation">
                            <select class="select1" name="category" id="category">
                                <option value="0">全部</option>
                                <?php foreach ($cate as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>"><?php echo $v->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </li>
                    <li><label>所在省份</label>
                        <div class="vocation">
                            <select class="select1" name="province" id="province">
                                <option value="0">全部</option>
                                <?php foreach ($province as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="搜索"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>项目ID</th>
                        <th>上传者</th>
                        <th>产品名称</th>
                        <th>产品类别</th>
                        <th>发行机构</th>
                        <th>产品期限</th>
                        <th>产品规模</th>
                        <th>投资门槛</th>
                        <th>收益率</th>
                        <th>发行费用</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td><?php echo $value->product_name; ?></td>
                                <td><?php echo $value->category_name; ?></td>
                                <td><?php echo $value->company; ?></td>
                                <td><?php echo $value->month; ?>个月</td>
                                <td><?php echo $value->amount; ?>万</td>
                                <td><?php echo $value->support_limit; ?>万</td>
                                <td><?php echo $value->interest; ?></td>
                                <td><?php echo $value->fee; ?></td>
                                <td><a href="javascript:void(0);" onclick="return showDetial(<?php echo $value->id; ?>);" class="tablelink">查看详情</a></td>
                            </tr> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $page_url; ?> </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue">
</script>
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
        var product_name = $("#product_name").val();
        var username = $("#username").val();
        var category = $("#category").val();
        var province = $("#province").val();
        $.ajax({
            type: "POST",
            url: "/admin_planner_product/ajaxList/" + Math.random(),
            data: {'nowpage': nowpage, 'product_name': product_name, 'username': username, 'category': category, 'province': province},
            dataType: "json",
            success: function(data) {
                var str = '';
                if (data.flag == 0) {
                    str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                } else {
                    $.each(data.error, function(key, values) {
                        str += '<tr>';
                        str += '<td>' + values.id + '</td>';
                        str += '<td>' + values.username + '</td>';
                        str += '<td>' + values.product_name + '</td>';
                        str += '<td>' + values.category_name + '</td>';
                        str += '<td>' + values.company + '</td>';
                        str += '<td>' + values.month + '个月</td>';
                        str += '<td>' + values.amount + '万</td>';
                        str += '<td>' + values.support_limit + '万</td>';
                        str += '<td>' + values.interest + '</td>';
                        str += '<td>' + values.fee + '</td>';
                        str += '<td>';
                        str += '<a href="javascript:void(0);" onclick="return showDetial(' + values.id + ')" class="tablelink">查看详情</a></td>';
                        str += '</td>';
                        str += '</tr>';
                    });
                }
                $("#datalist").html(str);
                $("#page_url").html(data.pageurl);
            }
        });
    }

    function showDetial(pro_id) {
        $.ajax({
            url: '/admin_planner_product/detial/' + pro_id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    width: 800,
                    //cancel:true,
                    ok: true
                });
            },
            cache: false
        });
    }
</script>