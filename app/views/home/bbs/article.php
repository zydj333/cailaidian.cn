<div class="sq_mn f-fl">
    <div class="sq_mn_tt"><h2>金融资讯</h2></div>
    <?php if (!empty($list)): ?>
        <?php foreach ($list as $key => $value): ?>
            <div class="sq_news_cont bg_ff">
                <div class="sq_news_item" <?php if ($key == 3): ?>style="margin:0;<?php endif; ?>">
                    <div class="sq_news_item_tt">
                        <a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>" target="_blank" title="<?php echo $value->title; ?>"><?php echo $value->title; ?></a>
                    </div>
                    <div class="sq_news_item_detail">
                        <div class="sq_news_item_img f-fl">
                            <a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>" target="_blank" title="<?php echo $value->title; ?>"><img width="378px" height="248px" src="<?php echo base_url() . $value->imageurl; ?>"  onerror="this.onerror='';this.src='<?php echo base_url(); ?>static/home/image/sq_news_pic_18.png'" title="<?php echo $value->title; ?>" alt="<?php echo $value->title; ?>"/></a>
                        </div>
                        <div class="sq_news_item_cont f-fl">
                            <div class="sq_news_item_cont_hd">
                                <span class="f-fl" style="color:#3ccafb;">财来电资讯</span>
                                <p class="sq_news_item_cont_date"><?php echo date('Y年m月d日', strtotime($value->article_time)) ?></p>
                                <p class="sq_news_item_cont_read"><?php echo $value->views; ?></p>
                                <a href="javascript:void(0);" class="sq_news_item_cont_btn1">微信</a>
                                <a href="javascript:void(0);" class="sq_news_item_cont_btn2">QQ</a>
                            </div>
                            <p class="sq_news_item_txt cb"><?php echo $value->discription; ?></p>
                            <a href="<?php echo base_url('bbs/articleDetial') . '/' . $value->id; ?>" class="db f-fr fs14" style="color:#3ccafb;" target="_blank" title="<?php echo $value->title; ?>">查看全文＞＞</a>
                        </div>
                        <div class="cb"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="sq_news_pager bg_ff">
        <?php echo $page_url; ?>
    </div>
</div>
