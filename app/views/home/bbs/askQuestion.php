<!--下面是主要内容-->
<div class="sq_mn f-fl">
    <div class="sq_mn_tt"><h2>发起问题</h2></div>
    <div class="sq_news_cont bg_ff">
        <form style="width:620px;padding-top: 50px;" id="ask_form">
            <p class="sq_ask_tt">请输入问题标题 :</p>
            <input name="title" type="text" placeholder="列如：等额本息还款法与等额本金还款法有什么区别和联系？(20字以内)" class="sq_ask_ipt" onFocus="this.style.color = '#000';" onBlur="this.style.color = '#b5b5b5';"/>
            <p class="sq_ask_tt">请输入问题描述 :</p>
            <textarea name="description" class="sq_answer_ta" placeholder="请输入问题的详细描述." onFocus="this.style.color = '#000';" onBlur="this.style.color = '#b5b5b5';" cols="100" rows="4"></textarea>
            <a href="#" class="sq_ask_btn f-fr" id="ask_button">提交问题</a>  
        </form> 
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/jquery.artDialog.js?skin=twitter">
</script>
<script type="text/javascript">
    $(function() {
        $('#ask_button').click(function() {
            $.ajax({
                type: "POST",
                url: "/bbs/saveAskQuestion/" + Math.random(),
                data: $('#ask_form').serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.flag == 0) {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data.error,
                            time: 3,
                            width: 500
                        });
                    } else {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: data.error,
                            time: 3,
                            width: 500
                        });
                        location.href = '/bbs/question'
                    }
                }
            });
        });
    });
</script>