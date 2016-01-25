<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="/static/admin/css/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript" src="/static/admin/js/select-ui.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".select3").uedSelect({
                    width: 145
                });
            });
            
            function getLocalTime(nS) {     
                return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
             }
             
            function dialogalert(value) {
                $.ajax({
                    url: '/admin_point/detial/' + value + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#DDD', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            //icon: 'succeed',
                            cancel: true,
                        });
                    },
                    cache: false
                });
            }

            function del(id) {
                $.ajax({
                    url: '/admin_point/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        location.href = "/admin_point/index";
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
                var type_id = $("#type_id").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_point/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'name': name, 'type_id': type_id},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td width="70">' + values.id + '</td>';
                                str += '<td width="350">' + values.name + '</td>';
                                str += '<td>' + values.typename + '</td>';
                                str += '<td>' + values.price + '</td>';
                                str += '<td>' + values.points + '</td>';
                                str += '<td width="150">' + getLocalTime(values.addtime) + '</td>';
                                str += '<td>';
                                if (values.status == 0) {
                                    str += '否';
                                } else {
                                    str += '是';
                                }
                                str += '</td>';
                                str += '<td>';
                                str += '<a onclick="return dialogalert(' + values.id + ')" href="javascript:void(0);" class="tablelink">详情</a>&nbsp;&nbsp;';
                                str += '<a href="/admin_point/edit/' + values.id + '" class="tablelink">修改</a>&nbsp;&nbsp;';
                                str += '<a onclick="return del(' + values.id + ')" href="javascript:void(0);" class="tablelink">删除</a>';
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
                <li><a href="/admin_user/index">管理员操作</a></li>
                <li><a href="/admin_point/index">商品列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <a href='<?php echo site_url('admin_point/add'); ?>'><li class="click"><span><img src="/static/admin/images/t01.png" /></span>添加</li></a>
                </ul>
            </div>
            <ul class="seachform">
                <li><label>商品名称</label><input name="name" id="name" type="text" class="scinput" /></li>
                <li><label>分类</label>
                    <div class="vocation">
                        <select class="select3" name="type_id" id="type_id">
                            <option value="-1">所有分类</option>
                            <?php foreach ($type as $k => $v): ?>
                                <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="查询"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>商品名称</th>
                        <th>所属分类</th>
                        <th>市场价</th>
                        <th>所需积分</th>
                        <th>添加时间</th>
                        <th>是否删除</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->typename; ?></td>
                                <td><?php echo $value->price; ?></td>
                                <td><?php echo $value->points; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$value->addtime); ?></td>
                                <td><?php if ($value->status == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return dialogalert(<?php echo $value->id; ?>)">详情</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('admin_point/edit') . '/' . $value->id; ?>" class="tablelink">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink"  onclick="return del(<?php echo $value->id; ?>);"> 删除</a></td>
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