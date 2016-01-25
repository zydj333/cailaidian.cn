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
                <li><a href="/admin_product_contract/index">产品合同申请管理</a></li>
                <li><a href="/admin_product_contract/index">产品合同申请列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="seachform">
                    <li><label>手机号码</label><input name="celphone" id="celphone" type="text" class="scinput" /></li>
                    <li><label>用户名称</label><input name="username" id="username" type="text" class="scinput" /></li>
                    <li><label>当前状态</label>
                        <div class="vocation">
                            <select class="select1" name="status" id="status">
                                <option value="0">全部</option>
                                <option value="1">待审核</option>
                                <option value="2">已发货</option>
                                <option value="3">已签收</option>
                                <option value="4">已撤销</option>
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
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>联系电话</th>
                        <th>收货地址</th>
                        <th>当前状态</th>
                        <th>添加时间</th>
                        <th>邮寄时间</th>
                        <th>签收时间</th>
                        <th>撤销时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->pid; ?></td>
                                <td><?php echo $value->product_name; ?></td>
                                <td><?php echo $value->user_id; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td><?php echo $value->celphone; ?></td>
                                <td><?php echo $value->address; ?></td>
                                <td><?php if($value->status==1): ?><p style="color: blue;">待邮寄</p><?php elseif($value->status==2):?><p style="color: #CC5522;">待签收</p><?php elseif($value->status==3):?><p style="color: red;">已签收</p><?php elseif($value->status==4):?><p style="color: gray;">已撤销</p><?php endif;?></td>
                                <td><?php echo date('Y-m-d H:i:s', $value->addtime); ?></td>
                                <td><?php if($value->posttime>0):?><?php echo date('Y-m-d H:i:s', $value->posttime); ?><?php endif;?></td>
                                <td><?php if($value->resavetime>0):?><?php echo date('Y-m-d H:i:s', $value->resavetime); ?><?php endif;?></td>
                                <td><?php if($value->canceltime>0 && $value->status==4):?><?php echo date('Y-m-d H:i:s', $value->canceltime); ?><?php endif;?></td>
                                <td><?php if($value->status==1):?><a href="javascript:void(0);" onclick="return send(<?php echo $value->id; ?>)" class="tablelink">邮寄</a> | <a href="javascript:void(0);" onclick="return del(<?php echo $value->id; ?>)" class="tablelink">撤销</a><?php else:?>没有可用操作<?php endif;?></td>
                            </tr> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="pagin" id="page_url"><?php echo $page_url; ?> </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
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
        var celphone = $("#celphone").val();
        var username = $("#username").val();
        var status = $("#status").val();
        $.ajax({
            type: "POST",
            url: "/admin_product_contract/ajaxList/" + Math.random(),
            data: {'nowpage': nowpage, 'celphone': celphone, 'username': username, 'status': status},
            dataType: "json",
            success: function(data) {
                var str = '';
                if (data.flag == 0) {
                    str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                } else {
                    $.each(data.error, function(key, values) {
                        str += '<tr>';
                        str += '<td>' + values.id + '</td>';
                        str += '<td>' + values.pid + '</td>';
                        str += '<td>' + values.product_name + '</td>';
                        str += '<td>' + values.user_id + '</td>';
                        str += '<td>' + values.username + '</td>';
                        str += '<td>' + values.celphone + '</td>';
                        str += '<td>' + values.address + '</td>';
                        str += '<td>';
                        if(values.status==1){
                            str+='<p style="color: blue;">待邮寄</p>'; 
                        }else if(values.status==2){
                            str+='<p style="color: #CC5522;">待签收</p>'; 
                        }else if(values.status==3){
                            str+='<p style="color: red;">已签收</p>'; 
                        }else if(values.status==4){
                            str+='<p style="color: gray;">已撤销</p>'; 
                        }
                        str+='</td>';
                        str += '<td>' + values.addtime + '</td>';
                        str += '<td>' + values.posttime + '</td>';
                        str += '<td>' + values.resavetime + '</td>';
                        str += '<td>' + values.canceltime + '</td>';
                        str += '<td>';
                         if(values.status==1){
                        str += '<a href="javascript:void(0);" onclick="return send('+values.id+')" class="tablelink">邮寄</a>';
                        str += ' | <a href="javascript:void(0);" onclick="return del('+values.id+')" class="tablelink">撤销</a>';
                        }else{
                            str+='没有可用操作';
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

    function send(order_id) {
        $.ajax({
            url: '/admin_product_contract/send/' + order_id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    //icon: 'succeed',
                    //cancel: true,
                    ok: function() {
                        location.href = "/admin_product_contract/index";
                    }
                });
            },
            cache: false
        });
    }
    
    function del(order_id) {
        $.ajax({
            url: '/admin_product_contract/del/' + order_id + '/' + Math.random(),
            success: function(data) {
                art.dialog({
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: data,
                    //icon: 'succeed',
                    //cancel: true,
                    ok: function() {
                        location.href = "/admin_product_contract/index";
                    }
                });
            },
            cache: false
        });
    }
</script>