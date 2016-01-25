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
                <li><a href="/admin_member/index">前台用户管理</a></li>
                <li><a href="/admin_member_recommend/index">用户推荐列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>推荐人手机</label><input name="cardno" id="cardno" type="text" class="scinput" /></li>
                    <li><label>用户手机</label><input name="account" id="account" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="搜索"/></li>
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>用户手机</th>
                        <th>推荐人手机</th>
                        <th>推荐人姓名</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->account; ?></td>
                                    <?php 
                                        if(!empty($value->cardno)){
                                            echo '<td>'. $value->cardno .'</td>';
                                        } else {
                                            echo '<td style="color:red;">未填写</td>';
                                        }
                                    ?>
                                    <?php 
                                        if(!empty($value->truename)){
                                            echo '<td>'. $value->truename .'</td>';
                                        } else {
                                            echo '<td style="color:red;">未填写</td>';
                                        }
                                    ?>
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
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }
            //分页
            function getPageUrl(nowpage) {
                var cardno = $("#cardno").val();
                var account = $("#account").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_member_recommend/ajaxList/" + Math.random(),
                    data: {'nowpage': nowpage, 'cardno': cardno, 'account': account},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr>';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.account + '</td>';
                                str += '<td>';
                                if (values.cardno == '') {
                                    str += '<span style="color:red;">未填写</span>';
                                } else {
                                    str += values.cardno;
                                }
                                str += '</td>';
                                str += '<td>';
                                if (values.truename == null) {
                                    str += '<span style="color:red;">未填写</span>';
                                } else {
                                    str += values.truename;
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
</script>