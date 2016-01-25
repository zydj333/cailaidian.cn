<div class="formbody">
    <div class="formtitle"><span>添加菜单模块</span></div>
    <form action="/admin_system/add" method="post" id='system_add_form'>
        <ul class="forminfo">
            <li><label>模块标题</label><input name="title" type="text" class="dfinput" /><i>标题不能超过30个字符（如：首页）</i></li>
            <li><label>控制器名</label><input name="controllers" type="text" class="dfinput" /><i>标题不能超过30个字符（如：admin_index）</i></li>
            <li><label>操作名称</label><input name="actions" type="text" class="dfinput" /><i>标题不能超过30个字符（如：index）</i></li>
            <li>
                <label>父级名称</label>
                <div class="vocation">
                    <select class="select1" name="pid">
                        <option value="0">--没有父级--</option>
                        <?php if (!empty($list)): ?>
                            <?php foreach ($list as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->title; ?>--<?php echo $value->controllers; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </li>
            <li><label>排序</label><input name="salt" type="text" class="dfinput" /><i>填写一个整数（如：1）</i></li>
            <li><label>&nbsp;</label><input name="system_add_button" id='system_add_button' type="button" class="btn" value="确认保存"/></li>
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
        $("#system_add_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_system/add/" + Math.random(),
                data: $("#system_add_form").serialize(),
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