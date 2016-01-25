<!--主栏-->
<div class="baodan_mn f-fr bg_ff">
    <div class="baodan_mn_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">报单申请</p>
        <div class="cb"></div>
    </div>
    <div class="baodan_mn_cont_1">
        <form id="book_order_form">
            <p class="f-fl mt10" style="margin-right:17px;">选择产品 : </p>
            <div  style="width:550px;margin-bottom:22px;position:relative;">
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
            <div style="width:570px;margin-bottom:22px;">
                <div>
                    <p class="f-fl mt10" style="margin-right:17px;">客户姓名 : </p>
                    <input type="text" class="baodan_mn_cont_1_ipt" name="name"/>
                </div>
                <a id="" class="baodan_ipt_tips" style="display:none;">请输入客户姓名</a>
                <div class="cb"></div>
            </div>
            <div style="width:570px;margin-bottom:22px;">
                <div>
                    <p class="f-fl mt10" style="margin-right:17px;">打款金额 : </p>
                    <input type="text" name="money" style="background:url(<?php echo base_url(); ?>static/home/image/input_bg_03.png) 50% no-repeat;" class="baodan_mn_cont_1_ipt"/>
                </div>
                <a id="" class="baodan_ipt_tips" style="display:none;">请输入打款金额</a>
                <div class="cb"></div>
            </div>
            <div style="width:570px;margin-bottom:22px;">
                <div>
                    <p class="f-fl mt10" style="margin-right:17px;">打款日期 : </p>
                    <input type="text" id="hello" name="date" class="laydate-icon-dahong baodan_mn_cont_1_ipt" style="background:url(<?php echo base_url(); ?>static/home/image/input_bg_06.png) 50% no-repeat;"/>
                </div>
                <a id="" class="baodan_ipt_tips" style="display:none;">请输入打款日期</a>
                <div class="cb"></div>
            </div>
            <input type="hidden" name="idcard_up" id="idcard_up" value="">
            <input type="hidden" name="idcard_back" id="idcard_back" value="">
            <input type="hidden" name="bankcard_up" id="bankcard_up" value="">
            <input type="hidden" name="money_slip" id="money_slip" value="">
            <input type="hidden" name="signature1" id="signature1" value="">
            <input type="hidden" name="remark" id="remark" value="">
            <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/laydate.js"></script>
            <script type="text/javascript">
                    laydate({
                        elem: '#hello',
                        event: 'focus'
                    });
            </script>
        </form>
    </div>
    <div class="baodan_mn_cont_2">
        <p style="width:660px;margin:20px 0;border-bottom:1px solid #e0e0e0;">上传证件 :</p>
        <form>
            <div class="scziliao f-fl">
                <p class="f-fl" style="margin-top:28px;">上传身份证正面 :</p>
                <input type="file" name="fileToUpload" id="idcard_up_file" value="身份证正面 :" class="f-fl baodan_mn_cont_2_ipt"/>
                <div class="f-fr">
                    <div class="sc_img"><img id="idcard_up_show" width="130px" height="80px" src="<?php echo base_url(); ?>static/home/image/baodan_scziliao_03.png" alt="IDcard"/></div>
                    <span class="sc_tips" id="idcard_up_error">未上传</span>                        
                </div>
                <div class="cb"></div>
            </div>
            <div class="scziliao f-fr">
                <p class="f-fl" style="margin-top:28px;">上传身份证反面 :</p>
                <input type="file" name="fileToUpload" id="idcard_back_file" value="身份证反面 :" class="f-fl baodan_mn_cont_2_ipt"/>
                <div class="f-fr">
                    <div class="sc_img"><img id="idcard_back_show" width="130px" height="80px" src="<?php echo base_url(); ?>static/home/image/baodan_scziliao_05.png" alt="IDcard"/></div>
                    <span class="sc_tips" id="idcard_back_error">未上传</span>                        
                </div>
                <div class="cb"></div>
            </div>
            <div class="scziliao f-fl">
                <p class="f-fl" style="margin-top:28px;">上传银行卡正面 :</p>
                <input type="file" name="fileToUpload" id="bankcard_up_file" value="银行卡正面 :" class="f-fl baodan_mn_cont_2_ipt"/>
                <div class="f-fr">
                    <div class="sc_img"><img id="bankcard_up_show" width="130px" height="80px" src="<?php echo base_url(); ?>static/home/image/baodan_scziliao_09.png" alt="Bankcard"/></div>
                    <span class="sc_tips" id="bankcard_up_error">未上传</span>                        
                </div>
                <div class="cb"></div>
            </div>
            <div class="scziliao f-fr">
                <p class="f-fl" style="margin-top:28px;">上传打款凭条 :</p>
                <input type="file" name="fileToUpload" id="money_slip_file" value="打款凭条 :" class="f-fl baodan_mn_cont_2_ipt" style=" margin-left: 23px;"/>
                <div class="f-fr">
                    <div class="sc_img"><img id="money_slip_show" width="130px" height="80px" src="<?php echo base_url(); ?>static/home/image/baodan_scziliao_11.png" alt="presspaper"/></div>
                    <span class="sc_tips" id="money_slip_error">未上传</span>                        
                </div>
                <div class="cb"></div>
            </div>
            <div class="scziliao f-fl">
                <p class="f-fl" style="margin-top:28px;">上传签字页 :</p>
                <input type="file" name="fileToUpload" id="signature1_file" value="签字页 :" class="f-fl baodan_mn_cont_2_ipt" style=" margin-left: 37px;" />
                <div class="f-fr">
                    <div class="sc_img"><img id="signature1_show" width="130px" height="80px" src="<?php echo base_url(); ?>static/home/image/baodan_scziliao_16.png" alt="signpaper"/></div>
                    <span class="sc_tips" id="signature1_error">未上传</span>                        
                </div>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>
        </form>
        <div>
            <P class="f-fl" style="margin-right:17px;padding:10px 0;">备注 : </P>
            <textarea class="baodan_beizhu f-fl" name="remark_content" id="remark_content"></textarea>
            <div class="cb"></div>
        </div>
        <form>
            <input type="button" value="确认提交" class="baodan_mn_cont_2_btn" id="book_order_button"/>
            <input type="button" value="重置内容" class="baodan_mn_cont_2_btn" id="book_order_reset"/>
        </form>
    </div>
    <div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<div class="cb"></div>
