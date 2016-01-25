<div class="formbody">
    <div class="formtitle"><span>社区模块添加</span></div>
    <form action="#" method="post" id='bbs_module_edit_form'>
        <ul class="forminfo">
            <input type="hidden" name="cate_id" id="cate_id" value="<?php echo $cate->cate_id; ?>" />
            <li><label>分类标题</label><input name="cate_name" type="text" value="<?php echo $cate->cate_name; ?>" class="dfinput" maxlength="20" /><i>请填写模块的标题（长度不超过20个字符）</i></li>
            <li>
                <label>父级名称</label>
                <div class="vocation">
                    <select class="select1" name="cate_pid">
                        <option value="0">--没有父级--</option>
                        <?php if (!empty($list)): ?>
                            <?php foreach ($list as $key => $value): ?>
                                <option value="<?php echo $value->cate_id; ?>" <?php if ($cate->cate_pid == $value->cate_id): ?>selected="selected"<?php endif; ?> ><?php echo $value->cate_name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </li>
            <li>
                <label>封面图片</label>
                <div class="vocation">
                    <input name="fileToUpload" id="imageToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                    <input name="image_add" type="button" onclick="return ajaxFileUpload();" class="btn" value="上传"/>
                    <a href="/<?php echo $cate->cate_image_url; ?>" target="_blank" id="imgshow"><p id="upload_img"><img src="/<?php echo $cate->cate_image_url; ?>" width="50" height="30" /></p></a>
                    <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                    <input type="hidden" name="cate_image_url" id="cate_image_url" value="<?php echo $cate->cate_image_url; ?>" />
                </div>
            </li>
            <li></li>
            <li><label>模块描述</label><textarea class="textinput" name="cate_description" cols="150" rows="3"><?php echo $cate->cate_description; ?></textarea><i>请先填写此模块的一些说明</i></li>
            <li><label>排序</label><input name="cate_salt" type="number" value="<?php echo $cate->cate_salt; ?>" class="dfinput" maxlength="10" value="0" /><i>填写一个数字作为排序（只能为整数）</i></li>
            <li><label>&nbsp;</label><input id='bbs_module_edit_button' type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<link href="<?php echo base_url(); ?>static/admin/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/static/admin/js/select-ui.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/ajaxfileupload.js">
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $(".select1").uedSelect({
            width: 345
        });

        $("#bbs_module_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_bbs_module/edit/" + Math.random(),
                data: $("#bbs_module_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_bbs_module/index";
                    }
                }
            });
        });

    });


    function ajaxFileUpload() {
        $("#loading").show();
        $.ajaxFileUpload({
            url: '/admin_image/upload',
            secureuri: false,
            fileElementId: 'imageToUpload',
            dataType: 'json',
            data: {imagetype: 'bbs'},
            success: function(data, status) {
                $("#loading").hide();
                if (data.flag == 0) {
                    art.dialog(data.error);
                } else {
                    var temp = '<img src="/' + data.imgurl_thumb + '" width="50" height="30" />';
                    $('#upload_img').html(temp);
                    $('#cate_image_url').val(data.imgurl);
                    $('#imgshow').attr('href', '/' + data.imgurl);
                }
            },
            error: function(data, status, e) {
                art.dialog(e);
                $("#loading").hide();
            }
        });
        return false;
    }
</script>