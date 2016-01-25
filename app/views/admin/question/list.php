<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
        <script type="text/javascript">
            function add(id) {
                $.ajax({
                    url: '/admin_bbs_question/add/' + id + '/' + Math.random(),
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
            
            function dialogalert(value) {
                $.ajax({
                    url: '/admin_bbs_question/detial/' + value + '/' + Math.random(),
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
            
            function getLocalTime(nS) {     
                return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
            }
            
            //搜索
            function searchItemsList() {
                getPageUrl(1);
            }

            //分页
            function getPageUrl(nowpage) {
                var title = $("#title").val();
                var questions = $("#questions").val();
                var user_name = $("#user_name").val();
                $.ajax({
                    type: "POST",
                    url: "/admin_bbs_question/ajaxList/" + Math.random(),
                    data: { 'nowpage': nowpage,'title': title,'questions': questions,'user_name': user_name},
                    dataType: "json",
                    success: function(data) {
                        var str = '';
                        if (data.flag == 0) {
                            str = '<tr align="left"><td colspan="15">' + data.error + '</td></tr>';
                        } else {
                            $.each(data.error, function(key, values) {
                                str += '<tr align="left">';
                                str += '<td>' + values.id + '</td>';
                                str += '<td>' + values.cate_onename + '</td>';
                                str += '<td>' + values.cate_twoname + '</td>';
                                str += '<td>' + values.title + '</td>';
                                str += '<td>' + values.questions + '</td>';
                                str += '<td>' + values.user_name + '</td>';
                                str += '<td>' + values.views + '</td>';
                                str += '<td>' + values.repaynums + '</td>';
                                str += '<td>' + getLocalTime(values.updatetime) + '</td>';
                                str += '<td>';
                                if (values.is_del == 0) {
                                    str += '否';
                                } else {
                                    str += '已删除';
                                }
                                str += '</td>';
                                str += '<td>' + getLocalTime(values.create_time) + '</td>';
                                str += '<td>';
                                str += '<a onclick="return add(' + values.id + ')" href="javascript:void(0);" class="tablelink">后台回复</a>    <a onclick="return dialogalert(' + values.id + ')" href="javascript:void(0);" class="tablelink">查看回复</a>';
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
                <li><a href="/admin_bbs_question/index">社区问答列表</a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <ul class="seachform">
                <li><label>问题标题</label><input name="title" id="title" type="text" class="scinput" /></li>
                <li><label>问题内容</label><input name="questions" id="questions" type="text" class="scinput" /></li>
                <li><label>提问用户</label><input name="user_name" id="user_name" type="text" class="scinput" /></li>
                <li><label>&nbsp;&nbsp;</label><input name="" onclick="return searchItemsList()" type="button" class="scbtn" value="搜索"/></li>
            </ul>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th>自增ID</th>
                        <th>一级分类</th>
                        <th>二级分类</th>
                        <th>问题标题</th>
                        <th>问题内容</th>
                        <th>提问用户</th>
                        <th>查看次数</th>
                        <th>回复次数</th>
                        <th>最近更新</th>
                        <th>是否删除</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->id; ?></td>
                                <td><?php echo $value->cate_onename; ?></td>
                                <td><?php echo $value->cate_twoname; ?></td>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->questions; ?></td>
                                <td><?php echo $value->user_name; ?></td>
                                <td><?php echo $value->views; ?></td>
                                <td><?php echo $value->repaynums; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$value->updatetime); ?></td>
                                <td><?php if ($value->is_del == 0): ?>否<?php else: ?><span style="color:red;">已删除</span><?php endif; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$value->create_time); ?></td>
                                <td><a href="javascript:void(0);" class="tablelink" onclick="return add(<?php echo $value->id; ?>)">后台回复</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="tablelink" onclick="return dialogalert(<?php echo $value->id; ?>)">查看回复</a></td>
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