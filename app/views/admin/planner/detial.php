<div class="rightinfo" id="floatbody">
    <table class="tablelist" style="width: 700px">
        <tbody>
            <tr>
                <th  colspan="2">用户信息</th>
            </tr> 
            <tr>
                <td>用户头像：<img src="<?php echo base_url() . $detial->head_ico; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" width="80px"/> </td>
                <td>微信二维码：<img src="<?php echo base_url() . $detial->wechat_url; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/zhuce_ft_code2.jpg'" width="80px"/></td>
            </tr> 
            <tr>
                <td>用户ID： <?php echo $member->id; ?></td>
                <td>用户账号： <?php echo $member->account; ?></td>
            </tr> 
            <tr>
                <td>手机号码： <?php echo $member->phone; ?></td>
                <td>邮箱地址： <?php echo $member->email; ?></td>
            </tr>
            <tr>
                <td>推荐人手机： <?php echo $member->cardno; ?></td>
                <td>邮箱认证： <?php if ($member->email_status == 1): ?>已认证<?php else: ?>未认证<?php endif; ?></td>
            </tr>
            <tr>
                <td>真实姓名： <?php echo $detial->truename; ?></td>
                <td>身份证号码： <?php echo $detial->idcard; ?></td>
            </tr>
            <tr>
                <td>性别： <?php if ($detial->sex == 0): ?>男<?php else: ?>女<?php endif; ?></td>
                <td>生日： <?php echo $detial->birthday; ?></td>
            </tr>
            <tr>
                <td>qq号码： <?php echo $detial->qq; ?></td>
                <td>微博名称： <?php echo $detial->web; ?></td>
            </tr>
            <tr>
                <td>金币总数： <nobr style="color:red;"><?php echo $detial->goldnum; ?></nobr></td>
        <td>可用金币数：<nobr style="color:red;"> <?php echo $detial->goldnow; ?></nobr></td>
        </tr>
        <tr>
            <td>已消费金币： <nobr style="color:red;"><?php echo $detial->golduse; ?></nobr></td>
        <td>会员积分： <nobr style="color:red;"><?php echo $detial->points; ?></nobr></td>
        </tr>
        <tr>
            <td>可用积分： <nobr style="color:red;"><?php echo $detial->pointsnow; ?></nobr></td>
        <td>已消费积分： <nobr style="color:red;"><?php echo $detial->pointsuse; ?></nobr></td>
        </tr>
        <tr>
            <td>总成交额(万)： <nobr style="color:red;"><?php echo $detial->turnover; ?></nobr></td>
        <td>佣金收益(￥)： <nobr style="color:red;"><?php echo $detial->commission; ?></nobr></td>
        </tr>
        <tr>
            <td>可用余额(￥)： <nobr style="color:red;"><?php echo $detial->available_predeposit; ?></nobr></td>
        <td>冻结金额(￥)： <nobr style="color:red;"><?php echo $detial->freeze_predeposit; ?></nobr></td>
        </tr>
        <tr>
            <td colspan="2">个性签名：<?php echo $detial->sign; ?></td>
        </tr>

        </tbody>
    </table>
    <?php if (!empty($list)): ?>
        <table class="tablelist" style="width: 700px">
            <tbody>
                <tr>
                    <th>产品名称</th>
                    <th>分类</th>
                    <th>发行机构</th>
                    <th>资金规模</th>
                    <th>投资门槛</th>
                    <th>期限</th>
                    <th>年化收益</th>
                    <th>佣金比例</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->product_name; ?></td>
                        <td><?php echo $value->category_name; ?></td>
                        <td><?php echo $value->company; ?></td>
                        <td><?php echo $value->amount; ?>万</td>
                        <td><?php echo $value->support_limit; ?>万</td>
                        <td><?php echo $value->month; ?>个月</td>
                        <td><?php echo $value->interest; ?></td>
                        <td><?php echo $value->fee; ?></td>
                        <td><a href="javascript:void(0);" onclick="return showProduct();" class="tablelink">查看详细</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
