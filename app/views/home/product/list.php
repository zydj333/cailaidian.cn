<!--下面是主要内容-->
<script type="text/javascript" src="<?php echo base_url('static/home/'); ?>/js/list.min.js"></script>
<!--筛选开始--> 
<div class="sx">
    <!--搜索框-->
    <div class="sch">
        <div class="sch-tt f-fl">信托产品</div>
        <div class="f-fr">
            <p class="sch_p f-fl">产品关键字 :</p>
            <div class="f-fr">
                <form method="post" action="<?php echo base_url('product/search'); ?>">
                    <input type="text"  name="keywords"  class="sch_p_ipt_t"/>
                    <input type="submit" value=" " class="sch_p_ipt_btn"/>
                </form>
            </div>
        </div>
        <div class="cb"></div>
    </div>
    <!--条件选项-->
    <div class="sx-list">
        <div class="sx-list-mn">
            <p class="inb f-fl">产品状态:</p>
            <?php
            $paramter = $params;
            unset($paramter['status']);
            ?>
            <a class="fna f-fl <?php if ($params['status'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?status=0&') . http_build_query($paramter); ?>">全部</a>
            <a class="fna f-fl <?php if ($params['status'] == 2): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?status=2&') . http_build_query($paramter); ?>">在售</a>
            <a class="fna f-fl <?php if ($params['status'] == 1): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?status=1&') . http_build_query($paramter); ?>">预热</a>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">产品系列:</p>
            <?php
            $paramter = $params;
            unset($paramter['cate']);
            ?>
            <a class="fna f-fl <?php if ($params['cate'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?cate=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($category)): ?>
                <?php foreach ($category as $cate_key => $cate_value): ?>
                    <a class="fna f-fl <?php if ($params['cate'] == $cate_value->id): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?cate=' . $cate_value->id . '&') . http_build_query($paramter); ?>"><?php echo $cate_value->title; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">产品期限:</p>
            <?php
            $paramter = $params;
            unset($paramter['date_area']);
            ?>
            <a class="fna f-fl <?php if ($params['date_area'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?date_area=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($deadline)): ?>
                <?php foreach ($deadline as $deadline_key => $deadline_value): ?>
                    <a class="fna f-fl <?php if ($params['date_area'] == $deadline_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?date_area=' . $deadline_key . '&') . http_build_query($paramter); ?>"><?php echo $deadline_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">佣金:</p>
            <?php
            $paramter = $params;
            unset($paramter['fee']);
            ?>
            <a class="fna f-fl <?php if ($params['fee'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?fee=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($issucost)): ?>
                <?php foreach ($issucost as $issucost_key => $issucost_value): ?>
                    <a class="fna f-fl <?php if ($params['fee'] == $issucost_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?fee=' . $issucost_key . '&') . http_build_query($paramter); ?>"><?php echo $issucost_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">收益率:</p>
            <?php
            $paramter = $params;
            unset($paramter['interest']);
            ?>
            <a class="fna f-fl <?php if ($params['interest'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?interest=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($interest)): ?>
                <?php foreach ($interest as $interest_key => $interest_value): ?>
                    <a class="fna f-fl <?php if ($params['interest'] == $interest_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?interest=' . $interest_key . '&') . http_build_query($paramter); ?>"><?php echo $interest_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="f-fl">所在区域:</p>
            <?php
            $paramter = $params;
            unset($paramter['province']);
            ?>
            <a class="fna f-fl  <?php if ($params['province'] == 0): ?>on<?php endif; ?> f-fl" href="<?php echo base_url('product/index?province=0&') . http_build_query($paramter); ?>">全部</a>
            <div class="f-fl" style="width:600px;height:38px;overflow:hidden;">  
                <?php if (!empty($province)): ?>
                    <?php foreach ($province as $province_key => $province_value): ?>
                        <a class="fnas f-fl <?php if ($params['province'] == $province_value->id): ?>on<?php endif; ?> f-fl" href="<?php echo base_url('product/index?province=' . $province_value->id . '&') . http_build_query($paramter); ?>"><?php echo $province_value->name; ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <span id="areaoperation" class="f-fr"  data-type="shou">更多</span>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">投资领域:</p>
            <?php
            $paramter = $params;
            unset($paramter['tender_area']);
            ?>
            <a class="fna f-fl <?php if ($params['tender_area'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?tender_area=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($area)): ?>
                <?php foreach ($area as $area_key => $area_value): ?>
                    <a class="fna f-fl <?php if ($params['tender_area'] == $area_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?tender_area=' . $area_key . '&') . http_build_query($paramter); ?>"><?php echo $area_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">付息方式:</p>
            <?php
            $paramter = $params;
            unset($paramter['pay_way']);
            ?>
            <a class="fna f-fl <?php if ($params['pay_way'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?pay_way=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($payway)): ?>
                <?php foreach ($payway as $payway_key => $payway_value): ?>
                    <a class="fna f-fl <?php if ($params['pay_way'] == $payway_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?pay_way=' . $payway_key . '&') . http_build_query($paramter); ?>"><?php echo $payway_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn">
            <p class="inb f-fl">大小配比:</p>
            <?php
            $paramter = $params;
            unset($paramter['comparison']);
            ?>
            <a class="fna f-fl <?php if ($params['comparison'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?comparison=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($comparison)): ?>
                <?php foreach ($comparison as $comparison_key => $comparison_value): ?>
                    <a class="fna f-fl <?php if ($params['comparison'] == $comparison_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?comparison=' . $comparison_key . '&') . http_build_query($paramter); ?>"><?php echo $comparison_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
        <div class="sx-list-mn" style="border:none">
            <p class="inb f-fl">评级:</p>
            <?php
            $paramter = $params;
            unset($paramter['level']);
            ?>
            <a class="fna f-fl <?php if ($params['level'] == 0): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?level=0&') . http_build_query($paramter); ?>">全部</a>
            <?php if (!empty($level)): ?>
                <?php foreach ($level as $level_key => $level_value): ?>
                    <a class="fna f-fl <?php if ($params['level'] == $level_key): ?>on<?php endif; ?>" href="<?php echo base_url('product/index?level=' . $level_key . '&') . http_build_query($paramter); ?>"><?php echo $level_value; ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </div>
    </div>
