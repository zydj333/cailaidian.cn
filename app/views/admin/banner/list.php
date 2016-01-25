<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
                    //搜索
                    function searchItemsList() {
                        getPageUrl(1);
                    }

                    //分页
                    function getPageUrl(nowpage) {
                    var title = $("#title").val();
                    var type = $("#type").val();
                            $.ajax({
                            type: "POST",
                                    url: "/admin_banner/ajaxList/" + Math.random(),
                                    data: {'nowpage': nowpage, 'title': title, 'type': type},
                                            dataType: "json",
                                            success: function(data) {
                                            var str = '';
                                                    if (data.flag == 0) {
                                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                                            } else {
                                            $.each(data.error, function(key, values) {
                                            str += '<tr align="left">';
                                                    str += '<td><img width="100px" height="50px" src="/' + values.imageurl + '"  onerror="this.onerror=\'\';this.src=\'/static/admin/images/img14.png\'"  /></td>';
                                                    str += '<td width="70">' + values.id + '</td>';
                                                    str += '<td>' + values.title + '</td>';
                                                    str += '<td>' + values.url + '</td>';
                                                    str += '<td>' + values.color + '</td>';
                                                    str += '<td>' + values.type + '</td>';
                                                    str += '<td>' + values.listorder + '</td>';
                                                    str += '<td>';
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

                            function add() {
                            $.ajax({
                            url: '/admin_banner/add/' + Math.random(),
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
                            url: '/admin_banner/edit/' + id + '/' + Math.random(),
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
                            function del(id) {
                            $.ajax({
                            url: '/admin_banner/del/' + id + '/' + Math.random(),
                                    success: function(data) {
                                        location.href = "/admin_banner/index";
                                    },
                                    cache: false
                            });
                            }
        </script>
    </head>
    <body>
        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="">首页</a></li>
                <li><a href="/admin_user/index">管理员操作</a></li>
                <li><a href="/admin_banner/index">广告列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <a href='javascript:void(0);' onclick="return add();"><li class="click"><span><img src="/static/admin/images/t01.png" /></span>添加</li></a>
                </ul>
            </div>
            <ul class="seachform">
                <li><label>广告标题</label><input name="title" id="title" type="text" class="scinput" /></li>
                <li><label>广告分类</label><input name="type" id="title" type="type" class="scinput" /></li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="查询"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>图片预览</th>
                        <th>自增ID</th>
                        <th>广告标题</th>
                        <th>广告链接</th>
                        <th>颜色块</th>
                        <th>广告分类</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td width="200"><img src="<?php echo base_url() . '/' . $value->imageurl ?>" style="width: 100px;height: 50px"</td>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->url; ?></td>
                                <td><?php echo $value->color; ?></td>
                                <td><?php echo $value->type; ?></td>
                                <td><?php echo $value->listorder; ?></td>
                                <td width="200"><a href="javascript:void(0);" class="tablelink" onclick="return edit(<?php echo $value->id; ?>);">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink" onclick="return del(<?php echo $value->id; ?>);">删除</a></td>
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