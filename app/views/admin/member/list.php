<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
            function dialogalert(value) {
                $.ajax({
                    url: '/admin_member/detial/' + value + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#DDD', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            icon: 'succeed',
                            cancel: true,
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
                var account = $("#account").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_member/ajaxList/" + Math.random(),
                    data: { 'nowpage': nowpage,'account': account},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td><img width="32px" height="32px" src="/' + values.head_ico + '"  onerror="this.onerror=\'\';this.src=\'/static/admin/images/img14.png\'"  /></td>';
                                str += '<td width="70">' + values.id + '</td>';
                                str += '<td width="350">' + values.account + '</td>';
                                str += '<td>' + values.truename + '</td>';
                                str += '<td>' + values.cardno + '</td>';
                                str += '<td width="150">' + values.email + '</td>';
                                str += '<td width="150">' + values.phone + '</td>';
                                str += '<td>';
                                if (values.is_del == 0) {
                                    str += '否';
                                } else {
                                    str += '是';
                                }
                                str += '</td>';
                                str += '<td>';
                                str += '<a onclick="return dialogalert(' + values.id + ')" href="javascript:void(0);" class="tablelink">详情</a>';
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
                <li><a href="/admin_member/index">前台用户列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <ul class="seachform">
                <li><label>查询用户名</label><input name="account" id="account" type="text" class="scinput" /></li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="查询"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>用户头像</th>
                        <th>自增ID</th>
                        <th>登录帐号</th>
                        <th>用户姓名</th>
                        <th>推荐人手机</th>
                        <th>邮箱地址</th>
                        <th>联系电话</th>
                        <th>是否删除</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><img width="32px" height="32px" src="<?php 
                                if(empty($value->head_ico)){
                                     echo base_url('/static/admin/images/img14.png');
                                }else {
                                    echo base_url($value->head_ico);
                                } ?>" /></td>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->account; ?></td>
                                <td><?php echo $value->truename; ?></td>
                                <td><?php echo $value->cardno; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->phone; ?></td>
                                <td><?php if ($value->is_del == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return dialogalert(<?php echo $value->id; ?>)">详情</a></td>
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