</div>
<script type='text/javascript' src="<?php echo base_url(); ?>static/admin/js/ajaxfileupload.js"></script>
<script type="text/javascript">
function getProductList(cate_id) {
    $.ajax({
        type: "POST",
        url: "/center/ajaxGetProduct/" + Math.random(),
        data: {'cate_id': cate_id},
        dataType: "json",
        success: function(data) {
            var str = '<option value="0">-请选择-</option>';
            if (data.flag == 1) {
                $.each(data.error, function(key, values) {
                    str += '<option value="' + values.id + '">' + values.product_name + '</option>';
                });
            } else {
                str += '<option value="0">' + data.error + '</option>';
            }
            $('#product_name').html(str);
        }
    });
}


$(function(){
    //重置按钮
    $('#book_order_reset').click(function(){
        location.href='/center/trade';
    });
    
    //提交按钮
    $('#book_order_button').click(function(){
        var remark=$('#remark_content').val();
        $("#remark").val(remark);
        $("#book_order_button").attr("disabled", true); 
        $.ajax({
            type: "POST",
            url: "/center/saveOrder/" + Math.random(),
            data: $("#book_order_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    art.dialog(data.error);
                    location.href="/center/order";
                } else {
                    $("#book_order_button").attr("disabled", false); 
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
                $("#book_order_button").attr("disabled", false); 
                 art.dialog(status);
            }
        });
    });
    //上传身份证正面
    $('#idcard_up_file').die().live('change',function(){
         $("#idcard_up_show").attr('src','/static/admin/images/loading.gif');
            $.ajaxFileUpload({
                url: '/admin_image/upload',
                secureuri: false,
                fileElementId: 'idcard_up_file',
                dataType: 'json',
                data: {imagetype: 'order'},
                success: function(data, status)
                {
                    if (data.flag === 0) {
                         art.dialog(data.error);
                         $("#idcard_up_show").attr('src','/static/home/image/baodan_scziliao_03.png');
                    } else {
                        $('#idcard_up_show').attr('src','/'+data.imgurl);
                        $('#idcard_up').val(data.imgurl);
                        $('#idcard_up_error').html('已上传');
                    }
                },
                error: function(data, status, e)
                {
                    $("#idcard_up_show").attr('src','/static/home/image/baodan_scziliao_03.png');
                     art.dialog(e);
                }
            }
           );
           return false;
    });
               
//上传身份证反面
   $('#idcard_back_file').die().live('change',function(){
         $("#idcard_back_show").attr('src','/static/admin/images/loading.gif');
            $.ajaxFileUpload({
                url: '/admin_image/upload',
                secureuri: false,
                fileElementId: 'idcard_back_file',
                dataType: 'json',
                data: {imagetype: 'order'},
                success: function(data, status)
                {
                    if (data.flag === 0) {
                         art.dialog(data.error);
                         $("#idcard_back_show").attr('src','/static/home/image/baodan_scziliao_05.png');
                    } else {
                        $('#idcard_back_show').attr('src','/'+data.imgurl);
                        $('#idcard_back').val(data.imgurl);
                        $('#idcard_back_error').html('已上传');
                    }
                },
                error: function(data, status, e)
                {
                    $("#idcard_back_show").attr('src','/static/home/image/baodan_scziliao_05.png');
                     art.dialog(e);
                }
            }
           );
           return false;
    });
//上传银行卡正面
$('#bankcard_up_file').die().live('change',function(){
         $("#bankcard_up_show").attr('src','/static/admin/images/loading.gif');
            $.ajaxFileUpload({
                url: '/admin_image/upload',
                secureuri: false,
                fileElementId: 'bankcard_up_file',
                dataType: 'json',
                data: {imagetype: 'order'},
                success: function(data, status)
                {
                    if (data.flag === 0) {
                         art.dialog(data.error);
                         $("#bankcard_up_show").attr('src','/static/home/image/baodan_scziliao_09.png');
                    } else {
                        $('#bankcard_up_show').attr('src','/'+data.imgurl);
                        $('#bankcard_up').val(data.imgurl);
                        $('#bankcard_up_error').html('已上传');
                    }
                },
                error: function(data, status, e)
                {
                    $("#bankcard_up_show").attr('src','/static/home/image/baodan_scziliao_09.png');
                     art.dialog(e);
                }
            }
           );
           return false;
    });
//上传打款凭条
$('#money_slip_file').die().live('change',function(){
         $("#money_slip_show").attr('src','/static/admin/images/loading.gif');
            $.ajaxFileUpload({
                url: '/admin_image/upload',
                secureuri: false,
                fileElementId: 'money_slip_file',
                dataType: 'json',
                data: {imagetype: 'order'},
                success: function(data, status)
                {
                    if (data.flag === 0) {
                         art.dialog(data.error);
                         $("#money_slip_show").attr('src','/static/home/image/baodan_scziliao_11.png');
                    } else {
                        $('#money_slip_show').attr('src','/'+data.imgurl);
                        $('#money_slip').val(data.imgurl);
                        $('#money_slip_error').html('已上传');
                    }
                },
                error: function(data, status, e)
                {
                    $("#money_slip_show").attr('src','/static/home/image/baodan_scziliao_11.png');
                     art.dialog(e);
                }
            }
           );
           return false;
    });

//上传签字页
$('#signature1_file').die().live('change',function(){
         $("#signature1_show").attr('src','/static/admin/images/loading.gif');
            $.ajaxFileUpload({
                url: '/admin_image/upload',
                secureuri: false,
                fileElementId: 'signature1_file',
                dataType: 'json',
                data: {imagetype: 'order'},
                success: function(data, status)
                {
                    if (data.flag === 0) {
                         art.dialog(data.error);
                         $("#signature1_show").attr('src','/static/home/image/baodan_scziliao_16.png');
                    } else {
                        $('#signature1_show').attr('src','/'+data.imgurl);
                        $('#signature1').val(data.imgurl);
                        $('#signature1_error').html('已上传');
                    }
                },
                error: function(data, status, e)
                {
                    $("#signature1_show").attr('src','/static/home/image/baodan_scziliao_16.png');
                     art.dialog(e);
                }
            }
           );
           return false;
    });
});


</script>