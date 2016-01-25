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
                <li><a href="/admin_product/index">产品操作</a></li>
                <li><a href="/admin_product/index">产品列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>产品名称</label><input name="name" id="name" type="text" class="scinput" /></li>
                    <li><label>产品类型</label>
                        <div class="vocation">
                            <select class="select1" name="category" id="category">
                                <option value="0">全部</option>
                                <?php if (!empty($category)): ?>
                                    <?php foreach ($category as $k => $v): ?>
                                        <option value="<?php echo $v->id; ?>"><?php echo $v->title; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </li>
                    <li><label>当前状态</label>
                        <div class="vocation">
                            <select class="select1" name="status" id="status">
                                <option value="0">全部</option>
                                <option value="1">预热</option>
                                <option value="2">认购中</option>
                                <option value="3">已结束</option>
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
                        <th>产品名称</th>
                        <th>产品类型</th>
                        <th>返佣比例</th>
                        <th>项目期限</th>
                        <th>总额度(万)</th>
                        <th>已完成额度(万)</th>
                        <th>完成率</th>
                        <th>是否推荐</th>
                        <th>是否显示</th>
                        <th>当前状态</th>
                        <th>添加时间</th>
                        <th>当前排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->product_name; ?></td>
                                <td><?php echo $value->category_name; ?></td>
                                <td><?php echo $value->fee; ?>%</td>
                                <td><?php echo $value->month; ?></td>
                                <td><?php echo $value->amount; ?></td>
                                <td><?php echo $value->support_amount; ?></td>
                                <td><?php echo $value->progress; ?>%</td>
                                <td><?php if ($value->is_recommen == 1): ?><span style="color:red;">已推荐</span><?php else: ?>不推荐<?php endif; ?></td>
                                <td><?php if ($value->is_show == 1): ?><span style="color:red;">已显示</span><?php else: ?>不显示<?php endif; ?></td>
                                <td><?php if ($value->status == 1): ?>预热<?php elseif ($value->status == 2): ?><span style="color:red;">在售</span><?php else: ?>已结束<?php endif; ?></td>
                                <td><?php echo date('Y-m-d H:i:s', $value->create_time); ?></td>
                                <td><?php echo $value->listorder; ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="tablelink" onclick="return detial(<?php echo $value->id; ?>);">详情</a>&nbsp;&nbsp;
                                    <a href="javascript:void(0);" class="tablelink"  onclick="return cancle(<?php echo $value->id; ?>);"> 恢复</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $page_url; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width: 150
                });
            });
            function detial(id) {
                $.ajax({
                    url: '/admin_product/detial/' + id + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data,
                            //icon: 'succeed',
                            //cancel: true,
                            ok: true,
                        });
                    },
                    cache: false
                });
            }
            function cancle(id) {
                $.ajax({
                    url: '/admin_product_recycle/cancle/' + id + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data,
                            //icon: 'succeed',
                            //cancel: true,
                            ok: function() {
                                location.href = "/admin_product_recycle/index";
                            }
                        });
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
                var name = $("#name").val();
                var category = $("#category").val();
                var status = $("#status").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_product_recycle/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'name': name, 'category': category, 'status': status},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr>';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.product_name + '</td>';
                                str += '<td>' + values.category_name + '</td>';
                                str += '<td>' + values.fee + '%</td>';
                                str += '<td>' + values.month + '个月</td>';
                                str += '<td>' + values.amount + '</td>';
                                str += '<td>' + values.support_amount + '</td>';
                                str += '<td>' + values.progress + '%</td>';
                                str += '<td>';
                                if (values.is_recommen == 1) {
                                    str += '<span style="color:red;">已推荐</span>';
                                } else {
                                    str += '不推荐';
                                }
                                str += '</td>';
                                str += '<td>';
                                if (values.isshow == 1) {
                                    str += '<span style="color:red;">已显示</span>';
                                } else {
                                    str += '不显示';
                                }
                                str += '</td>';
                                str += '<td>';
                                if (values.is_show == 1) {
                                    str += '预热';
                                } else if (values.status == 2) {
                                    str += '<span style="color:red;">在售</span>';
                                } else {
                                    str += '已结束';
                                }
                                str += '</td>';
                                str += '<td>' + values.create_time + '</td>';
                                str += '<td>' + values.listorder + '</td>';
                                str += '<td>';
                                str += '<a href="javascript:void(0);" class="tablelink" onclick="return detial(' + values.id + ');">详情</a>&nbsp;&nbsp;';
                                str += '<a href="/admin_product/edit/' + values.id + '" class="tablelink">修改</a>&nbsp;&nbsp;';
                                str += '<a href="javascript:void(0);" class="tablelink"  onclick="return del(' + values.id + ');"> 删除</a></td>';
                                str += '</tr>';
                            });
                        }
                        $("#datalist").html(str);
                        $("#page_url").html(data.pageurl);
                    }
                });
            }
</script>