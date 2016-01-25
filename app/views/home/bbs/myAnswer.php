<div class="sq_mn f-fl">
    <div class="sq_mq_mn_tt bg_ff">
        <h2>我的回答</h2>
    </div>
    <div class="sq_mq_mn_cont">
        <?php if (!empty($list)): ?>
            <?php foreach ($list as $key => $value): ?>
                <div class="sq_mq_item bg_ff">
                    <div class="sq_mq_item_answer f-fl">
                        <p><strong style="color:#f1070a;"><?php echo $value->assist; ?></strong></p>
                        <p>点赞</p>
                    </div>
                    <div class="sq_mq_item_tt f-fl">
                        <p><a href="<?php echo base_url('bbs/questionDetial') . '/' . $value->qid; ?>"><?php echo $value->qtitle; ?></a></p>
                        <p style="color:#909090;"><?php echo $value->content; ?></p>
                    </div>
                    <div class="sq_mq_item_time f-fr">
                        <p><?php echo date('Y-m-d H:i:s', $value->create_time); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="sq_mq_mn_pager bg_ff">
        <?php echo $page_url; ?>
    </div>
</div>