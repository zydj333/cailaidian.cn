<?php if (!empty($member)): ?>

        <!--主栏-->
        <div class="ud_mn f-fr bg_ff">
            <div class="ud_mn_tt bg_ff">
                <p class="f-fl" style="border-bottom:3px solid #f1070a;">用户中心</p>
                <div class="cb"></div>
            </div>
            <div class="ud_mn_cont_1 pr">
                <a href="<?php echo base_url(); ?>mysetting/avatar"><img src="<?php echo base_url() . $member->head_ico; ?>"  onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" class="ud_mn_uhead" alt=""/></a><!--用户头像-->
                <div class="ud_mn_cont_1_detail f-fl">
                    <div>
                        <p class="inb">用户名&nbsp;:&nbsp;<?php echo substr_replace($member->account,'****',3,4); ?></p>
                        <p class="inb ml20">QQ&nbsp;:&nbsp;
                            <?php
                            if (empty($member->qq)) {
                                echo '未填写';
                            } else {
                                echo $member->qq;
                            }
                            ?>
                        </p>
                    </div>
                    <div>
                        <p class="inb">真实姓名&nbsp;:&nbsp;
                            <?php
                            if ($member->is_true == 0) {
                                echo '未认证';
                            } else {
                                echo $member->truename;
                            }
                            ?>
                        </p>
                        <p class="inb ml20">省份&nbsp;:&nbsp;
                            <?php
                            if (!empty($pro)) {
                                echo $pro->name;
                            } else {
                                echo '未填写';
                            }
                            ?>
                        </p>
                        <p class="inb">城市&nbsp;:&nbsp;
                            <?php
                            if (!empty($city)) {
                                echo $city->name;
                            } else {
                                echo '未填写';
                            }
                            ?>
                        </p>
                        <p class="inb">地区&nbsp;:&nbsp;
                            <?php
                            if (!empty($area)) {
                                echo $area->name;
                            } else {
                                echo '未填写';
                            }
                            ?>
                        </p>
                    </div>
                    <div>
                        <p class="f-fl">手机号 : <span><?php echo substr_replace($member->account,'****',3,4); ?></span></p>
                        <div class=" ml20 f-fl" style="height:24px;">
                            <i class="f-fl">个性签名 : </i>
                            <span class="f-fl ud_whatup"><?php echo $member->sign; ?></span>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <ul>
                        <li>
                            <?php if ($member->email_status == 1): ?>
                                <img src="<?php echo base_url() ?>static/home/image/huiyuanzx_icon_03.png" alt="email" id="yirenzheng"/>
                            <?php else: ?>
                                <img src="<?php echo base_url() ?>static/home/image/huiyuanzx_icon_03.png" alt="email" />
                            <?php endif; ?>
                            <ul>
                                <li class="renzheng_tips"><?php if ($member->email_status): ?>邮箱已认证<?php else: ?>未认证邮箱<?php endif; ?></li>
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo base_url() ?>static/home/image/huiyuanzx_icon_05.png" alt="phone" id="yirenzheng"/><!--已认证-->
                            <ul>
                                <li class="renzheng_tips">已手机认证</li>
                            </ul>
                        </li>
                        <li>
                            <?php if ($member->is_true == 1): ?>
                                <img src="<?php echo base_url() ?>static/home/image/huiyuanzx_icon_07.png" alt="ID" id="yirenzheng"/>
                            <?php else:?>
                                <img src="<?php echo base_url() ?>static/home/image/huiyuanzx_icon_07.png" alt="ID" />
                            <?php endif; ?>
                            <ul>
                                <li class="renzheng_tips"><?php if ($member->is_true): ?>已实名认证<?php else: ?>未实名认证<?php endif; ?></li>
                            </ul>
                        </li>
                        <div class="cb"></div>
                    </ul>
                    <div class="cb pr">
                        <span>用户等级&nbsp;:&nbsp;</span>
                        <span class="ud_level pa"><i style="width:<?php echo $point_info->pointsnow * 100 / $point_info->maxexp; ?>%;"></i></span><!--会员等级进度-->
                        <span style="margin-left:185px;color:#1dbb86;"><?php echo $point_info->groupname; ?></span>
                    </div>
                </div>  
                <div class="ud_mn_cont_1_code f-fr">
                    <a href="<?php echo base_url(); ?>mysetting/avatar"><img src="<?php echo base_url() . $member->head_ico; ?>"  onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" class="ud_mn_uhead" alt=""/></a>
                    <img src="<?php echo base_url() . $member->wechat_url; ?>" onerror="this.onerror='';this.src='<?php echo base_url() ?>static/home/image/zhuce_ft_code2.jpg'" alt="微信二维码" class="ud_code" />
                    <p>我的微信公众号</p>
                    <a href="<?php echo base_url(); ?>center_account/wechat">更换二维码</a><!--上传图片-->
                </div>
                <div class="cb"></div>
            </div>
            <div class="ud_mn_cont_2">
                <ul>
                    <li>
                        <div class="ud_mn_cont_rz">
                            <?php if ($member->email_status == 1): ?>
                            <div class="f-fl ud_rz_handled"><img src="<?php echo base_url() ?>static/home/image/ud_rz_yx.png"/></div>
                            <div class="f-fr">
                                <p>邮箱认证</p>
                                <span style="background:url(<?php echo base_url() ?>static/home/image/ud_rz_yes.png) left no-repeat;">已认证</span>
                                <a href="#">认证成功</a>
                            </div>
                                <?php else : ?>
                                    <div class="f-fl ud_rz_waiting"><img src="<?php echo base_url() ?>static/home/image/ud_rz_yx.png"/></div>
                                    <div class="f-fr">
                                        <p>邮箱认证</p>
                                        <span class="rz_waiting_icon">未认证</span>
                                        <a href="#" onclick="bdyx();">我要认证</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                    </li>
                    <li>
                        <div class="ud_mn_cont_rz">
                                <?php if ($member->is_true == 1): ?>
                                    <div class="f-fl ud_rz_handled"><img src="<?php echo base_url() ?>static/home/image/ud_rz_sm.png"/></div>
                                    <div class="f-fr">
                                        <p>实名认证</p>
                                        <span style="background:url(<?php echo base_url() ?>static/home/image/ud_rz_yes.png) left no-repeat;">已认证</span>
                                        <a href="#">认证成功</a>
                                    </div>
                                <?php else: ?>
                                        <div class="f-fl ud_rz_waiting"><img src="<?php echo base_url() ?>static/home/image/ud_rz_sm.png"/></div>
                                        <div class="f-fr">
                                            <p>实名认证</p>
                                            <span class="rz_waiting_icon">未认证</span>
                                            <a href="#" onclick="smrz();">我要认证</a>
                                        </div>
                                <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <div class="ud_mn_cont_rz">
                            <div class="f-fl ud_rz_handled"><img src="<?php echo base_url() ?>static/home/image/ud_rz_sj.png"/></div>
                            <div class="f-fr">
                                <p>手机认证</p>
                                <span style="background:url(<?php echo base_url() ?>static/home/image/ud_rz_yes.png) left no-repeat;">已认证</span>
                                <a href="#" onclick="xgbd();">修改绑定</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="cb"></div>
            </div>
            <div class="ud_mn_cont_3">
                <a href="#" onclick="srsd();" class="ud_mn_cont_3">修改个人资料</a>
            </div>
        </div>
        <div class="cb"></div>
        </div>
        <div class="cb"></div>
        </div>
