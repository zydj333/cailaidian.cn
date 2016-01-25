<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="/static/admin/css/select.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/select-ui.min.js"></script>
        <script type='text/javascript' src="/static/admin/js/ajaxfileupload.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width: 345
                });
                $("#banner_add_button").click(function() {
                    $.ajax({
                        type: "POST",
                        url: "/admin_banner/add/" + Math.random(),
                        data: $("#banner_add_form").serialize(),
                        dataType: "json",
                        success: function(data) {
                            if (data.flag == 0) {
                                alert(data.error);
                            } else {
                                alert(data.error);
                                location.href = "/admin_banner/index";
                            }
                        }
                    });
                })
            });
            function ajaxFileUpload() {
                $("#loading")
                        .ajaxStart(function() {
                            $(this).show();
                        })
                        .ajaxComplete(function() {
                            $(this).hide();
                        });
                $.ajaxFileUpload
                        (
                                {
                                    url: '/admin_image/upload',
                                    secureuri: false,
                                    fileElementId: 'fileToUpload',
                                    dataType: 'json',
                                    data: {imagetype: 'banner'},
                                    success: function(data, status)
                                    {
                                        if (data.flag == 0) {
                                            alert(data.error);
                                        } else {
                                            var temp = '<img src="/' + data.imgurl_thumb + '" width="50" height="30" />';
                                            $('#upload_img').html(temp);
                                            $('#coverimage').val(data.imgurl);
                                            $('#coverimageid').val(data.imageid);
                                            $('#imgshow').attr('href', '/' + data.imgurl);
                                        }
                                    },
                                    error: function(data, status, e)
                                    {
                                        alert(e);
                                    }
                                }
                        )
                return false;
            }
        </script>
    </head>
    <body>
        <div class="formbody">
            <div class="formtitle"><span>添加广告</span></div>
            <form action="" method="post" id='banner_add_form'>
                <ul class="forminfo">
                    <li>
                        <label>广告类别</label>
                        <div class="vocation">
                            <select name="type" class="select1">
                                <option value="">请选择类别</option>
                                <?php if (!empty($bannertype)): ?>
                                    <?php foreach ($bannertype as $k => $v) : ?>
                                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </li>
                    <li><label>广告标题</label><input name="title" type="text" class="dfinput" maxlength="30" /></li>
                    <li><label>链接地址</label><input name="url" type="text" class="dfinput" /></li>
                    <li><label>颜色块</label><input name="color" type="text" class="dfinput" /></li>
                    <li><label>排序</label><input name="listorder" type="text" class="dfinput" maxlength="20" /></li>
                    <li><label>封面图片</label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload();" class="btn" value="上传"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                            <input type="hidden" name="imageurl" id="coverimage" value="" />
                            <input type="hidden" name="imageid" id="coverimageid" value="" />
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input name="new_banner_button" id='banner_add_button' type="button" class="btn" value="确认添加"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>