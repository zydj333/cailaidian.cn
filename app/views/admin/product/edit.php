<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="<?php echo base_url(); ?>static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>static/admin/css/select.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/select-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/ajaxfileupload.js"></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/kindeditor-min.js'></script>
        <script type='text/javascript'  src='<?php echo base_url(); ?>kindeditor/lang/zh_CN.js'></script>
    </head>
    <body>
        <div class="formbody">
            <div class="formtitle"><span>产品信息添加</span></div>
            <form action="/admin_product/edit" method="post" id='product_edit_form'>
                <ul class="forminfo">
                    <input name="product_id" type="hidden" value="<?php echo $product->id;?>" />
                    <li><label>产品名称</label><input name="product_name" type="text" class="dfinput" value="<?php echo $product->product_name;?>" maxlength="50"  style="width: 400px" /><i>填写产品名称（长度不超过50个字符）</i></li>
                    <li>
                        <label>封面图片</label>
                            <div class="vocation">
                                <input name="fileToUpload" id="imageToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                                <input name="image_add" type="button" onclick="return ajaxFileUpload();" class="btn" value="上传"/>
                                <a href="<?php echo base_url().$product->image;?>" target="_blank" id="imgshow"><p id="upload_img"><img src="<?php echo base_url().$product->image;?>" width="50" height="30" /></p></a>
                                <img id="loading" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                                <input type="hidden" name="image" id="product_image" value="<?php echo $product->image;?>" />
                            </div>
                    </li>
                    <li></li>
                    <li><label>产品系列</label>
                        <div class="vocation">
                            <select class="select1" name="category">
                                <?php foreach ($category as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>" <?php if($product->category==$v->id):?>selected="selected"<?php endif;?>><?php echo $v->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>请选择产品的系列</i>
                    </li>
                     <li><label>期限区间</label>
                        <div class="vocation">
                            <select class="select1" name="month_area">
                                <?php foreach ($deadline as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->month_area==$k):?>selected="selected"<?php endif;?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择该产品期限所在的区间</i>
                    </li>
                    <li><label>产品期限</label><input name="month" type="number" class="dfinput"  value="<?php echo $product->month;?>" style="width: 100px"/><i>填写产品期限，此处只需要填写数字，以月为单位。</i></li>
                    <li><label>发行费用区间</label>
                        <div class="vocation">
                            <select class="select1" name="fee_area">
                                <?php foreach ($issucost as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->fee_area==$k):?>selected="selected"<?php endif;?> ><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择产品的发行费用所在区间</i>
                    </li>
                    <li><label>发行费用</label><input name="fee" type="text" class="dfinput"  value="<?php echo $product->fee;?>" style="width: 400px" /><i>填写实际发行费用</i></li>
                    <li><label>收益率区间</label>
                        <div class="vocation">
                            <select class="select1" name="interest_area">
                                <?php foreach ($interest as $k => $v): ?>
                                <option value="<?php echo $k; ?>" <?php if($product->interest_area==$k):?>selected="selected"<?php endif;?> ><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择产品的收益率区间</i>
                    </li>
                    <li><label>收益类型</label>
                        <div class="vocation">
                            <select class="select1" name="earning">
                                <?php foreach ($earning as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->earning==$k):?>selected="selected"<?php endif;?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择产品的收益率区间</i>
                    </li>
                    <li><label>所在省份</label>
                        <div class="vocation">
                            <select class="select1" name="province" onchange="return getCity(this.value);">
                                <option value="0">-请选择省份-</option>
                                <?php if(!empty($province)): ?>
                                <?php foreach ($province as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>" <?php if($product->province==$v->id):?>selected="selected"<?php endif;?>><?php echo $v->name; ?></option>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </select>
                        </div><i>选择产品的所在区域</i>
                    </li>
                    <li><label>所在城市</label>
                        <div class="vocation">
                            <select class="select1" name="city" id="city">
                                   <option value="0">-请选择省份-</option>
                                    <?php if(!empty($city)): ?>
                                <?php foreach ($city as $k => $v): ?>
                                    <option value="<?php echo $v->id; ?>" <?php if($product->city==$v->id):?>selected="selected"<?php endif;?>><?php echo $v->name; ?></option>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </select>
                        </div><i>选择产品的所在区域</i>
                    </li>
                    <li><label>投资领域</label>
                        <div class="vocation">
                            <select class="select1" name="tender_area">
                                <?php foreach ($area as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->tender_area==$k):?>selected="selected"<?php endif;?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>请选择产品的投资领域</i>
                    </li>
                    <li><label>付息方式</label>
                        <div class="vocation">
                            <select class="select1" name="pay_way">
                                <?php foreach ($payway as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->pay_way==$k):?>selected="selected"<?php endif;?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择产品的付息方式</i>
                    </li>
                    <li><label>大小配比</label>
                        <div class="vocation">
                            <select class="select1" name="comparison">
                                <?php foreach ($comparison as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->comparison==$k):?>selected="selected"<?php endif;?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择产品的大小配比</i>
                    </li>
                    <li><label>项目评级</label>
                        <div class="vocation">
                            <select class="select1" name="level">
                                <?php foreach ($level as $k => $v): ?>
                                    <option value="<?php echo $k; ?>" <?php if($product->level==$k):?>selected="selected"<?php endif;?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><i>选择产品的项目评级</i>
                    </li>
                    <li><label>进度条设置</label><input name="progress" type="text" class="dfinput"  value="<?php echo $product->progress;?>" style="width: 100px"/><i>填写项目完成进度，只能是1-100的任意数字，可以为小数.</i></li>
                    <li><label>最新进度</label><input name="support_log" type="text" class="dfinput"  value="<?php echo $product->support_log;?>" style="width: 400px"/><i>填写最新的募资记录</i></li>
                    <li><label>开始日期</label><input name="start" type="text" class="dfinput" value="<?php echo date('Y-m-d',$product->start);?>"  style="width: 250px" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" /><i>项目起始投资日期</i></li>
                    <li><label>发行机构</label><input name="company" type="text" class="dfinput"  value="<?php echo $product->company;?>" maxlength="50"  style="width: 400px" /><i>填写产品发行机构（长度不超过30个字符）</i></li>
                    <li><label>产品总金额</label><input name="amount" type="number" class="dfinput"  value="<?php echo $product->amount;?>" style="width: 200px"/><i>填写产品的总金额（规模），以万为单位，此处只填写数字</i></li>
                    <li><label>投资门槛</label><input name="support_limit" type="number" class="dfinput"  value="<?php echo $product->support_limit;?>" style="width: 100px"/><i>填写投资门槛，以万为单位，只填写数字</i></li>
                    <li><label>融资主体</label><input name="mainpart" type="text" class="dfinput"  value="<?php echo $product->mainpart;?>" style="width: 400px"/><i>填写募资主体公司名称</i></li>
                    <li><label>抵押率</label><input name="mortgage" type="text" class="dfinput"  value="<?php echo $product->mortgage;?>" style="width: 100px"/><i>填写产品的抵押率，只能是1-100的任意数字，可以为小数.</i></li>
                    <li><label>募资帐号</label><textarea class="textinput" name="account" cols="150" rows="3"><?php echo $product->account;?></textarea><i>幕资帐号---银行账户信息</i></li>
                    <li><label>资金用途</label><textarea class="textinput" name="use_for" cols="150" rows="3"><?php echo $product->use_for;?></textarea><i>融资后用作何处</i></li>
                    <li><label>还款来源</label><textarea class="textinput" name="repayment_from" cols="150" rows="3"><?php echo $product->repayment_from;?></textarea><i>到期还款的资金来源</i></li>
                    <li><label>风控措施</label><textarea class="textinput" name="risk_control" cols="150" rows="3"><?php echo $product->risk_control;?></textarea><i>该项目有何风控措施</i></li>
                    <li><label>项目亮点</label><textarea class="textinput" name="highlights" cols="150" rows="3"><?php echo $product->highlights;?></textarea><i>此项目有不有什么值得宣扬的地方</i></li>
                    <li>
                        <label>资料下载</label>
                        <div class="vocation">
                                <input name="fileToUpload" id="fileToUpload" type="file" class="dfinput" value=""  style="width:150px;"/>
                                <input name="file_add" type="button" id="" onclick="return ajaxFileUpload_file();" class="btn" value="上传"/>
                                <img id="loading_file" src="<?php echo base_url(); ?>static/admin/images/loading.gif" style="display:none;" />
                                <input type="hidden" name="download_file" id="download_file" value="<?php echo $product->download_file; ?>" />
                                <p style="color: red;">当前文件地址: <a href="<?php echo base_url().$product->download_file; ?>" target="_blank"><?php echo base_url().$product->download_file; ?></a></p>
                      </div>
                        <i>上传产品附件，（只能上次压缩文件包，格式rar，tar，zip，7z类型的压缩文件）
                    </li>
                    <li></li>
                    <li><label>简要描述</label><textarea class="textinput" name="discription" id="discription" cols="150" rows="3"><?php echo $product->discription;?></textarea><i>项目简要描述</i></li>
                    <li><label>详细信息</label><textarea class="" name="content" id="content" style="width:700px;height:300px;"><?php echo $product->content;?></textarea></li>
                    <li><label>优化标题</label><input name="seo_title" type="text" class="dfinput" value="<?php echo $product->seo_title;?>" style="width: 400px"/><i>SEO标题</i></li>
                    <li><label>优化关键字</label><input name="seo_keyword" type="text" class="dfinput" value="<?php echo $product->seo_keyword;?>" style="width: 700px"/><i>SEO关键字</i></li>
                    <li><label>优化描述</label><textarea class="textinput" name="seo_description" id="seo_description" cols="150" rows="3"><?php echo $product->seo_description;?></textarea><i>SEO描述</i></li>
                    <li><label>产品状态</label><cite><input type="radio" value="1" <?php if($product->status==1):?>checked="checked"<?php endif;?> name="status">预热  <input type="radio" <?php if($product->status==2):?>checked="checked"<?php endif;?> value="2" name="status">募资中  <input type="radio" <?php if($product->status==3):?>checked="checked"<?php endif;?> value="3" name="status">结束</cite></li>
                    <li><label>是否推荐</label><cite><input type="radio" value="1" <?php if($product->is_recommen==1):?>checked="checked"<?php endif;?>  name="is_recommen">推荐  <input type="radio" value="2" <?php if($product->is_recommen==2):?>checked="checked"<?php endif;?> name="is_recommen">不推荐</cite></li>
                    <li><label>是否上架</label><cite><input type="radio" value="1"  <?php if($product->is_show==1):?>checked="checked"<?php endif;?> name="is_show">上架  <input type="radio" value="2" <?php if($product->is_show==2):?>checked="checked"<?php endif;?> name="is_show">不上架</cite></li>   
                    <li><label>项目排序</label><input name="listorder" type="number" class="dfinput" value="<?php echo $product->listorder;?>"  style="width: 100px"/><i>填写一个整数作为排序</i></li>                                
                    <li></li>                 
                    <li><label>&nbsp;</label><input id='product_edit_button' type="button" class="btn" value="确认保存"/></li>
                </ul>
            </form>
        </div>
        <div style="padding-bottom: 150px;"></div>
    </body>
 </html>
<script type="text/javascript" src="/static/admin/js/jquery.artDialog.js?skin=blue"></script>
<script type="text/javascript">
      
    KindEditor.ready(function (K) {
        window.editor = K.create('#content');
    });
    
    $(document).ready(function(e) {
        $(".select1").uedSelect({
            width: 250
        });
        
        $("#product_edit_button").click(function(){
            editor.sync();
            $.ajax({
                type: "POST",
                url: "/admin_product/checkInfo/"+Math.random(),
                data: $("#product_edit_form").serialize(),
                dataType:"json",
                success: function(data){
                    if(data.flag==0){
                        art.dialog(data.error);
                    }else{
                        art.dialog(data.error);
                        $("#product_edit_form").submit();
                    }
                }
            });
        });
    });
    function getCity(pid){
      $.ajax({
                type: "POST",
                url: "/admin_common/getCity/"+Math.random(),
                data: {'pid':pid},
                dataType:"json",
                success: function(data){
                    var str='<option value="0">-请选择-</option>';
                    if(data.flag==0){
                        str+='<option value="0">'+data.error+'</option>';
                    }else{
                         $.each(data.error, function(key, values) {
                              str+='<option value="'+values.id+'">'+values.name+'</option>';
                         });
                    }
                    $('#city').html(str);
                }
            });
  }
    
    function ajaxFileUpload(){
                $("#loading").show();
                $.ajaxFileUpload({
                    url:'/admin_image/upload',
                    secureuri:false,
                    fileElementId:'imageToUpload',
                    dataType: 'json',
                    data:{imagetype:'product'},
                    success: function (data, status)
                    {
                        $("#loading").hide();
                        if(data.flag==0){
                            art.dialog(data.error);
                        }else{
                            var temp = '<img src="/'+data.imgurl_thumb+'" width="50" height="30" />';
                            $('#upload_img').html(temp);
                            $('#product_image').val(data.imgurl);
                            $('#imgshow').attr('href','/'+data.imgurl);
                        }
                    },
                    error: function (data, status, e){
                        art.dialog(e);
                        $("#loading").hide();
                    }
                });
                return false;
            }
            
            function ajaxFileUpload_file(){
                $("#loading_file").show();
                $.ajaxFileUpload({
                    url:'/admin_image/upload_file',
                    secureuri:false,
                    fileElementId:'fileToUpload',
                    dataType: 'json',
                    data:{imagetype:'file'},
                    success: function (data, status)
                    {
                        $("#loading_file").hide();
                        if(data.flag==0){
                            art.dialog(data.error);
                        }else{
                            art.dialog(data.error);
                            $('#download_file').val(data.imgurl);
                        }
                    },
                    error: function (data, status, e)
                    {
                        art.dialog(e);
                        $("#loading_file").hide();
                    }
                });
                return false;
            }
</script>