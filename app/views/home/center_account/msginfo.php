<body>
            <div class="rightinfo">
                <table class="tablelist">
                    <tr align="left"><td>收件人：<?php echo $info->to_username; ?></td></tr>
                    <tr align="left"><td>详细内容：<?php echo $info->message; ?></td></tr>
                    <tr align="left">
                        <td>联系方式：
                            <?php 
                                if($info->contact_type == 1){
                                    echo '手机';
                                } elseif ($info->contact_type == 2){
                                    echo 'QQ';
                                } elseif ($info->contact_type == 3){
                                    echo '邮箱';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr align="left"><td>联系方式值：<?php echo $info->contact_value; ?></td></tr>
                    <tr align="left"><td>发送人：<?php echo $info->from_username; ?></td></tr>
                    <tr align="left"><td>发送时间：<?php echo date('Y-m-d H:i:s', $info->sendtime); ?></td></tr>
                </table>
        </div>
</body>