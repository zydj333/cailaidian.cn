<div class="hetong_mn f-fr bg_ff">
    <div class="hetong_mn_shenq_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">合同申请</p>
        <div class="cb"></div>
    </div>
    <div class="hetong_mn_shenq">
        <form id="saveContractForm">
            <p class="f-fl mt10" style="margin-right:28px;">选择产品 : </p>
            <div id="sjld" style="width:550px;margin-bottom:22px;position:relative;">
                <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 150px;" name="category" onchange="return getProductList(this.value)">
                    <option value="0">--选择分类--</option> 
                    <?php if (!empty($cate)): ?>
                        <?php foreach ($cate as $key => $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 250px;" name="product_name" id="product_name">
                    <option value="0">--选择产品--</option> 
                </select>
                <div class="cb"></div>
            </div>
            <div>
                <p class="f-fl mt10" style="margin-right:8px;">收件人姓名 : </p>
                <input type="text" name="username" class="hetong_mn_shenq_ipt"/>
                <div class="cb"></div>
            </div>
            <div>
                <p class="f-fl mt10" style="margin-right:8px;">手机号码 : </p>
                <input type="text" name="celphone" class="hetong_mn_shenq_ipt"/>
                <div class="cb"></div>
            </div>
            <div>
                <p class="f-fl mt10" style="margin-right:8px;">收件地址 : </p>
                <input type="text" name="address" class="hetong_mn_shenq_ipt"/>
                <div class="cb"></div>
            </div>
            <div>
                <div class="f-fl">
                    <p class="hetong_hj"><span>寄回地址：</span>杭州市拱墅区湖州街168号美好国际大厦12F</p>
                    <p class="f-fl hetong_hj"><span>联系电话：</span>4008-313-668</p>
                </div>
                <a href="javascript:void(0);" class="hetong_mn_shenq_tj" id="saveContractButton">提交申请</a>
                <div class="cb"></div>
            </div>
        </form>
    </div>
    <div class="sp_mn_tt bg_ff">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">合同进度</p>
        <div class="cb"></div>
    </div>
    <div class="sp_mn_cont bg_ff cb">
        <div class="sp_mn_cont_tt">
            <table>
                <tr>
                    <td class="sp_mn_cont_tt_td">项目名称</td>
                    <td class="sp_mn_cont_tt_td">姓名</td>
                    <td class="sp_mn_cont_tt_td">手机号码</td>
                    <td class="sp_mn_cont_tt_td">地址</td>
                    <td class="sp_mn_cont_tt_td">状态</td>
                </tr>
            </table>
        </div>
        <?php if (!empty($list)): ?>
            <?php foreach ($list as $key => $value): ?>
                <div class="sp_mn_item">
                    <table class="f-fl">
                        <tr>
                            <td class="sp_mn_item_td"><?php echo $value->product_name; ?></td>
                            <td class="sp_mn_item_td"><?php echo $value->username; ?></td>
                            <td class="sp_mn_item_td"><?php echo $value->celphone; ?></td>
                            <td class="sp_mn_item_td"><?php echo $value->address; ?></td>
                            <td class="sp_mn_item_td">
                                <?php
                                    if($value->status == 1){
                                        echo '未发货';
                                    } else {
                                        echo '已发货';
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>  
                    <div class="cb"></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
</div>
        <div class="cb"></div>
    </div>
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<script type="text/javascript">
    function getProductList(cate_id) {
        $.ajax({
            type: "POST",
            url: "/center/ajaxGetProduct/" + Math.random(),
            data: {'cate_id': cate_id},
            dataType: "json",
            success: function (data) {
                var str = '<option value="0">-请选择-</option>';
                if (data.flag == 1) {
                    $.each(data.error, function (key, values) {
                        str += '<option value="' + values.id + '">' + values.product_name + '</option>';
                    });
                } else {
                    str += '<option value="0">' + data.error + '</option>';
                }
                $('#product_name').html(str);
            }
        });
    }
    $(function () {
        //提交按钮
        $('#saveContractButton').click(function () {
            $("#saveContractButton").attr("disabled", true);
            $.ajax({
                type: "POST",
                url: "/center/saveContract/" + Math.random(),
                data: $("#saveContractForm").serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.flag === 1) {
                        art.dialog(data.error);
                        location.href = "/center/contract";
                    } else {
                        $("#saveContractButton").attr("disabled", false);
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
                error: function (data, status, e)
                {
                    $("#saveContractButton").attr("disabled", false);
                    art.dialog(status);
                }
            });
        });
    });
</script>