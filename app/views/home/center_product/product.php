<!--主栏-->
<div class="sp_mn f-fr bg_ff">
    <div class="sp_mn_tt bg_ff">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">上传的产品</p>
        <a href="<?php echo base_url('launch/index'); ?>" class="f-fr sp_mn_tt_btn">上传新产品</a>
        <div class="cb"></div>
    </div>
    <div class="sp_mn_cont bg_ff cb">
        <div class="sp_mn_cont_tt">
            <table>
                <tr>
                    <td class="sp_mn_cont_tt_td">产品名称</td>
                    <td class="sp_mn_cont_tt_td">发行机构</td>
                    <td class="sp_mn_cont_tt_td">产品期限</td>
                    <td class="sp_mn_cont_tt_td">收益类型</td>
                </tr>
            </table>
        </div>
        <?php if (!empty($list)): ?>
            <?php foreach ($list as $key => $value): ?>
                <div class="sp_mn_item">
                    <table class="f-fl">
                        <tr>
                            <td class="sp_mn_item_td"><?php echo $value->product_name; ?></td>
                            <td class="sp_mn_item_td"><?php echo $value->company; ?></td>
                            <td class="sp_mn_item_td"><?php echo $value->month; ?>个月</td>
                            <td class="sp_mn_item_td"><?php echo $value->earning; ?></td>
                        </tr>
                    </table>  
                    <a href="<?php echo base_url('star/detial') . '/' . $value->id; ?>" target="_blank" style="background:url(<?php echo base_url() ?>static/home/image/sp_item_btn_03.png) 50% no-repeat;" class="sp_mn_item_btn f-fl">查看</a>
                    <a href="javascript:void(0);" onclick="return delMyProduct(<?php echo $value->id; ?>)" style="background:url(<?php echo base_url() ?>static/home/image/sp_item_btn_05.png) 50% no-repeat;" class="sp_mn_item_btn f-fl">删除</a>
                    <div class="cb"></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="cb"></div>
    </div>
    <!--<div class="sp_mn_cont_pager">
        <ul class="f-fr">
            <li><a href="#">首页</a></li>
            <li><a href="#">上一页</a></li>
            <li><a href="#">下一页</a></li>
            <li><a href="#">末页</a></li>
        </ul>
        <ul class="f-fr">
            <li>共0条信息</li>
            <li>共20页</li>
            <li><input type="text" class="pager_num"/></li>
            <li><span class="pager_go">确定</span></li>
        </ul>
    </div>-->
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<script type="text/javascript">
    function delMyProduct(pid) {
        $.ajax({
            type: "POST",
            url: "/center_product/delMyProduct/" + Math.random(),
            data: {'pid': pid},
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    art.dialog({
                        title: '信息提示',
                        lock: true,
                        background: '#600', // 背景色
                        opacity: 0.90, // 透明度
                        content: data.error,
                        time: 2,
                        width: 500
                    });
                    location.href = "/center_product/index";
                } else {
                    art.dialog({
                        title: '信息提示',
                        lock: true,
                        background: '#600', // 背景色
                        opacity: 0.90, // 透明度
                        content: data.error,
                        time: 2,
                        width: 500
                    });
                    return;
                }
            },
            error: function(data, status, e)
            {
                art.dialog({
                    title: '信息提示',
                    lock: true,
                    background: '#600', // 背景色
                    opacity: 0.90, // 透明度
                    content: status,
                    time: 2,
                    width: 500
                });
            }
        });
    }
</script>