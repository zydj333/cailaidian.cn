<div class="sq_mn f-fl">
    <div class="sq_news_d_hd">
        <div class="sq_news_d_class f-fl">资讯</div>
        <div class="sq_news_d_read f-fr"><?php echo $news->views; ?></div>
        <div class="sq_news_d_tt"><?php echo $news->title; ?></div>
        <div class="cb"></div>
    </div>
    <div class="sq_news_d_cont bg_ff">
        <div class="sq_news_d_time">
            <p>财来电资讯</p>发布时间：<span><?php echo date('Y年m月d日', strtotime($news->article_time)); ?></span>
        </div>
        <div class="sq_news_d_text">
            <?php echo $news->content; ?>
            <strong style="display:block;margin-top:40px;">更多精彩的理财师资讯，敬请关注<a href="<?php echo base_url();?>" class="c_f1070a">财来电</a>！</strong>
        </div>
        <div class="sq_news_d_share">
            <div class="bdsharebuttonbox">
                <a href="#" class="bds_more" data-cmd="more"></a>
                <a href="#" class="bds_qzone" data-cmd="qzone"></a>
                <a href="#" class="bds_tsina" data-cmd="tsina"></a>
                <a href="#" class="bds_tqq" data-cmd="tqq"></a>
                <a href="#" class="bds_renren" data-cmd="renren"></a>
                <a href="#" class="bds_weixin" data-cmd="weixin"></a>
            </div>
            <script>window._bd_share_config = {"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdPic": "", "bdStyle": "0", "bdSize": "16"}, "share": {}, "image": {"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"], "viewText": "分享到：", "viewSize": "16"}, "selectShare": {"bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]}};
                with (document)
                    0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
            </script>
        </div>
        <div class="sq_news_d_ad c_f1070a fs14">
            <p>财来电（www.cailaidian.cn），是一家全面以互联网及移动互联网为导向的创新型第三方财富管理机构，定位于“理财师的一站式服务平台”，于2014年在杭州创立，财来电的战略体系为“一个定位+六大策略”，定位于打造中国最广大理财师的一站式B2B服务平台，通过六大策略满足理财师六大需求，即产品丰富、风控可靠、佣金给力、运营高效、增值服务、现结之王。</p>
        </div>
    </div>
</div>