<?php endif; ?>
<!--弹出窗口-->
<div id="fade" style="display:none;"></div>
<div id="popupcontent0" style="display:none;">
    <p class="popupcontent_tt">绑定邮箱</p>
    <form method="post" id="email_form">
        <div class="popupcontent_cont"><p>电子邮箱地址 : </p><input type="text" name="email" class="popup0_ipt_t"/></div>
        <input type="button" id="button0" value="确认" class="popup0_ipt_sub"/>
    </form>
</div>
<div id="popupcontent1" style="display:none;">
    <p class="popupcontent_tt">实名认证</p>
    <form method="post" id="truename_form">
        <div class="popupcontent_cont"><p>真实姓名 : </p><input type="text" name="truename" class="popup1_ipt_t"/></div>
        <div class="popupcontent_cont"><p>身份证 : </p><input type="text" name="idcard" class="popup1_ipt_t"/></div>
        <div class="popupcontent_cont">
            <p>验证码 : </p>
            <input type="text" name="safeCode" style="width:160px;background:url(<?php echo base_url('static/home/image/pop_inp_bg_08.png') ?>) 50% no-repeat;" class="popup1_ipt_t"/>
            <img src="<?php echo base_url('validate/doimg'); ?>" width="100px" height="40px" style="float:right;" alt="验证码" id="varifyCode"  onclick="fleshVerify()"/>
        </div>
        <input type="button" id="button1" value="确认" class="popup1_ipt_sub"/>
    </form>
