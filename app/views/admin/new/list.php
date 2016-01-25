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

            function dialogalert(value) {
                $.ajax({
                    url: '/admin_new/detial/' + value + '/' + Math.random(),
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
                    url: '/admin_new/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        location.href = "/admin_new/index";
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
                var title = $("#title").val();
                var search_name = $("#search_name").val();
                var ac_id = $("#ac_id").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_new/ajaxList/" + Math.random(),
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
                                str += '<a onclick="return dialogalert(' + values.id + ')" href="javascript:void(0);" class="tablelink">详情</a>&nbsp;&nbsp;';
                                str += '<a href="/admin_new/edit/' + values.id + '" class="tablelink">修改</a>&nbsp;&nbsp;';
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
                <li><a href="/admin_new/index">资讯列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <a href='<?php echo site_url('admin_new/add'); ?>'><li class="click"><span><img src="/static/admin/images/t01.png" /></span>添加</li></a>
                </ul>
            </div>
            <ul class="seachform">
                <li><label>标题</label><input name="title" id="title" type="text" class="scinput" /></li>
                <li><label>查询别名</label><input name="search_name" id="search_name" type="text" class="scinput" /></li>
                <li><label>分类</label>
                    <div class="vocation">
                        <select class="select3" name="ac_id" id="ac_id">
                            <option value="-1">所有分类</option>
                            <?php foreach ($type as $k => $v): ?>
                                <option value="<?php echo $v->ac_id; ?>"><?php echo $v->name; ?></option>
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
                        <th>资讯标题</th>
                        <th>查询别名</th>
                        <th>所属分类</th>
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
                                <td width="350"><?php echo $value->title; ?></td>
                                <td><?php echo $value->search_name; ?></td>
                                <td><?php echo $value->typename; ?></td>
                                <td width="150"><?php echo $value->article_time; ?></td>
                                <td><?php if ($value->sts == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return dialogalert(<?php echo $value->id; ?>)">详情</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('admin_new/edit') . '/' . $value->id; ?>" class="tablelink">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink"  onclick="return del(<?php echo $value->id; ?>);"> 删除</a></td>
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