/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getMail(product_id) {
    $.ajax({
        url: "/product/getProductMail/" +product_id+'/'+ Math.random(),
        success: function(data) {
            art.dialog({
                title:'填写你的邮箱地址',
                lock: true,
                background: '#600', // 背景色
                opacity: 0.90, // 透明度
                content: data
                //icon: 'succeed',
                //cancel: true,
            });
        }
    });
}