</div>
<div id="popupcontent2" style="display:none;">
    <p class="popupcontent_tt">修改绑定手机号码</p>
    <form method="post" id="phone_form">
        <div class="ybd"><span class="inb mr10">已绑定手机号码 : </span><i><?php echo substr_replace($member->account,'****',3,4); ?></i></div>
        <div class="popupcontent_cont"><p>输入新手机号码 : </p><input type="text" id="account" name="account" class="popup2_ipt_t"/></div>
        <div class="popupcontent_cont"><p>验证登录密码 : </p><input type="password" id="password" name="password" class="popup2_ipt_t"/></div>
        <div class="popupcontent_cont">
            <p>获取手机验证码 : </p>
            <input type="text" id="phonecode" name="phonecode" style="width:160px;background:url(<?php echo base_url() ?>static/home/image/pop_inp_bg_08.png) 50% no-repeat;" class="popup2_ipt_t"/>
            <input type="button" name="button" value="获取验证码" class="pop_yzm_2" id="get_phonecode"/>
            <input type="button" name="button" value="60秒重新获取" class="pop_yzm_2" id="noget_phonecode" style=" display: none"/>
            <span id="timeb2" style=" display: none" >60</span>
        </div>
        <input type="button" id="button2" value="确认" class="popup2_ipt_sub"/>
    </form>
</div>
<div id="popupcontent3" style="display:none;">
    <p class="popupcontent_tt">输入个人资料</p>
    <?php if(!empty($pro) && !empty($city) && !empty($area) ):?>
        <form method="post" id="person_form">
        <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-left: 25px; padding: 10px;width: 120px;" name="province_id" id="province_id" onchange="return getCityList(this.value)">
            <option value="0">--选择省份--</option> 
            <?php if (!empty($province)): ?>
                <?php foreach ($province as $key => $memberalue): ?>
                    <option value="<?php echo $memberalue->id; ?>"<?php if ($pro->id == $memberalue->id): ?>selected="selected"<?php endif; ?>><?php echo $memberalue->name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-left: 1px; margin-bottom: 10px; padding: 10px;width: 120px;" name="city_id" id="city_id" onchange="return getAreaList(this.value)">
            <option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option> 
        </select>
        <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-left: 1px; margin-bottom: 10px; padding: 10px;width: 120px;" name="area_id" id="area_id">
            <option value="<?php echo $area->id; ?>"><?php echo $area->name; ?></option> 
        </select>
            <div class="popupcontent_cont"><p>输入QQ号码 : </p><input type="text" id="qq" name="qq" class="popup3_ipt_t" value="<?php echo $info->qq; ?>"/></div>
        <div class="popupcontent_cont"><p>个性签名 : </p><input type="text" id="sign" name="sign" class="popup3_ipt_t" value="<?php echo $info->sign; ?>"/></div>
        <input type="button" id="button3" value="确认" class="popup3_ipt_sub"/>
    </form>
    <?php else:?>
    <form method="post" id="person_form">
        <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-left: 25px; padding: 10px;width: 120px;" name="province_id" id="province_id" onchange="return getCityList(this.value)">
            <option value="0">--选择省份--</option> 
            <?php if (!empty($province)): ?>
                <?php foreach ($province as $key => $memberalue): ?>
                    <option value="<?php echo $memberalue->id; ?>"><?php echo $memberalue->name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-left: 1px; margin-bottom: 10px; padding: 10px;width: 120px;" name="city_id" id="city_id" onchange="return getAreaList(this.value)">
            <option value="0">--选择城市--</option> 
        </select>
        <select style=" background: #fafafa none repeat scroll 0 0;border: 1px solid #e6e6e6;border-radius: 5px;color: #666;font-size: 14px;margin-left: 1px; margin-bottom: 10px; padding: 10px;width: 120px;" name="area_id" id="area_id">
            <option value="0">--选择地区--</option> 
        </select>
        <div class="popupcontent_cont"><p>输入QQ号码 : </p><input type="text" id="qq" name="qq" class="popup3_ipt_t"/></div>
        <div class="popupcontent_cont"><p>个性签名 : </p><input type="text" id="sign" name="sign" class="popup3_ipt_t"/></div>
        <input type="button" id="button3" value="确认" class="popup3_ipt_sub"/>
    </form>
    <?php endif;?>
