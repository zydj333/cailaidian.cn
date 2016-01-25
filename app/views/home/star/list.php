<!--下面是主要内容-->
<div class="lcmx_mn">
    <div class="lcmx_mn_choose">
        <ul>
            <li>
                <p class="f-fl mr10">区域 :</p>
                <span class="lcmx_location_name"><?php if (!empty($province_name)): ?><?php echo $province_name->name; ?><?php else: ?>全国<?php endif; ?></span>
            </li>
            <li class="more_location pr">更改区域
                <div class="location_list">
                    <ul>
                        <a href="<?php echo base_url('star/index') ?>?province=-1" style="color: #fe3638;" ><li>全国</li></a>
                        <?php if (!empty($province)): ?>
                            <?php foreach ($province as $province_key => $province_values): ?>
                                <a href="<?php echo base_url('star/index') ?>?province=<?php echo $province_values->id; ?>" style="color: #fe3638;" ><li><?php echo $province_values->name; ?></li></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="cb"></div>
                    </ul>
                </div>
            </li>
            <li><a href="<?php echo base_url('star/index') ?>?province=<?php echo $search['province']; ?>&order=2" class="lcmx_bylevel">按等级</a></li>
            <div class="cb"></div>
        </ul>
    </div>
    <div class="lcmx_mn_cont">
        <ul>
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $key => $values): ?>
                    <li>
                        <div class="lcmx_mn_cont_item" <?php if (($key + 1) % 4 == 0): ?>style="margin-right:0;"<?php endif; ?>>
                            <div class="f-fl">
                                <div class="pr">
                                    <a href="<?php echo base_url('star/starList'); ?>/<?php echo $values->user_id; ?>" target="_blank" title="查看TA的个人信息"><img src="<?php echo base_url() . $values->head_ico; ?>" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'" class="lcmx_head" alt=""/></a><!--头像-->
                                </div>
                            </div>
                            <div class="f-fr lcmx_item_itd">
                                <p><i><?php if ($values->truename != ''): ?><?php echo $values->truename; ?><?php else: ?><?php echo substr($values->account,0,3).'****'.substr($values->account,-4,4);?><?php endif; ?> </i></p>
                                <p>区域 <i><?php if ($values->province_name != ''): ?><?php echo $values->province_name; ?><?php else: ?>未填写<?php endif; ?></i></p>
                                <span>积分 </span><!--<img src="<?php echo base_url(); ?>static/home/image/lcmx_level_star5.png" class="lcmx_level"/>--><?php echo $values->points; ?>
                            </div>
                            <div class="bg_ff cb lcmx_item_sign">
                                <p><?php echo $values->sign; ?></p>
                            </div>
                            <div style="margin-top:5px;">
                                <a href="javascript:void(0);" class="lcmx_item_btn" onClick="zx(<?php echo $values->user_id; ?>)">咨询</a>
                                <a href="javascript:void(0);" class="lcmx_item_btn" onClick="gz(<?php echo $values->user_id; ?>)">关注</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cb"></div>
        </ul>
    </div>
    <div class="lcmx_mn_pager">
         <?php echo $pagenation; ?>
     <!-- <a href="#" style="padding:2px 17px;">首页</a>
        <a href="#" style="padding:2px 11px;">上一页</a>
        <a href="#" class="current">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">...</a>
        <a href="#" style="padding:2px 11px;">下一页</a>
        <a href="#" style="padding:2px 17px;">末页</a>-->
    </div>
</div>
<div id="fade" style="display:none;"></div>
<div id="popupcontent0" style="display:none;">
    <p class="popupcontent_tt">发消息给理财师</p>
    <form id="save_site_message_form">
        <textarea class="lcmx_fm_ta" name="content" placeholder="说点什么..."></textarea>
        <input type="hidden" name="to_user_id" id="to_user_id" value="0" />
        <input type="hidden" name="my_contact_type" id="my_contact_type" value="1">
        <div>
            <p style="margin-bottom:5px;font-size:14px;color:#333;">留下你的联系方式 :</p>
            <ul id="contact_type">
                <li class="wfl_red" value_data="1" id="my_cellphone">手机</li>
                <li value_data="2" id="my_qq_number">QQ</li>
                <li value_data="3" id="my_email">邮箱</li>
            </ul>
            <input type="text" class="lcmx_fm_ipt_t" name="contact_value"/>
        </div>
        <input id="save_site_message_button" type="button" value="确认" class="popup0_ipt_sub"/>
    </form>
</div>
<div id="popupcontent1" style="display:none;">
    <p class="popupcontent_tt">关注理财师微信号</p>
    <div class="popupcontent_cont">
        <img src="<?php echo base_url(); ?>static/home/image/zhuce_ft_code2.jpg" alt="微信二维码" class="lcmx_code db" id="showWechat"/>
        <p>扫描微信二维码</p>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/jquery.artDialog.js?skin=twitter">
</script>
<script type="text/javascript">
    var baseText0 = null
    function zx(uid) {
        $("#to_user_id").val(uid);
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
    function gz(uid) {
        $.ajax({
            type: "POST",
            url: "/star/getStarWechat/" + Math.random(),
            data: {'uid': uid},
            dataType: "json",
            success: function(data) {
                if (data.flag == 0) {
                    $("#showWechat").attr('src', '/static/home/image/zhuce_ft_code2.jpg');
                } else {
                    $("#showWechat").attr('src', '/' + data.error);
                }
            }
        });
        var popUp1 = document.getElementById("popupcontent1");
        popUp1.style.top = "30%";
        popUp1.style.left = "40%";
        if (baseText1 == null) {
            baseText1 = popUp1.innerHTML;
            popUp1.innerHTML = baseText1 + "<div id=\"statusbar1\"><a onclick=\"hidePopup1();\">关闭窗口</a></div>";
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
    $(function() {
        $("#my_cellphone").live('click', function() {
            $(this).removeClass('wfl_red');
            $("#my_qq_number").removeClass('wfl_red');
            $("#my_email").removeClass('wfl_red');
            $(this).addClass('wfl_red');
            var type_value = $(this).attr('value_data');
            $("#my_contact_type").val(type_value);
        });
        $("#my_qq_number").live('click', function() {
            $(this).removeClass('wfl_red');
            $("#my_cellphone").removeClass('wfl_red');
            $("#my_email").removeClass('wfl_red');
            $(this).addClass('wfl_red');
            var type_value = $(this).attr('value_data');
            $("#my_contact_type").val(type_value);
        });
        $("#my_email").live('click', function() {
            $(this).removeClass('wfl_red');
            $("#my_qq_number").removeClass('wfl_red');
            $("#my_cellphone").removeClass('wfl_red');
            $(this).addClass('wfl_red');
            var type_value = $(this).attr('value_data');
            $("#my_contact_type").val(type_value);
        });
        /**
         * 
         * @todo 提交站内信按钮 
         * 
         */
        $('#save_site_message_button').live('click', function() {
            $.ajax({
                type: "POST",
                url: "/star/sendSiteLetter/" + Math.random(),
                data: $("#save_site_message_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
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
                    } else {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data.error,
                            time: 3,
                            width: 500
                        });
                        hidePopup0();
                    }
                }
            });
        });
    });



</script>