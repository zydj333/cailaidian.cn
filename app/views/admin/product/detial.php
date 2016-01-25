<div class="rightinfo">
    <table class="tablelist" style="width: 700px">
        <tbody>
            <tr>
                <td>自增ID： <?php echo $product->id; ?></td>
                <td>产品名称： <?php echo $product->product_name; ?></td>
            </tr> 
            <tr>
                <td>发行机构： <?php echo $product->company; ?></td>
                <td>封面图片： <img src="<?php echo base_url() . $product->image; ?>" width="50" height="50" /></td>
            </tr>
            <tr>
                <td>产品分类： <?php echo $product->category_name; ?></td>
                <td>投资领域： <?php echo $product->tender_area; ?></td>
            </tr>
            <tr>
                <td>发现费用区间： <?php echo $product->fee_area; ?></td>
                <td>发行费用：  <?php echo $product->fee; ?></td>
            </tr>
            <tr>
                <td>收益率： <?php echo $product->interest_area; ?></td>
                <td>产品起售时间：<?php echo date("Y/m/d", $product->start); ?> </td>
            </tr>
            <tr>
                <td>费用区间：/</td>
                <td>付息方式： <?php echo $product->pay_way; ?></td>
            </tr>
            <tr>
                <td>所在区域： <?php echo $product->province_name . '--' . $product->city_name; ?></td>
                <td>大小配比： <?php echo $product->comparison; ?></td>
            </tr>
            <tr>
                <td>时间区间： <?php echo $product->month_area; ?></td>
                <td>产品期限： <?php echo $product->month; ?>个月</td>
            </tr>
            <tr>
                <td>规模： <?php echo $product->amount; ?>万</td>
                <td>投资门槛： <?php echo $product->support_limit; ?>万</td>
            </tr>
            <tr>
                <td>当前进度： <?php echo $product->progress; ?>%</td>
                <td>收益类型： <?php echo $product->earning; ?></td>
            </tr>
            <tr>
                <td>总金额： <?php echo $product->amount; ?>万</td>
                <td>当前金额： <?php echo $product->support_amount; ?>万</td>
            </tr>
            <tr>
                <td>是否推荐： <?php if ($product->is_recommen == 1): ?><nobr style="color: red;">是</nobr><?php else: ?>否<?php endif; ?></td>
        <td>是否显示： <?php if ($product->is_show == 1): ?><nobr style="color: red;">是</nobr><?php else: ?>否<?php endif; ?></td>
        </tr>
        <tr>
            <td>当前排序： <?php echo $product->listorder; ?></td>
            <td>发布时间： <?php echo date('Y-m-d H:i:s', $product->create_time); ?></td>
        </tr>
        <tr>
            <td>融资主体： <?php echo $product->mainpart; ?></td>
            <td>抵押率： <?php echo $product->mortgage; ?></td>
        </tr>
        <tr>
            <td>是否删除： <?php if ($product->is_delete == 1): ?><nobr style="color: red;">是</nobr><?php else: ?>否<?php endif; ?></td>
        <td>当前状态： <?php if ($product->status == 1): ?><nobr style="color: blue;">预热</nobr><?php elseif ($product->status == 2): ?><nobr style="color: blue;">募资中</nobr><?php else: ?><nobr style="color: gray;">已结束</nobr><?php endif; ?></td>
        </tr>
        <tr>
            <td colspan="2">募资账号： <?php echo $product->account; ?></td>
        </tr>
        <tr>
            <td colspan="2">资金用途： <?php echo $product->use_for; ?></td>
        </tr>
        <tr>
            <td colspan="2">还款来源： <?php echo $product->repayment_from; ?></td>
        </tr>
        <tr>
            <td colspan="2">风控措施： <?php echo $product->risk_control; ?></td>
        </tr>
        <tr>
            <td colspan="2">项目亮点： <?php echo $product->highlights; ?></td>
        </tr>
        <tr>
            <td colspan="2">资料下载地址： <?php echo $product->download_file; ?></td>
        </tr>
        <tr>
            <td colspan="2">项目描述： <?php echo $product->discription; ?></td>
        </tr>
        <tr>
            <td colspan="2">优化标题： <?php echo $product->seo_title; ?></td>
        </tr>
        <tr>
            <td colspan="2">优化关键字： <?php echo $product->seo_keyword; ?></td>
        </tr>
        <tr>
            <td colspan="2">优化描述： <?php echo $product->seo_description; ?></td>
        </tr>
        <tr>
            <td colspan="2">产品详情： <?php echo $product->content; ?></td>
        </tr>
        </tbody>
    </table>

    <table class="tablelist">
        <thead>
            <tr>
                <th>自增ID</th>
                <th>购买区间</th>
                <th>年化收益率</th>
                <th>返佣比例</th>
                <th>添加时间</th>
            </tr>
        </thead>
        <tbody id="datalist">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->buy_total; ?></td>
                        <td><?php echo $value->interest; ?>%</td>
                        <td><?php echo $value->fee; ?>%</td>
                        <td><?php echo date("Y-m-d H:i:s", $value->creattime); ?></td>
                    </tr> 
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>