</div>
</div>
<script type="text/javascript">
    $(function (e) {
        $("#button1").live("click", function () {
            $.ajax({
                type: "POST",
                url: "/center_account/truename/" + Math.random(),
                data: $("#truename_form").serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/center_account/index";
                    }
                }
            });
        });
        $("#button0").live("click", function () {
            $.ajax({
                type: "POST",
                url: "/center_account/email/" + Math.random(),
                data: $("#email_form").serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/center_account/index";
                    }
                }
            });
        });

        $("#button2").live("click", function () {
            $.ajax({
                type: "POST",
                url: "/center_account/phone/" + Math.random(),
                data: $("#phone_form").serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/login/index";
                    }
                }
            });
        });

        $("#button3").live("click", function () {
            $.ajax({
                type: "POST",
                url: "/center_account/person/" + Math.random(),
                data: $("#person_form").serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/center_account/index";
                    }
                }
            });
        });

        //获取验证码
        $("#get_phonecode").live('click', function () {
            var phone = $("#account").val();
            if ((/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))) {
                $.ajax({
                    type: "POST",
                    url: "/phoneCode/createPhoneCode/" + Math.random(),
                    data: {"phone": phone, "codetype": 'change'},
                    dataType: "json",
                    success: function (data) {
                        if (data.flag === 1) {
                            $.dialog({
                                time: 2,
                                content: data.error
                            });
                            f_timeout();
                        } else {
                            $.dialog({
                                time: 2,
                                content: data.error
                            });
                        }
                    }
                });
            } else {
                $.dialog({
                    time: 2,
                    content: '手机格式不正确'
                });
            }
        });

        //切换发送按钮
        function f_timeout() {
            $('#get_phonecode').hide();
            $('#noget_phonecode').show();
            $('#noget_phonecode').val('60秒重新获取');
            $('#timeb2').html(60);
            timer = self.setInterval(addsec, 1000);
        }

        function addsec() {
            var t = $('#timeb2').html();
            if (t > 0) {
                var timestr = parseInt(t);
                var nowtime = timestr - 1;
                $('#timeb2').html(nowtime);
                $('#noget_phonecode').val(nowtime + '秒重新获取');
            } else {
                window.clearInterval(timer);
                $('#get_phonecode').show();
                $('#noget_phonecode').val('60秒重新获取');
                $('#timeb2').html(60);
                $('#noget_phonecode').hide();
            }
        }
    });
