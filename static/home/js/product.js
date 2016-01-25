/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function loginUrl() {
    location.href = "/login/index";
}

$(function() {
    //提交在线预约
    $("#boot_button").click(function() {
        $.ajax({
            type: "POST",
            url: "/product/checkBoot/" + Math.random(),
            data: $("#boot_account").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    art.dialog(data.error);
                    location.href="/center/appointment";
                } else {
                    art.dialog({
                        title: '信息提示',
                        lock: true,
                        background: '#600', // 背景色
                        opacity: 0.90, // 透明度
                        content: data.error,
                        time: 2,
                        width: 500
                    });
                    return;
                }
            }
        });
    });
});