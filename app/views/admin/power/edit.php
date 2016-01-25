<div class="formbody">
    <div class="formtitle"><span>修改权限</span></div>
    <form action="/admin_power/edit" method="post" id='power_edit_form'>
        <ul class="forminfo">
            <input type="hidden" name="power_id" value="<?php echo $power->id;?>" />
            <li><label>登录帐号</label><input name="powername" type="text" class="dfinput" maxlength="20" value="<?php echo $power->powername;?>" /><i>登录帐号信息（长度不超过20个字符）</i></li>
            <li><label>权限模块</label>
                <table id="powertable" class="form" cellpadding=0 cellspacing=0>
                    <?php if (!empty($list)): ?>
                        <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><input class="key" type="checkbox" name="power[]" id="piwer_<?php echo $value->id; ?>" value="<?php echo $value->id; ?>" <?php if(in_array($value->id, $power->power)):?>checked="checked"<?php endif;?> /><?php echo $value->title; ?></td>
                            </tr>
                            <?php if (!empty($value->second)): ?>
                                <?php foreach ($value->second as $k => $v): ?>
                                    <tr>
                                        <td style=" padding-left: 50px; " ><input class="key" type="checkbox" name="power[]" id="piwer_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>" <?php if(in_array($v->id, $power->power)):?>checked="checked"<?php endif;?> /><?php echo $v->title; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <tr>
                        <td colspan="2" class="topTd"></td>
                    </tr>
                </table>
            </li>
            <li></li>
            <li style="">
                <label>&nbsp;</label>
                <input type="button" value="全选" id="selectAll" class="ibtn" style="color:blue" />
                <input type="button" value="全不选" id="unSelect"  class="ibtn" style="color:blue" />
                <input type="button" value="反选" id="reverse"  class="ibtn" style="color:blue" />
            </li>
            <li></li>
            <li><label>&nbsp;</label><input id='power_edit_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#power_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_power/edit/" + Math.random(),
                data: $("#power_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_power/index";
                    }
                }
            });
        });
        
         $("#selectAll").click(function() {//全选
            $("#powertable :checkbox").attr("checked", true);
        });

        $("#unSelect").click(function() {//全不选
            $("#powertable :checkbox").attr("checked", false);
        });

        $("#reverse").click(function() {//反选
            $("#powertable :checkbox").each(function() {
                $(this).attr("checked", !$(this).attr("checked"));
            });
        });
    });
</script>