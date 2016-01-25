<div class="formbody">
    <div class="formtitle"><span>修改友链</span></div>
    <form action="" method="post" id='link_edit_form'>
        <ul class="forminfo">
            <input name="id" value="<?php echo $link->id; ?>" type="hidden"/>
                    <li><label>标题</label><input name="title" type="text" class="dfinput" maxlength="30" value="<?php echo $link->title ?>"/></li>
                    <li><label>网站链接</label><input name="url" type="text" class="dfinput" value="<?php echo $link->url ?>"/></li>
                    <input name="imageurl" type="hidden" class="dfinput" value="<?php echo $link->imageurl ?>"/>
                    <li><label>更改图片</label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload();" class="btn" value="更改图片"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                            <input type="hidden" name="imageurl" id="coverimage" value="<?php echo $link->imageurl ?>" />
                            <input type="hidden" name="imageid" id="coverimageid" value="" />
                        </div>
                    </li>
                    <li><img src="<?php echo base_url().'/'.$link->imageurl ?>" /></li>
                    <li><label>排序</label><input name="listorder" type="text" class="dfinput" value="<?php echo $link->listorder ?>"/></li>
                    <li><label>&nbsp;</label><input id='link_edit_button' type="button" class="btn" value="确认修改"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript" src="/static/admin/js/ajaxfileupload.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#link_edit_button").click(function() {
            $.ajax({
                type: "POST",
                url: "/admin_link/edit/" + Math.random(),
                data: $("#link_edit_form").serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        $.dialog(data.error);
                    } else {
                        $.dialog(data.error);
                        location.href = "/admin_link/index";
                    }
                }
            });
        });  
    });
    
    function ajaxFileUpload() {
                $("#loading")
                        .ajaxStart(function () {
                            $(this).show();
                        })
                        .ajaxComplete(function () {
                            $(this).hide();
                        });
                $.ajaxFileUpload
                        (
                                {
                                    url: '/admin_image/upload',
                                    secureuri: false,
                                    fileElementId: 'fileToUpload',
                                    dataType: 'json',
                                    data: {imagetype: 'link'},
                                    success: function (data, status)
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
                                    error: function (data, status, e)
                                    {
                                        alert(e);
                                    }
                                }
                        )
                return false;
            }
</script>