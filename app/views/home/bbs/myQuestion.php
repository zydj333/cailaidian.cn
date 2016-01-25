<div class="sq_mn f-fl">
    <div class="sq_mq_mn_tt bg_ff">
        <h2>我的提问</h2>
    </div>
    <div class="sq_mq_mn_cont">
        <?php if (!empty($list)): ?>
            <?php foreach ($list as $key => $value): ?>
                <div class="sq_mq_item bg_ff">
                    <div class="sq_mq_item_answer f-fl">
                        <p><strong style="color:#f1070a;"><?php echo $value->repaynums; ?></strong></p>
                        <p>回答</p>
                    </div>
                    <div class="sq_mq_item_tt f-fl">
                        <p><a href="<?php echo base_url('bbs/questionDetial') . '/' . $value->id; ?>"><?php echo $value->title; ?></a></p>
                        <p style="color:#909090;"><span><?php echo $value->views; ?></span>浏览</p>
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