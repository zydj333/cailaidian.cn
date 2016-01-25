<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/select-ui.min.js"></script>
        <link href="/static/admin/css/select.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='/kindeditor/kindeditor-min.js'></script>
        <script type='text/javascript' src='/kindeditor/lang/zh_CN.js'></script>
        <script type='text/javascript' src="/static/admin/js/ajaxfileupload.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $(".select1").uedSelect({
                    width: 345
                });

                KindEditor.ready(function(K) {
                    window.editor = K.create('#editor_id');
                });  
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
                                        data: {imagetype: 'new'},
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
            <div class="formtitle"><span>添加资讯</span></div>
            <form action="/admin_new/add" method="post" id='new_add_form'>
                <ul class="forminfo">
                    <li>
                        <label>资讯类别</label>
                        <div class="vocation">
                            <select name="ac_id" class="select1">
                                <option value="">请选择类别</option>
                                <?php if (!empty($category)): ?>
                                    <?php foreach ($category as $k => $v) : ?>
                                        <option value="<?php echo $v->ac_id ?>"><?php echo $v->name ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <i>不能为空</i>
                    </li>
                    <li><label>资讯标题</label><input name="title" type="text" class="dfinput" maxlength="30" /><i>不能为空</i></li>
                    <li><label>资讯描述</label><input name="discription" type="text" class="dfinput" /><i>不能为空</i></li>
                    <li><label>查询别名</label><input name="search_name" type="text" class="dfinput" maxlength="20" /></li>
                    <li><label>优化标题</label><input name="seo_title" type="text" class="dfinput" maxlength="30" /></li>
                    <li><label>优化关键字</label><input name="seo_keyword" type="text" class="dfinput" maxlength="20" /></li>
                    <li><label>优化描述</label><input name="seo_discription" type="text" class="dfinput" /></li>
                    <li><label>浏览量</label><input name="views" type="text" class="dfinput" /><i>请输入正整数</i></li>
                    <li><label>回复数</label><input name="replay" type="text" class="dfinput" /><i>请输入正整数</i></li>
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
                    <li><label>资讯内容</label><textarea name="content" id="editor_id" cols="" rows="" style="width:700px;height:300px;" ></textarea><i>请输入内容</i></li>
                    <li><label>&nbsp;</label><input name="new_add_button" id='new_add_button' type="submit" class="btn" value="确认增加"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>


