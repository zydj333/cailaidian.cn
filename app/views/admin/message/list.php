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
            $(document).ready(function(){
                $(".select3").uedSelect({
                    width : 145
                });
            });
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
                var phonenumber = $("#phonenumber").val();
                var status=$("#status").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_message/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'phonenumber': phonenumber,'status':status},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.uid + '</td>';
                                str += '<td>' + values.phonenumber + '</td>';
                                str += '<td>' + values.phonecode + '</td>';
                                str += '<td>' + values.content + '</td>';
                                str += '<td>';
                                if (values.status == 0) {
                                    str += '未发送';
                                } else if (values.status == 1) {
                                    str += '已发送';
                                } else if (values.status == 2) {
                                    str += '已使用';
                                }
                                str += '</td>';
                                str += '<td>' + values.trytimes + '</td>';
                                str += '<td>' + values.passtime + '</td>';
                                str += '<td>' + values.createtime + '</td>';
                                str += '<td>';
                                str += '<a onclick="return confirm(\'你确定要重置并重新发送此信息？\')" href="/admin_message/reset/' + values.id + '" class="tablelink">重置</a>/';
                                str += '<a onclick="return confirm(\'你确定要删除此信息？\')" href="/admin_message/del/' + values.id + '" class="tablelink">删除</a>';
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
                <li><a href="/admin_message/index">短信列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <ul class="seachform">
                <li><label>手机号码</label><input name="phonenumber" id="phonenumber" type="text" class="scinput" /></li>
                <li><label>当前状态</label>
                        <div class="vocation">
                            <select class="select3" name="status" id="status">
                                <option value="-1">全部</option>
                                <option value="0">未发送</option>
                                <option value="1">已发送</option>
                                <option value="2">已使用</option>
                            </select>
                        </div>
                    </li>
                <li><label>&nbsp;&nbsp;</label><input onclick="return searchItemsList()" type="button" class="scbtn" value="查询"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>用户ID</th>
                        <th>手机号码</th>
                        <th>验证码</th>
                        <th>短信内容</th>
                        <th>当前状态</th>
                        <th>尝试次数</th>
                        <th>过期时间</th>
                        <th>提交时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->uid; ?></td>
                                <td><?php echo $value->phonenumber; ?></td>
                                <td><?php echo $value->phonecode; ?></td>
                                <td><?php echo $value->content; ?></td>
                                <td><?php if ($value->status == 0) {
                                    echo '未发送';
                                } else if ($value->status == 1) {
                                    echo '已发送';
                                } else if ($value->status == 2) {
                                    echo '已使用';
                                } ?></td>
                                <td><?php echo $value->trytimes; ?></td>
                                <td><?php echo $value->passtime; ?></td>
                                <td><?php echo $value->createtime; ?></td>
                                <td><a onclick="return confirm('你确定要重置并重新发送此信息？')" href="<?php echo site_url('admin_message/reset') . '/' . $value->id; ?>" class="tablelink">重置</a>&nbsp;&nbsp;<a onclick="return confirm('你确定要删除此信息？')" href="<?php echo site_url('admin_message/reset') . '/' . $value->id; ?>" class="tablelink">删除</a></td>
                            </tr>
    <?php endforeach; ?>
<?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $pageurl; ?> </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>