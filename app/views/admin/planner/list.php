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
                <li><a href="/admin_planner/index">理财师列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>手机号码</label><input name="cellphone" id="cellphone" type="text" class="scinput" /></li>
                    <li><label>用户名称</label><input name="username" id="username" type="text" class="scinput" /></li>
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
                        <th>用户头像</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>用户账号</th>
                        <th>用户手机</th>
                        <th>用户地区</th>
                        <th>用户积分</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td height="50px"><img src="<?php echo base_url() . $value->head_ico; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" width="50px" height="40px"/></td>
                                <td><?php echo $value->user_id; ?></td>
                                <td><?php echo $value->truename; ?></td>
                                <td><?php echo $value->account; ?></td>
                                <td><?php echo $value->phone; ?></td>
                                <td><?php echo $value->province_name; ?></td>
                                <td><?php echo $value->points; ?></td>
                                <td><a href="javascript:void(0);" onclick="return showDetial(<?php echo $value->user_id; ?>);" class="tablelink">查看详情</a></td>
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
        var cellphone = $("#cellphone").val();
        var username = $("#username").val();
        var province = $("#province").val();
        $.ajax({
            type: "POST",
            url: "/admin_planner/ajaxList/" + Math.random(),
            data: {'nowpage': nowpage, 'cellphone': cellphone, 'username': username, 'province': province},
            dataType: "json",
            success: function(data) {
                var str = '';
                if (data.flag == 0) {
                    str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                } else {
                    $.each(data.error, function(key, values) {
                        str += '<tr>';
                        str += '<td height="50px"><img src="/' + values.head_ico + '" onerror="this.onerror=\'\';this.src=\'/static/home/image/lcmx_user_head_03.png\'" width="50px" height="40px"/></td>';
                        str += '<td>' + values.user_id + '</td>';
                        str += '<td>' + values.truename + '</td>';
                        str += '<td>' + values.account + '</td>';
                        str += '<td>' + values.phone + '</td>';
                        str += '<td>' + values.province_name + '</td>';
                        str += '<td>' + values.points + '</td>';
                        str += '<td>';
                        str += '<a href="javascript:void(0);" onclick="return showDetial(' + values.user_id + ')" class="tablelink">查看详情</a></td>';
                        str += '</td>';
                        str += '</tr>';
                    });
                }
                $("#datalist").html(str);
                $("#page_url").html(data.pageurl);
            }
        });
    }

    function showDetial(user_id) {
        $.ajax({
            url: '/admin_planner/showDetial/' + user_id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    width: 800,
                    //cancel:true,
                    ok:true
                });
            },
            cache: false
        });
    }
</script>