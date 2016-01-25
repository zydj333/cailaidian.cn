<!--主栏-->
<div class="znxx_mn f-fr bg_ff">
    <div class="znxx_mn_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">消息列表</p>
        <div class="cb"></div>
    </div>
    <div class="znxx_mn_cont">
        <div class="znxx_mn_cont_tb">
            <table width="100%" id="message_table">
                <tbody>
                    <tr class="znxx_mn_cont_tb_tt">
                        <td align="right" width="9%">
                            <div>
                                <input class="input-hide" type="checkbox">
                                <label class="checkbox mainbox" id="mainChecked"></label>
                            </div>
                        </td>
                        <td align="center" width="20%">内容</td>
                        <td align="center" width="20%">发件人</td>
                        <td align="center" width="20%">发送时间</td>
                        <td align="center" width="20%">状态</td>
                        <td align="center" width="20%"></td>                
                    </tr>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr class="znxx_mn_cont_tb_item">
                                <td align="right">
                                    <div>
                                        <input class="input-hide" type="checkbox">
                                        <label class="checkbox"></label>
                                    </div>
                                </td>
                                <td align="center"><?php echo $value->message; ?></td>
                                <td align="center"><strong style="color:#3ccafb;"><?php echo $value->from_username; ?></strong></td>
                                <td align="center"><?php echo date('Y-m-d H:i:s', $value->sendtime); ?></td>
                                <td align="center">
                                    <?php 
                                    if($value->status == 0){
                                        echo '未读';
                                    } elseif ($value->status == 1){
                                        echo '已读';
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <a href="#" class="znxx_mn_btn1" onclick="return dialogalert(<?php echo $value->id; ?>)">阅读</a>
                                    <a href="#" class="znxx_mn_btn2" onclick="return del(<?php echo $value->id; ?>)">删除</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="cb"></div>              
        </div>
        <div class="znxx_mn_cont_pager">
            <ul class="f-fr">
                <?php echo $pagenation; ?>
            </ul>
            <ul class="f-fr" style="margin-right: 50px">
                <li><a href="#" id="selectAll" class="znxx_mn_pager_btn">全选</a></li>
                <li><a href="#" id="unSelect" class="znxx_mn_pager_btn">全不选</a></li>
                <li><a href="#" id="reverse" class="znxx_mn_pager_btn">反选</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<script type="text/javascript">
    $(function () {
        // checkbox定义
        $('.checkbox').on('click', function () {
            if ($(this).siblings("input[type='checkbox']").is(':checked')) {
                $(this).removeClass('checked');
                $(this).siblings("input[type='checkbox']").removeAttr('checked')
            }
            else {
                $(this).addClass('checked');
                $(this).siblings("input[type='checkbox']").attr('checked', 'checked')
            }
        });

        $("#selectAll").click(function () {//全选
            $('.checkbox').addClass('checked');
        });

        $("#unSelect").click(function () {//全不选
            $('.checkbox').removeClass('checked');
        });
        
        $("#reverse").click(function() {//反选
            $(".checkbox").each(function() {
                $(this).toggleClass("checked");
            });
        });
    })
    
    function dialogalert(value) {
                $.ajax({
                    url: '/center_account/read/' + value + '/' + Math.random(),
                    success: function(data) {
                        art.dialog({
                            lock: true,
                            background: '#000000', // 背景色
                            opacity: 0.50, // 透明度
                            content: data,
                            cancel: true,
                        });
                    },
                    cache: false
                });
            }
    function del(id) {
                $.ajax({
                    url: '/center_account/del/' + id + '/' + Math.random(),
                    success: function(data) {
                        location.href = "/center_account/message";
                    },
                    cache: false
                });
            }
</script>
</body>
</html>