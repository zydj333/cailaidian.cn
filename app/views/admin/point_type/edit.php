<div class="formbody">
    <div class="formtitle"><span>修改商品分类</span></div>
    <form method="post" id='type_edit_form'>
        <ul class="forminfo">
            <li><label>分类名称</label><input name="name" type="text" class="dfinput" value="<?php echo $system->name; ?>" /><i>标题不能超过30个字符（如：首页）</i></li>
            <li>
                <input type="hidden" name="id" value="<?php echo $system->id; ?>"/>
                <label>父级名称</label>
                <div class="vocation">
                    <select class="select1" name="parent_id">
                        <option value="0" <?php if ($system->parent_id == 0): ?>selected="selected"<?php endif; ?> >--没有父级--</option>
                        <?php if (!empty($list)): ?>
                            <?php foreach ($list as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>" <?php if ($value->id == $system->parent_id): ?>selected="selected"<?php endif; ?> ><?php echo $value->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </li>
            <li><label>排序</label><input name="listorder" type="text" class="dfinput" value="<?php echo $system->listorder; ?>" /><i>填写一个整数（如：1）</i></li>
            <li><label>&nbsp;</label><input name="type_edit_button" id='type_edit_button' type="button" class="btn" value="确认保存"/></li>
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
        $("#type_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_point_type/edit/" + Math.random(),
                data: $("#type_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_point_type/index";
                    }
                }
            });
        });

    });
</script>