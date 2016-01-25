<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="/static/admin/css/style.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="/static/admin/js/jquery.js"></script>

        <script type="text/javascript">
            $(function() {
                //导航切换
                $(".menuson li").click(function() {
                    $(".menuson li.active").removeClass("active")
                    $(this).addClass("active");
                });

                $('.title').click(function() {
                    var $ul = $(this).next('ul');
                    $('dd').find('ul').slideUp();
                    if ($ul.is(':visible')) {
                        $(this).next('ul').slideUp();
                    } else {
                        $(this).next('ul').slideDown();
                    }
                });
            })
        </script>
    </head>
    <body style="background:#f0f9fd;">
        <div class="lefttop"><span></span>菜单列表</div>
        <dl class="leftmenu">
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <?php if (isset($userinfo->user_power)): ?>
                        <?php if (in_array($value->id, explode(',', $userinfo->user_power))): ?>
                            <dd>
                                <div class="title">
                                    <span><img src="/static/admin/images/leftico0<?php echo ($key % 4) + 1; ?>.png" /></span><?php echo $value->title ?>
                                </div>
                                <ul class="menuson">
                                    <?php if (!empty($value->second)): ?>
                                        <?php foreach ($value->second as $second_key => $second_value): ?>
                                            <?php if (in_array($second_value->id, explode(',', $userinfo->user_power))): ?>
                                                <li <?php if ($second_value->actions == 'main' && $second_value->controllers == 'admin_index'): ?> class="active"<?php endif; ?>><cite></cite><a href="<?php echo base_url($second_value->controllers . '/' . $second_value->actions); ?>" target="rightFrame"><?php echo $second_value->title ?></a><i></i></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                </ul>    
                            </dd>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </dl>
    </body>
</html>