</script>
<script>

    var baseText0 = null
    function bdyx() {
        var popUp0 = document.getElementById("popupcontent0");
        popUp0.style.top = "30%";
        popUp0.style.left = "40%";
        if (baseText0 == null) {
            baseText0 = popUp0.innerHTML;
            popUp0.innerHTML = baseText0 + "<div id=\"statusbar0\"><a onclick=\"hidePopup0();\">取消</a></div>";
        }
        var sbar0 = document.getElementById("statusbar0");
        sbar0.style.position = "relative";
        popUp0.style.display = "block";
        var shade = document.getElementById("fade");
        shade.style.display = "block";
    }
    function hidePopup0() {
        var popUp0 = document.getElementById("popupcontent0");
        popUp0.style.display = "none";
        var shade = document.getElementById("fade");
        shade.style.display = "none";
    }
    var baseText1 = null
    function smrz() {
        var popUp1 = document.getElementById("popupcontent1");
        popUp1.style.top = "30%";
        popUp1.style.left = "40%";
        if (baseText1 == null) {
            baseText1 = popUp1.innerHTML;
            popUp1.innerHTML = baseText1 + "<div id=\"statusbar1\"><a onclick=\"hidePopup1();\">取消</a></div>";
        }
        var sbar1 = document.getElementById("statusbar1");
        sbar1.style.position = "relative";
        popUp1.style.display = "block";
        var shade = document.getElementById("fade");
        shade.style.display = "block"
    }
    function hidePopup1() {
        var popUp1 = document.getElementById("popupcontent1");
        popUp1.style.display = "none";
        var shade = document.getElementById("fade");
        shade.style.display = "none";
    }
    var baseText2 = null
    function xgbd() {
        var popUp2 = document.getElementById("popupcontent2");
        popUp2.style.top = "30%";
        popUp2.style.left = "40%";
        if (baseText2 == null) {
            baseText2 = popUp2.innerHTML;
            popUp2.innerHTML = baseText2 + "<div id=\"statusbar2\"><a onclick=\"hidePopup2();\">取消</a></div>";
        }
        var sbar2 = document.getElementById("statusbar2");
        sbar2.style.position = "relative";
        popUp2.style.display = "block";
        var shade = document.getElementById("fade");
        shade.style.display = "block";
    }
    function hidePopup2() {
        var popUp2 = document.getElementById("popupcontent2");
        popUp2.style.display = "none";
        var shade = document.getElementById("fade");
        shade.style.display = "none";
    }
    var baseText3 = null
    function srsd() {
        var popUp3 = document.getElementById("popupcontent3");
        popUp3.style.top = "30%";
        popUp3.style.left = "40%";
        if (baseText3 == null) {
            baseText3 = popUp3.innerHTML;
            popUp3.innerHTML = baseText3 + "<div id=\"statusbar3\"><a onclick=\"hidePopup3();\">取消</a></div>";
        }
        var sbar3 = document.getElementById("statusbar3");
        sbar3.style.position = "relative";
        popUp3.style.display = "block";
        var shade = document.getElementById("fade");
        shade.style.display = "block";
    }
    function hidePopup3() {
        var popUp3 = document.getElementById("popupcontent3");
        popUp3.style.display = "none";
        var shade = document.getElementById("fade");
        shade.style.display = "none";
    }
    function fleshVerify() {
        //重载验证码
        document.getElementById('varifyCode').src = '/validate/doimg/' + Math.random();
    }

    function getCityList(pid) {
        $.ajax({
            type: "POST",
            url: "/admin_common/getCity/" + Math.random(),
            data: {'pid': pid},
            dataType: "json",
            success: function (data) {
                var str = '<option value="0">-请选择-</option>';
                if (data.flag == 1) {
                    $.each(data.error, function (key, values) {
                        str += '<option value="' + values.id + '">' + values.name + '</option>';
                    });
                } else {
                    str += '<option value="0">' + data.error + '</option>';
                }
                $('#city_id').html(str);
            }
        });
    }

    function getAreaList(pid) {
        $.ajax({
            type: "POST",
            url: "/admin_common/getCity/" + Math.random(),
            data: {'pid': pid},
            dataType: "json",
            success: function (data) {
                var str = '<option value="0">-请选择-</option>';
                if (data.flag == 1) {
                    $.each(data.error, function (key, values) {
                        str += '<option value="' + values.id + '">' + values.name + '</option>';
                    });
                } else {
                    str += '<option value="0">' + data.error + '</option>';
                }
                $('#area_id').html(str);
            }
        });
    }
</script>