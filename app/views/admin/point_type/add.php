<div class="formbody">
    <div class="formtitle"><span>添加菜单模块</span></div>
    <form method="post" id='type_add_form'>
        <ul class="forminfo">
            <li><label>分类名称</label><input name="name" type="text" class="dfinput" /><i>标题不能超过30个字符（如：首页）</i></li>
            <li>
                <label>父级名称</label>
                <div class="vocation">
                    <select class="select1" name="parent_id">
                        <option value="0">--没有父级--</option>
                        <?php if (!empty($list)): ?>
                            <?php foreach ($list as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </li>
            <li><label>排序</label><input name="listorder" type="text" class="dfinput" /><i>填写一个整数（如：1）</i></li>
            <li><label>&nbsp;</label><input name="type_add_button" id='type_add_button' type="button" class="btn" value="确认保存"/></li>
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
        $("#type_add_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_point_type/add/" + Math.random(),
                data: $("#type_add_form").serialize(),
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