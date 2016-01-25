<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
            function del(id) {
                $.ajax({
                    url: '/admin_bbs_questionrepay/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        location.href = "/admin_bbs_questionrepay/index";
                    },
                    cache: false
                });
            }
            
            function getLocalTime(nS) {     
                return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
            }
            
            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var qtitle = $("#qtitle").val();
                var content = $("#content").val();
                var username = $("#username").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_bbs_questionrepay/ajaxList/" + Math.random(),
                    data: { 'nowpage': nowpage,'qtitle': qtitle,'content': content,'username': username},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.content + '</td>';
                                str += '<td>' + values.qtitle + '</td>';
                                str += '<td>' + values.username + '</td>';
                                str += '<td>';
                                if (values.is_del == 0) {
                                    str += '否';
                                } else {
                                    str += '已删除';
                                }
                                str += '</td>';
                                str += '<td>' + getLocalTime(values.create_time) + '</td>';
                                str += '<td>';
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
                <li><a href="/admin_member/index">管理员操作</a></li>
                <li><a href="/admin_bbs_questionrepay/index">社区回答列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <ul class="seachform">
                <li><label>问题标题</label><input name="qtitle" id="qtitle" type="text" class="scinput" /></li>
                <li><label>回答内容</label><input name="content" id="content" type="text" class="scinput" /></li>
                <li><label>回答用户</label><input name="username" id="username" type="text" class="scinput" /></li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="搜索"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>回答内容</th>
                        <th>所属问题</th>
                        <th>回答用户</th>
                        <th>是否删除</th>
                        <th>回答时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->content; ?></td>
                                <td><?php echo $value->qtitle; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td><?php if ($value->is_del == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$value->create_time); ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return del(<?php echo $value->id; ?>)">删除</a></td>
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