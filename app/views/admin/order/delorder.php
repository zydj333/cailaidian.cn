<div class="rightinfo" id="floatbody">
    <table class="tablelist" style="width: 700px">
        <tbody>
            <tr>
                <th  colspan="2">产品信息</th>
            </tr> 
            <tr>
                <td>产品名称： <?php echo $product->product_name; ?></td>
                <td>发行机构： <?php echo $product->company; ?></td>
            </tr> 
            <tr>
                <td>产品期限： <?php echo $product->month; ?>个月</td>
                <td>规模： <?php echo $product->amount; ?>万</td>
            </tr>
            <tr>
                <td colspan="2">募资账号： <?php echo $product->account; ?></td>
            </tr>
            <tr>
                <th colspan="2">订单信息</th>
            </tr>
            <tr>
                <td>订单ID： <?php echo $order->id; ?></td>
                <td>订单编号： <?php echo $order->order_sn; ?></td>
            </tr> 
            <tr>
                <td>客户名称： <?php echo $order->name; ?></td>
                <td>打款金额： <?php echo $order->money; ?></td>
            </tr>
            <tr>
                <td>打款日期： <?php echo $order->date; ?></td>
                <td>成交金额： <?php echo $order->real_money; ?></td>
            </tr>
            <tr>
                <td>成立时间： <?php echo $order->real_date; ?></td>
                <td>报单时间： <?php echo date('Y-m-d H:i:s', $order->post_time); ?></td>
            </tr>
            <tr>
                <td>报单人ID： <?php echo $order->user_id; ?></td>
                <td>报单人： <?php echo $order->poster; ?></td>
            </tr>
            <tr>
                <td>审核状态： <?php if ($order->order_status == 0): ?><nobr style="color: blue;">待审核</nobr><?php elseif ($order->order_status == 1): ?><nobr style="color: red;">审核通过</nobr><?php else: ?><nobr style="color: gray;">审核驳回</nobr><?php endif; ?></td>
        <td>审核结果： <?php echo $order->status_remark; ?></td>
        </tr>
        <tr>
            <td colspan="2">报单人备注： <?php echo $order->remark; ?></td>
        </tr>
        <tr>
            <td colspan="2">打款凭条： <?php if ($order->money_slip != ''): ?><img src="<?php echo base_url() . $order->money_slip; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">银行卡正面：<?php if ($order->bankcard_up != ''): ?><img src="<?php echo base_url() . $order->bankcard_up; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">银行卡反面：<?php if ($order->bankcard_back != ''): ?><img src="<?php echo base_url() . $order->bankcard_back; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">身份证正面：<?php if ($order->idcard_up != ''): ?><img src="<?php echo base_url() . $order->idcard_up; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">身份证反面：<?php if ($order->idcard_back != ''): ?><img src="<?php echo base_url() . $order->idcard_back; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">签字页1：<?php if ($order->signature1 != ''): ?><img src="<?php echo base_url() . $order->signature1; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">签字页2：<?php if ($order->signature2 != ''): ?><img src="<?php echo base_url() . $order->signature2; ?>" width="500px"/><?php else: ?>未上传<?php endif; ?></td>
        </tr>
        </tbody>
    </table>
    <?php if ($order->order_status == 0): ?>
        <div class="formbody">
            <div class="formtitle"><span>订单处理</span></div>
            <form action="/admin_order/dodeal" method="post" id='order_deal_form'>
                <ul class="forminfo">
                    <input type="hidden" name="order_id" id="order_id" value="<?php echo $order->id; ?>">
                    <li><label>是否通过</label>
                        <div class="vocation">
                            <select class="select1" name="status" id="status">
                                <option value="0">选择状态</option>
                                <option value="1">确认通过</option>
                                <option value="2">驳回报单</option>
                            </select>
                        </div>
                    </li>
                    <li><label>发放佣金</label><input name="money" type="text" class="dfinput" maxlength="30" value="" style="width: 200px"/><i>填写发放的金额（单位为元,如:4850.85）</i></li>
                    <li><label>审核理由</label><textarea class="textinput" name="status_remark" id="status_remark" cols="150" rows="3"></textarea></li>
                    <li></li>              
                    <li><label>&nbsp;</label><input id='order_deal_button' type="button" class="btn" value="确认处理"/></li>
                </ul>
            </form>
        </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $(".select1").uedSelect({
            width: 150
        });

        $('#order_deal_button').click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_order/dodeal/" + Math.random(),
                data: $("#order_deal_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        art.dialog({
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data.error,
                            time: 2
                        });
                    } else {
                        $('#floatbody').html('已经成功处理，请点击确定关闭浮动窗！')
                    }
                }
            });
        });
    });
</script>