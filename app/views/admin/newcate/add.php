<div class="formbody">
    <div class="formtitle"><span>添加资讯分类</span></div>
    <form action="" method="post" id='newcate_add_form'>
        <ul class="forminfo">
            <li><label>分类名称</label><input name="name" type="text" class="dfinput" /></li>
            <li><label>排序</label><input name="listorder" type="text" class="dfinput" /></li>
            <li><label>&nbsp;</label><input id='newcate_add_button' type="button" class="btn" value="确认增加"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#newcate_add_button").click(function () {
            $.ajax({
            type: "POST",
                    url: "/admin_newcate/add/" + Math.random(),
                    data: $("#newcate_add_form").serialize(),
                    dataType: "json",
                    success: function (data) {
                    if (data.flag == 0) {
                    $.dialog(data.error);
                    } else {
                    $.dialog(data.error);
                            location.href = "/admin_newcate/index";
                    }
                    }
            });
        });
    });
</script>