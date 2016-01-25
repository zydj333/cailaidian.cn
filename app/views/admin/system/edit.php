<div class="formbody">
    <div class="formtitle"><span>修改菜单模块</span></div>
    <form action="/admin_system/edit" method="post" id='system_edit_form'>
        <ul class="forminfo">
            <li><label>模块标题</label><input name="title" type="text" class="dfinput" value="<?php echo $system->title; ?>" /><i>标题不能超过30个字符（如：首页）</i></li>
            <li><label>控制器名</label><input name="controllers" type="text" class="dfinput" value="<?php echo $system->controllers; ?>" /><i>标题不能超过30个字符（如：admin_index）</i></li>
            <li><label>操作名称</label><input name="actions" type="text" class="dfinput" value="<?php echo $system->actions; ?>" /><i>标题不能超过30个字符（如：index）</i></li>
            <li>
                <input type="hidden" name="system_id" value="<?php echo $system->id; ?>"/>
                <label>父级名称</label>
                <div class="vocation">
                    <select class="select1" name="pid">
                        <option value="0" <?php if ($system->pid == 0): ?>selected="selected"<?php endif; ?> >--没有父级--</option>
                        <?php if (!empty($list)): ?>
                            <?php foreach ($list as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>" <?php if ($value->id == $system->pid): ?>selected="selected"<?php endif; ?> ><?php echo $value->title; ?>--<?php echo $value->controllers; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </li>
            <li><label>排序</label><input name="salt" type="text" class="dfinput" value="<?php echo $system->salt; ?>" /><i>填写一个整数（如：1）</i></li>
            <li><label>&nbsp;</label><input name="system_edit_button" id='system_edit_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript" src="/static/admin/js/select-ui.min.js"></script>
<link href="/static/admin/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function(e) {
        $(".select1").uedSelect({
            width: 345
        });
        $("#system_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_system/edit/" + Math.random(),
                data: $("#system_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_system/index";
                    }
                }
            });
        });

    });
</script>