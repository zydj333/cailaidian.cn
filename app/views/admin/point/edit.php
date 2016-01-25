<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="/static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="/static/admin/js/select-ui.min.js"></script>
        <link href="/static/admin/css/select.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript'  src='/kindeditor/kindeditor-min.js'></script>
        <script type='text/javascript'  src='/kindeditor/lang/zh_CN.js'></script>
        <script type="text/javascript" src="/static/admin/js/ajaxfileupload.js"></script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                $(".select1").uedSelect({
                    width: 345
                });
                KindEditor.ready(function (K) {
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
                                        data: {imagetype: 'point'},
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
                
                function ajaxFileUpload2() {
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
                                        fileElementId: 'fileToUpload2',
                                        dataType: 'json',
                                        data: {imagetype: 'point'},
                                        success: function(data, status)
                                        {
                                            if (data.flag == 0) {
                                                alert(data.error);
                                            } else {
                                                var temp = '<img src="/' + data.imgurl_thumb + '" width="50" height="30" />';
                                                $('#upload_img2').html(temp);
                                                $('#coverimage2').val(data.imgurl);
                                                $('#coverimageid2').val(data.imageid);
                                                $('#imgshow2').attr('href', '/' + data.imgurl);
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
                
                function ajaxFileUpload3() {
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
                                        fileElementId: 'fileToUpload3',
                                        dataType: 'json',
                                        data: {imagetype: 'point'},
                                        success: function(data, status)
                                        {
                                            if (data.flag == 0) {
                                                alert(data.error);
                                            } else {
                                                var temp = '<img src="/' + data.imgurl_thumb + '" width="50" height="30" />';
                                                $('#upload_img3').html(temp);
                                                $('#coverimage3').val(data.imgurl);
                                                $('#coverimageid3').val(data.imageid);
                                                $('#imgshow3').attr('href', '/' + data.imgurl);
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
                
                function ajaxFileUpload4() {
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
                                        fileElementId: 'fileToUpload4',
                                        dataType: 'json',
                                        data: {imagetype: 'point'},
                                        success: function(data, status)
                                        {
                                            if (data.flag == 0) {
                                                alert(data.error);
                                            } else {
                                                var temp = '<img src="/' + data.imgurl_thumb + '" width="50" height="30" />';
                                                $('#upload_img4').html(temp);
                                                $('#coverimage4').val(data.imgurl);
                                                $('#coverimageid4').val(data.imageid);
                                                $('#imgshow4').attr('href', '/' + data.imgurl);
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
            <div class="formtitle"><span>修改资讯</span></div>
            <form action="/admin_point/edit" method="post" id='new_edit_form' enctype="multipart/form-data">
                <ul class="forminfo">
                    <li>
                        <label>商品分类</label>
                        <div class="vocation">
                            <select name="type_id" class="select1">
                                <option value="0">请选择类别</option>
                                <?php if (!empty($category)): ?>
                                    <?php foreach ($category as $k => $v) : ?>
                                        <option value="<?php echo $v->id ?>" <?php if ($new->type_id == $v->id): ?>selected="selected"<?php endif; ?>><?php echo $v->name ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </li>
                    <input name="id" value="<?php echo $new->id; ?>" type="hidden"/>
                    <li><label>商品名称</label><input name="name" type="text" class="dfinput" maxlength="30" value="<?php echo $new->name ?>"/></li>
                    <li><label>市场价格</label><input name="price" type="text" class="dfinput" value="<?php echo $new->price ?>"/></li>
                    <li><label>所需积分</label><input name="points" type="text" class="dfinput" maxlength="20" value="<?php echo $new->points ?>"/></li>
                    <li><label>更改封面</label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload" onclick="return ajaxFileUpload();" class="btn" value="更改图片"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                            <input type="hidden" name="img" id="coverimage" value="<?php echo $new->img ?>" />
                            <input type="hidden" name="imageid" id="coverimageid" value="" />
                        </div>
                    </li>
                    <li><img style="width: 50px;height: 50px;" src="<?php echo base_url().'/'.$new->img;?>" /></li>
                    <li><label>更改滚动1</label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload2" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload2" onclick="return ajaxFileUpload2();" class="btn" value="更改图片"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img2"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                            <input type="hidden" name="img2" id="coverimage2" value="<?php echo $new->img2 ?>" />
                            <input type="hidden" name="imageid2" id="coverimageid2" value="" />
                        </div>
                    </li>
                    <li><img style="width: 50px;height: 50px;" src="<?php echo base_url().'/'.$new->img2;?>" /></li>
                    <li><label>更改滚动2</label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload3" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload3" onclick="return ajaxFileUpload3();" class="btn" value="更改图片"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img3"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                            <input type="hidden" name="img3" id="coverimage3" value="<?php echo $new->img3 ?>" />
                            <input type="hidden" name="imageid3" id="coverimageid3" value="" />
                        </div>
                    </li>
                    <li><img style="width: 50px;height: 50px;" src="<?php echo base_url().'/'.$new->img3;?>" /></li>
                    <li><label>更改滚动3</label>
                        <div class="vocation">
                            <input name="fileToUpload" id="fileToUpload4" type="file" class="dfinput" value=""  style="width:150px;"/>
                            <input name="add" type="button" id="buttonUpload4" onclick="return ajaxFileUpload4();" class="btn" value="更改图片"/>
                            <a href="" target="_blank" id="imgshow"><p id="upload_img4"></p></a>
                            <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                            <input type="hidden" name="img4" id="coverimage4" value="<?php echo $new->img4 ?>" />
                            <input type="hidden" name="imageid4" id="coverimageid4" value="" />
                        </div>
                    </li>
                    <li><img style="width: 50px;height: 50px;" src="<?php echo base_url().'/'.$new->img4;?>" /></li>
                    <li><label>内容介绍</label><textarea name="content" id="editor_id" cols="" rows="" style="width:700px;height:300px;" ><?php echo $new->content ?></textarea><i>请输入内容</i></li>
                    <li><label>&nbsp;</label><input name="new_edit_button" id='new_edit_button' type="submit" class="btn" value="确认修改"/></li>
                </ul>
            </form>
        </div>
    </body>
</html>