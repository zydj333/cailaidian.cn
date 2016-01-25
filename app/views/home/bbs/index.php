

        <div class="sq_mn f-fl">
            <div class="sq_mn_tt"><h2>论坛分类</h2></div>
            <div class="sq_mn_cont bg_ff">
                <h4>金融资讯</h4>
                <div class="sq_mn_item">
                    <div class="sq_mn_item_img f-fl"><a href="<?php echo base_url('bbs/article');?>"><img src="<?php echo base_url(); ?>static/home/image/sq_home_pic_03.png"/></a></div>
                    <?php if (!empty($jinrong)): ?>
                        <?php foreach ($jinrong as $key => $value): ?>
                            <?php if ($key == 0 || $key == 7): ?>
                                <div class="sq_mn_item_list f-fl" <?php if ($key == 0): ?>style="border-right:1px dashed #e0e0e0;"<?php endif; ?>>
                                    <ul>
                                    <?php endif; ?>
                                    <li><a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>"  target="_blank"><?php echo $value->title; ?></a></li>
                                    <?php if ($key == 6 || ($key + 1 == $jinrong_count)): ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="sq_mn_cont bg_ff">
                <h4>理财问答</h4>
                <div class="sq_mn_item">
                    <div class="sq_mn_item_img f-fl"><a href="<?php echo base_url('bbs/question');?>"><img src="<?php echo base_url(); ?>static/home/image/sq_home_pic_06.png"/></a></div>
                    <?php if (!empty($question)): ?>
                        <?php foreach ($question as $key => $value): ?>
                            <?php if ($key == 0 || $key == 7): ?>
                                <div class="sq_mn_item_list f-fl" <?php if ($key == 0): ?>style="border-right:1px dashed #e0e0e0;"<?php endif; ?>>
                                    <ul>
                                    <?php endif; ?>
                                    <li><a href="<?php echo base_url('bbs/questionDetial') . '/' . $value->id; ?>"  target="_blank"><?php echo $value->title; ?></a></li>
                                    <?php if ($key == 6 || ($key + 1 == $question_count)): ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="sq_mn_cont bg_ff">
                <h4>热点新闻</h4>
                <div class="sq_mn_item">
                    <div class="sq_mn_item_img f-fl"><a href="<?php echo base_url('bbs/article');?>"><img src="<?php echo base_url(); ?>static/home/image/sq_home_pic_08.png"/></a></div>
                    <?php if (!empty($hotnew)): ?>
                        <?php foreach ($hotnew as $key => $value): ?>
                            <?php if ($key == 0 || $key == 7): ?>
                                <div class="sq_mn_item_list f-fl" <?php if ($key == 0): ?>style="border-right:1px dashed #e0e0e0;"<?php endif; ?>>
                                    <ul>
                                    <?php endif; ?>
                                    <li><a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>"  target="_blank"><?php echo $value->title; ?></a></li>
                                    <?php if ($key == 6 || ($key + 1 == $hotnew_count)): ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="cb"></div>
                </div>
            </div>
        </div>
        