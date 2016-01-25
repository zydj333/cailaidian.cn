<div class="up_mn">
    <div>
        <p class="up_mn_tt">上传产品</p>
    </div>
    <div id="cptab_up">
        <div class="up_mn_tab"></div> 
        <!--信托产品-->
        <object class="divxz">
            <div class="up_mn_fm">
                <form id="upload_product_form">
                    <div style="margin-bottom:12px;">
                        <div class="f-fl">
                            <p class="f-fl">产品分类 :</p>
                            <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 326px;" name="category">
                                <option value="0">--选择分类--</option> 
                                <?php if (!empty($category)): ?>
                                    <?php foreach ($category as $key => $value): ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="f-fr">
                            <p class="f-fl">产品地区 :</p>
                            <div class="f-fr" style="width:330px;">
                                <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 150px;" name="province" onchange="return getCity(this.value)">
                                    <option value="0">--选择省份--</option> 
                                    <?php if (!empty($province)): ?>
                                        <?php foreach ($province as $key => $value): ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 155px;" name="city" id="city">
                                    <option value="0">--选择城市--</option> 
                                </select>
                            </div>
                            <div class="cb"></div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div style="margin-bottom:12px;"><p class="f-fl">产品名称 :</p><input type="text" name="product_name" class="up_mn_fm_ipt1"/></div>
                    <div style="margin-bottom:12px;">
                        <div class="f-fl">
                            <p class="f-fl">发行机构 :</p><input type="text" class="up_mn_fm_ipt2" name="company"/>
                        </div>
                        <div class="f-fr">
                            <p class="f-fl">认购起点 :</p><input type="text" class="up_mn_fm_ipt2" name="support_limit" style="background:url(<?php echo base_url(); ?>static/home/image/up_fm_ipt_bg_1.png) right;"/>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <div class="f-fl">
                            <p class="f-fl">产品期限 :</p><input type="text" class="up_mn_fm_ipt2" name="month" style="background:url(<?php echo base_url(); ?>static/home/image/up_fm_ipt_bg_3.png) right;"/>
                        </div>
                        <div class="f-fr">
                            <p class="f-fl">资金规模 :</p><input type="text" class="up_mn_fm_ipt2" name="amount" style="background:url(<?php echo base_url(); ?>static/home/image/up_fm_ipt_bg_1.png) right;"/>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <div class="f-fl">
                            <p class="f-fl">投资领域 :</p>
                            <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 326px;" name="tender_area">
                                <option value="0">--选择投资领域--</option> 
                                <?php if (!empty($area)): ?>
                                    <?php foreach ($area as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="f-fr">
                            <p class="f-fl">年化收益 :</p>
                            <div class="f-fr" style="width:330px;">
                                <input type="text" class="up_mn_fm_ipt2" name="interest" placeholder="8%-10%"/>
                            </div>
                            <div class="cb"></div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <div class="f-fl">
                            <p class="f-fl">付息方式 :</p>
                            <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 326px;" name="pay_way">
                                <option value="0">--选择付息方式--</option> 
                                <?php if (!empty($payway)): ?>
                                    <?php foreach ($payway as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="f-fr">
                            <p class="f-fl">收益明细 :</p><input type="text" class="up_mn_fm_ipt2" name="interest_detial"/>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <div class="f-fl">
                            <p class="f-fl">收益类型 :</p>
                            <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-right: 10px; padding: 10px;width: 326px;" name="earning">
                                <option value="0">--选择收益类型--</option> 
                                <?php if (!empty($earning)): ?>
                                    <?php foreach ($earning as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="f-fr">
                            <p class="f-fl">发行费用 :</p><input type="text" class="up_mn_fm_ipt2" name="fee" placeholder="1.5%"/>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <p class="f-fl">募资账号 :</p>
                        <textarea class="up_mn_fm_ta" name="account"></textarea>
                    </div>
                    <div style="margin-bottom:12px;">
                        <p class="f-fl">资金用途 :</p>
                        <textarea class="up_mn_fm_ta" name="use_for"></textarea>
                    </div>
                    <div style="margin-bottom:12px;">
                        <p class="f-fl">还款来源 :</p>
                        <textarea class="up_mn_fm_ta" name="repayment_from"></textarea>
                    </div>
                    <div style="margin-bottom:12px;">
                        <p class="f-fl">风控措施 :</p>
                        <textarea class="up_mn_fm_ta" style="height:72px;" name="risk_control"></textarea>
                    </div>
                    <div style="margin-bottom:12px;">
                        <p class="f-fl">项目亮点 :</p>
                        <textarea class="up_mn_fm_ta" style="height:122px;" name="highlights"></textarea>
                    </div>
                    <div style="text-align:right;">
                        <a href="javascript:void(0);"  id="upload_product_button" class="up_mn_fm_btn" style="background:url(<?php echo base_url(); ?>static/home/image/up_btn_bg_03.png) 50% no-repeat;">发布</a>
                        <a href="<?php echo base_url('launch/index');?>" class="up_mn_fm_btn" style="background:url(<?php echo base_url(); ?>static/home/image/up_btn_bg_05.png) 50% no-repeat;">撤销</a>
                    </div>
                </form>
            </div>
        </object> 
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>static/admin/js/jquery.artDialog.js?skin=twitter"></script>
<script type="text/javascript">
    function getCity(pid) {
        $.ajax({
            type: "POST",
            url: "/admin_common/getCity/" + Math.random(),
            data: {'pid': pid},
            dataType: "json",
            success: function(data) {
                var str = '<option value="0">-请选择-</option>';
                if (data.flag == 0) {
                    str += '<option value="0">' + data.error + '</option>';
                } else {
                    $.each(data.error, function(key, values) {
                        str += '<option value="' + values.id + '">' + values.name + '</option>';
                    });
                }
                $('#city').html(str);
            }
        });
    }
    //提交按钮
    $('#upload_product_button').click(function(){
        $("#upload_product_button").attr("disabled", true); 
        $.ajax({
            type: "POST",
            url: "/launch/saveProduct/" + Math.random(),
            data: $("#upload_product_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    art.dialog(data.error);
                    location.href="/center_product/index";
                } else {
                    $("#upload_product_button").attr("disabled", false); 
                    art.dialog({
                        title: '信息提示',
                        lock: true,
                        background: '#600', // 背景色
                        opacity: 0.90, // 透明度
                        content: data.error,
                        time: 3,
                        width: 500
                    });
                    return;
                }
            },
            error: function(data, status, e)
            {
                $("#upload_product_button").attr("disabled", false); 
                 art.dialog(status);
            }
        });
    });
    
</script>