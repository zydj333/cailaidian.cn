<div class="xgmm_mn f-fr bg_ff">
    <div class="xgmm_mn_tt">
        <p class="f-fl" style="border-bottom:3px solid #f1070a;">修改头像</p>
        <div class="cb"></div>
    </div>
    <div class="xgmm_mn_cont">
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/swfobject.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/home/js/fullAvatarEditor.js"></script>
        <div>
            <p id="swfContainer"> </p>
        </div>
    </div>
</div>
<div class="cb"></div>
</div>
<script type="text/javascript">
    swfobject.addDomLoadEvent(function() {
        var swf = new fullAvatarEditor("swfContainer", {
            id: 'swf',
            upload_url: '/mysetting/saveavater/' + Math.random(),
            src_upload: 2
        }, function(msg) {
            switch (msg.code) {
                case 3 :
                    if (msg.type === 0)
                    {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: "摄像头已准备就绪且用户已允许使用",
                            time: 3,
                            width: 500
                        });
                    }
                    else if (msg.type === 1)
                    {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: "摄像头已准备就绪但用户未允许使用",
                            time: 3,
                            width: 500
                        });
                    }
                    else
                    {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: "摄像头被占用",
                            time: 3,
                            width: 500
                        });
                    }
                    break;
                case 5 :
                    if (msg.type == 0) {
                        art.dialog({
                            title: '信息提示',
                            lock: true,
                            background: '#600', // 背景色
                            opacity: 0.90, // 透明度
                            content: "头像上传成功",
                            time: 3,
                            width: 500
                        });
                        location.href = '/center_account/index';
                    }
                    break;
            }
        }
        );

    });
</script>