<div class="rightinfo" id="floatbody">
    <table class="tablelist" style="width: 700px">
        <tbody>
            <tr>
                <th  colspan="2">产品信息</th>
            </tr> 
            <tr>
                <td>产品名称： <?php echo $product->product_name; ?></td>
                <td>产品ID： <?php echo $product->id; ?></td>
            </tr> 
            <tr>
                <td>用户名称： <?php echo $product->username; ?></td>
                <td>用户ID： <?php echo $product->user_id; ?></td>
            </tr>
            <tr>
                <td>分类名称： <?php echo $product->category_name; ?></td>
                <td>分类ID： <?php echo $product->category; ?></td>
            </tr>
            <tr>
                <td>所在省份： <?php echo $product->province_name; ?></td>
                <td>所在城市： <?php echo $product->city_name; ?></td>
            </tr>
            <tr>
                <td>发行机构： <?php echo $product->company; ?></td>
                <td>产品期限： <?php echo $product->month; ?>个月</td>
            </tr>
            <tr>
                <td>资金规模： <?php echo $product->amount; ?>万</td>
                <td>投资门槛： <?php echo $product->support_limit; ?>万</td>
            </tr>
            <tr>
                <td>年化收益： <?php echo $product->interest; ?></td>
                <td>发行费用： <?php echo $product->fee; ?></td>
            </tr>
            <tr>
                <td>投资领域： <?php echo $product->tender_area; ?></td>
                <td>付息方式： <?php echo $product->pay_way; ?></td>
            </tr>
            <tr>
                <td>收益类型： <?php echo $product->earning; ?></td>
                <td>收益明细： <?php echo $product->interest_detial; ?></td>
            </tr>
        <tr>
            <td colspan="2"><nobr style='font-size: 16px;font-weight: bold;'>募资账号</nobr>： <?php echo $product->account; ?></td>
        </tr>
        <tr>
            <td  colspan="2"><nobr style='font-size: 16px;font-weight: bold;'>资金用途</nobr>： <?php echo $product->use_for; ?></td>
        </tr>
        <tr>
            <td  colspan="2"><nobr style='font-size: 16px;font-weight: bold;'>还款来源</nobr>： <?php echo $product->repayment_from; ?></td>
        </tr>
        <tr>
            <td  colspan="2"><nobr style='font-size: 16px;font-weight: bold;'>风控措施</nobr>： <?php echo $product->risk_control; ?></td>
        </tr>
        <tr>
            <td  colspan="2"><nobr style='font-size: 16px;font-weight: bold;'>项目亮点</nobr>： <?php echo $product->highlights; ?></td>
        </tr>
        <tr>
            <td>当前状态： <?php if ($product->status == 0): ?>待审核<?php elseif ($product->status == 1): ?>已通过<?php else: ?>已驳回<?php endif; ?></td>
            <td>是否删除： <?php if ($product->is_del == 0): ?>否<?php else: ?>是<?php endif; ?></td>
        </tr>
        <tr>
            <td>在官方数据库中的ID： <?php echo $product->id_to_system; ?></td>
            <td>创建时间： <?php echo date('Y-m-d H:i:s', $product->createtime); ?></td>
        </tr>
        </tbody>
    </table>
</div>