</div>
<!--tab-->
<?php
$paramter = $params;
unset($paramter['order']);
?>
<div class="g-mn">
    <div id="cptab_xt">
        <h2 class="cp-tt">
            <b>
                <ul>
                    <li <?php if ($params['order'] == 'all'): ?>class="lixz"<?php endif; ?>><a href="<?php echo base_url('product/index?order=all&') . http_build_query($paramter); ?>" style="color:#333;" title="默认排序">综合</a></li>
                    <li <?php if ($params['order'] == 'interest'): ?>class="lixz"<?php endif; ?>><a href="<?php echo base_url('product/index?order=interest&') . http_build_query($paramter); ?>"  style="color:#333;"  title="根据收益率排序">收益</a></li>
                    <li <?php if ($params['order'] == 'fee'): ?>class="lixz"<?php endif; ?>><a href="<?php echo base_url('product/index?order=fee&') . http_build_query($paramter); ?>"  style="color:#333;"  title="根据佣金费率排序">佣金</a></li>
                    <li <?php if ($params['order'] == 'dateline'): ?>class="lixz"<?php endif; ?>><a href="<?php echo base_url('product/index?order=dateline&') . http_build_query($paramter); ?>"  style="color:#333;"  title="根据项目期限排序">期限</a></li>
                    <li <?php if ($params['order'] == 'level'): ?>class="lixz"<?php endif; ?>><a href="<?php echo base_url('product/index?order=level&') . http_build_query($paramter); ?>"  style="color:#333;"  title="根据评级排序">评级</a></li>
                </ul>
            </b>
            <div class="redu f-fl">
                <p class="redu-p">热度
                    <img src="<?php echo base_url(); ?>static/home/image/xiala_btn_11.png" style="margin-left:3px;"alt="下拉图标"/>
                </p>
                <div class="u-stab">
                    <a href="<?php echo base_url('product/index?order=views&') . http_build_query($paramter); ?>">浏览次数从高到低</a>
                    <a href="<?php echo base_url('product/index?order=buys&') . http_build_query($paramter); ?>">预约次数从高到低</a>
                    <a href="<?php echo base_url('product/index?order=downloads&') . http_build_query($paramter); ?>">下载次数从高到低</a>
                    <a href="<?php echo base_url('product/index?order=mails&') . http_build_query($paramter); ?>">发送邮件次数从高到低</a>
                </div>
            </div>
        </h2>     
        <!--信托-->
        <object class="divxz">
            <div class="m-mnc-2">    
                <?php if (!empty($product)): ?>
                    <?php foreach ($product as $key => $value): ?>
                        <div class="item-<?php echo $key + 1; ?> f-fl">
                            <table >
                                <tr>
                                    <td rowspan="5" style="width:582px;">
                                        <div class="table-mn">
                                            <div class="table-mn-tt">
                                                <h2 class="tl"><a href="<?php echo base_url('product/detial') . '/' . $value->id; ?>" target="_blank"><?php echo $value->product_name; ?></a></h2>
                                                <img src="<?php echo base_url(); ?>static/home/image/baoxiao_icon.png" alt="包销图标"/></div>
                                            <div class="table-mn-list">
                                                <div class="mt20">
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_1.png) 0% 50% no-repeat;"><?php echo $value->month; ?>个月</p>
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_2.png) 0% 50% no-repeat;"><?php echo $value->tender_area; ?></p>
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_3.png) 0% 50% no-repeat;"><?php echo $value->pay_way; ?></p>
                                                    <p class="table-mn-list-xq" style="background:url(<?php echo base_url(); ?>static/home/image/item_sicon_4.png) 0% 50% no-repeat;"><?php echo $value->interest_area; ?></p>
                                                    <div class="cb"></div>
                                                </div>
                                            </div>
                                            <div class="table-mn-progress mt20">
                                                <p class="f-fl" style="color:#f63e4f;font-size:12px;">募集进度:</p>
                                                <div class="pg-bar f-fr">
                                                    <div style="width:<?php echo $value->progress; ?>%;height:12px;background:#1dbb86;border-radius:15px;text-align:right;font-size:12px;color:#fff;padding-right:10px;"><p style="line-height:1.2em;"><?php echo $value->progress; ?>%</p></div>
                                                </div>
                                                <div class="cb"></div>
                                            </div>
                                            <div class="table-mn-update">
                                                <p class="tl"><?php echo $value->support_log; ?></p>
                                            </div>
                                            <div class="cb"></div>
                                        </div>                          
                                    </td>
                                    <td height="39px"><b>认购金额</b></td>
                                    <td><b>预期收益</b></td>
                                    <td><b>返佣比例</b></td>
                                </tr>
                                <?php if (!empty($value->items)): ?>
                                    <?php foreach ($value->items as $items_key => $items_value): ?>
                                        <tr>
                                            <td height="39px"><?php echo $items_value->buy_total; ?></td>
                                            <td><?php echo $items_value->interest; ?>%</td>
                                            <td><?php if (!empty($memeber)): ?><?php echo $items_value->fee; ?>%<?php else: ?><a href="<?php echo base_url('login/index'); ?>" style="color:#f1171a">登陆可见</a><?php endif; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="f-fl ml30"><a href="<?php echo base_url('download/index?type=') . base64_encode($value->id); ?>" target="_blank" class="data-btn tc">资料下载</a></div>
                                        <div class="f-fr">
                                            <div class="f-fl mr24"><a href="javascript:void(0);" onclick="return getMail(<?php echo $value->id; ?>)"  class="email-btn">发送邮件</a></div>
                                            <div class="f-fr mr30"><a href="<?php echo base_url('product/detial') . '/' . $value->id; ?>" target="_blank" class="order-btn">立即预约</a></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="cb"></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="cb"></div>
            </div>
        </object>
    </div>
</div>
<!--pager-->
<div id="pager">
    <?php echo $pagenation; ?>
</div>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=twitter"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/getmail.js" ></script>