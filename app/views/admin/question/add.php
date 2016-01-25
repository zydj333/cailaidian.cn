<div class="formbody">
    <div class="formtitle"><span>后台回复</span></div>
    <form action="" method="post" id='add_form'>
        <ul class="forminfo">
            <input name="id" type="hidden" value="<?php echo $info->id;?>"/>
            <li><label>标题</label><input name="qtitle" type="text" class="dfinput" value="<?php echo $info->title;?>"  readonly="readonly" /></li>
            <li><label>回复内容</label><input name="content" type="text" class="dfinput" /></li>
            <li><label>&nbsp;</label><input id='add_button' type="button" class="btn" value="确认增加"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#add_button").click(function () {
            $.ajax({
                type: "POST",
                url: "/admin_bbs_question/savaAdd/" + Math.random(),
                data: $("#add_form").serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_bbs_question/index";
                    }
                }
            });
        })
    });
</script>