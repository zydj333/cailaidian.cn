<div class="sq_mn f-fl">
    <div class="sq_cqd_hd bg_ff">
        <h2 class="sq_cqd_hd_tt"><?php echo $question->title; ?></h2>
        <div class="sq_cqd_hd_tt_son"><?php echo $question->questions; ?></div>
        <div class="sq_cqd_hd_tt_son">
            <p style="border-right:1px solid #909090;">提问者 : <span><?php echo $question->user_name; ?></span></p>
            <p style="border-right:1px solid #909090;"><span><?php echo $question->views; ?></span>浏览</p>
            <p><?php echo date('Y-m-d H:i:s', $question->create_time); ?></p>
        </div>
        <a href="javascript:;" class="sq_cqd_hd_btn f-fr">我要回答</a>
        <div class="sq_cqd_wrap" style="display:none;">
            <textarea class="sq_cqd_ta" id="answerContent"></textarea>
            <div>
                <a href="javascript:;" class="sq_cqd_btn btn_cancel">取消回答</a>
                <a href="javascript:;" class="sq_cqd_btn" onclick="return saveAnswer(<?php echo $question->id; ?>)">提交答案</a>
            </div>
        </div>
    </div>
    <div class="sq_cqd_cont bg_ff">
        <div class="sq_cqd_cont_tt"><?php echo count($repay);?>个回答</div>
        <?php if (!empty($repay)): ?>
            <?php foreach ($repay as $key => $value): ?>
                <div class="sq_cqd_cont_item">
                    <img src="<?php echo base_url().$value->head_ico; ?>" class="sq_cqd_item_uhead" alt="" onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/lcmx_user_head_03.png'"/>
                    <div class="sq_cqd_cont_item_tt">
                        <div class="f-fl">
                            <p class="f-fl mr24" style="background:url(<?php echo base_url(); ?>static/home/image/sq_cqd_name_bg.png) left no-repeat;padding-left:30px;"><a href="<?php echo base_url('star/starList').'/'.$value->user_id;?>" style="color:#909090;"><?php echo substr_replace($value->phone, '****', 3,4); ?></a></p>
                            <p class="f-fl"><a href="<?php echo base_url('star/starList').'/'.$value->user_id;?>" style="color:#3ccafb;"><?php echo $value->username; ?></a></p>
                        </div>
                        <div class="f-fr"><?php echo date('Y-m-d H:i:s',$value->create_time);?></div>
                    </div>
                    <div class="sq_cqd_cont_item_cont">
                        <p><?php echo str_replace("\n", "<br/>", $value->content); ?></p>
                    </div>
                    <div class="sq_cqd_cont_item_ft">
                        <a href="javascript:void(0);" class="sq_cqd_cont_item_ft_btn">QQ联系</a>
                        <a class="sq_cqd_cont_item_ft_zan" onclick="return addAssist(<?php echo $value->id;?>);"><?php echo $value->assist; ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/jquery.artDialog.js?skin=twitter">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("a.sq_cqd_hd_btn").click(function() {
            $("div.sq_cqd_wrap").show();
        });
        $("a.btn_cancel").click(function() {
            $("div.sq_cqd_wrap").hide();
        });
    });

    $(document).ready(function() {
        $("a.sq_cqd_revise_btn").click(function() {
            $("div.sq_cqd_revise_wrap").show();
        });
        $("a.sq_cqd_cancel_revise_btn").click(function() {
            $("div.sq_cqd_revise_wrap").hide();
        });
    });


    //保存回答
    function saveAnswer(q_id) {
        var text = $("#answerContent").val();
        $.ajax({
            type: "POST",
            url: "/bbs/saveAnswer/" + Math.random(),
            data: {'q_id': q_id, 'content': text},
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
                    location.href = '/bbs/questionDetial/' + q_id;
                }
            }
        });
    }
    //答案支持
    function addAssist(aid){
        $.ajax({
            type: "POST",
            url: "/bbs/saveAssist/" + Math.random(),
            data: {'aid': aid},
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
                    location.href = '/bbs/questionDetial/' + q_id;
                }
            }
        });
    }
</script>