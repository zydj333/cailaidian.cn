<div class="sq_mn f-fl"  id="tabbox">
    <div class="sq_quest_hd bg_ff">
        <ul id="tabs2">
            <li>最新问答</li>
            <li>热点讨论</li>
        </ul>
    </div>
    <div class="sq_quest_cont" id="tab_conbox2">
        <div class="hide" style="display:block;">  <!--注意'问答'的item要加在这个div下面-->
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <div class="sq_quest_item bg_ff">
                        <div class="sq_quest_item_read f-fl">
                            <p><strong style="color:#f1070a;"><?php echo $value->views; ?></strong></p>
                            <p>浏览</p>
                        </div>
                        <div class="sq_quest_item_tt f-fl">
                            <p><a href="<?php echo base_url('bbs/questionDetial') . '/' . $value->id; ?>" title="<?php echo $value->title; ?>"><?php echo $value->title; ?></a></p>
                            <p style="color:#909090;"><span><?php echo date('Y-m-d H:i:s', $value->updatetime); ?></span>添加了答案&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $value->repaynums; ?></span>个回答</p>
                        </div>
                        <a href="javascript:;" class="sq_quest_item_btn">回答问题</a>
                        <div class="sq_quest_wrap" style="display:none;" id="is_show_<?php echo $value->id; ?>">
                            <textarea class="sq_answer_ta" id="textArea_<?php echo $value->id; ?>"></textarea>
                            <div>
                                <a href="javascript:void(0);" class="sq_answer_btn btn_cancel">取消回答</a>
                                <a href="javascript:void(0);" class="sq_answer_btn " onclick="return saveAnswer(<?php echo $value->id; ?>);">提交答案</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="sq_quest_pager bg_ff">
                <?php echo $page_url; ?>
            </div>
        </div>
        <div class="hide" style="display:none;"> <!--注意'讨论'的item要加在这个div下面-->
            <?php if (!empty($hotlist)): ?>
                <?php foreach ($hotlist as $key => $value): ?>
                    <div class="sq_quest_item bg_ff">
                        <div class="sq_quest_item_read f-fl">
                            <p><strong style="color:#f1070a;"><?php echo $value->views; ?></strong></p>
                            <p>浏览</p>
                        </div>
                        <div class="sq_quest_item_tt f-fl">
                            <p><a href="<?php echo base_url('bbs/questionDetial') . '/' . $value->id; ?>"><?php echo $value->title; ?></a></p>
                            <p style="color:#909090;"><span><?php echo date('Y-m-d H:i:s', $value->updatetime); ?></span>添加了答案&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $value->repaynums; ?></span>个回答</p>
                        </div>
                        <a href="javascript:;" class="sq_quest_item_btn">回答问题</a>
                        <div class="sq_quest_wrap" style="display:none;" id="hot_is_show_<?php echo $value->id; ?>">
                            <textarea class="sq_answer_ta" id="hot_textArea_<?php echo $value->id; ?>"></textarea>
                            <div>
                                <a href="javascript:void(0);" class="sq_answer_btn btn_cancel">取消回答</a>
                                <a href="javascript:void(0);" class="sq_answer_btn " onclick="return saveHotAnswer(<?php echo $value->id; ?>);">提交答案</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="sq_quest_pager bg_ff">
                <?php echo $page_url; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>static/admin/js/jquery.artDialog.js?skin=twitter">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.sq_quest_item').each(function() {
            var pubItem = $(this);
            var btn_answer_now = pubItem.find('.sq_quest_item_btn');
            var pub_reply = pubItem.find('.sq_quest_wrap');
            var btn_cancel = pub_reply.find('.btn_cancel');

            btn_answer_now.click(function() {
                var $this = $(this);
                var $answered = $this.attr("data-answered");
                $('.sq_quest_wrap').hide();
                $('.sq_quest_item').removeClass("pub_item_active");
                if ($answered > 0) {
                    pub_replied.show();
                    if ($this.html() == '取消回答') {
                        $this.html('快速回答');
                    } else {
                        $this.html('取消回答');
                    }
                } else {
                    pubItem.addClass('pub_item_active');
                    pub_reply.show();
                }

            });
            btn_cancel.click(function() {
                pub_reply.hide();
                pubItem.removeClass('pub_item_active');
            });
        });
    });

    //保存回答
    function saveAnswer(q_id) {
        var text = $("#textArea_" + q_id).val();
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
                    $("#textArea_" + q_id).val('');
                    $("#is_show_" + q_id).hide();
                }
            }
        });
    }
     //保存热门回答
    function saveHotAnswer(q_id) {
        var text = $("#hot_textArea_" + q_id).val();
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
                    $("#hot_textArea_" + q_id).val('');
                    $("#hot_is_show_" + q_id).hide();
                }
            }
        });
    }
</script>
