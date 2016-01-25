/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

    //提交表单
    $("#register_sub_form").click(function() {
	var phone = $("#cardno").val();
        if (phone == '' || (/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))) {
        $.ajax({
            type: "POST",
            url: "/register/checkRegister/" + Math.random(),
            data: $("#register_form").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.flag === 1) {
                    $.ajax({
                        type: "POST",
                        url: "/register/doregiter/" + Math.random(),
                        data: $("#register_form").serialize(),
                        dataType: "json",
                        success: function(data) {
                            if (data.flag == 0) {
                                $.dialog(data.error);
                            } else {
                                $.dialog(data.error);
                                location.href = "/login/index";
                            }
                        }
                    })
                } else if (data.flag === 0) {
                    $.dialog({
                        time: 2,
                        content: data.error
                    });
                } else {
                    $.dialog({
                        time: 2,
                        content: data.error
                    });
                }
            }
        });
        } else {
            $.dialog({
                time: 2,
                content: '邀请人手机格式不正确'
            });
        }
    });

    //获取验证码
    $("#get_phonecode").click(function() {
        var phone = $("#account").val();
        if ((/^1[3|4|5|8|7][0-9]\d{4,8}$/.test(phone))) {
            $.ajax({
                type: "POST",
                url: "/phoneCode/createPhoneCode/" + Math.random(),
                data: {"phone": phone, "codetype": 'register'},
                dataType: "json",
                success: function(data) {
                    if (data.flag === 1) {
                        $.dialog({
                            time: 2,
                            content: data.error
                        });
                        f_timeout();
                    } else {
                        $.dialog({
                            time: 2,
                            content: data.error
                        });
                    }
                }
            });
        } else {
            $.dialog({
                time: 2,
                content: '手机格式不正确'
            });
        }
    });
});


//切换发送按钮
function f_timeout() {
    $('#get_phonecode').hide();
    $('#noget_phonecode').show();
    $('#noget_phonecode').val('60秒重新获取');
    $('#timeb2').html(60);
    timer = self.setInterval(addsec, 1000);
}

function addsec() {
    var t = $('#timeb2').html();
    if (t > 0) {
        var timestr = parseInt(t);
        var nowtime = timestr - 1;
        $('#timeb2').html(nowtime);
        $('#noget_phonecode').val(nowtime + '秒重新获取');
    } else {
        window.clearInterval(timer);
        $('#get_phonecode').show();
        $('#noget_phonecode').val('60秒重新获取');
        $('#timeb2').html(60);
        $('#noget_phonecode').hide();
    }
}



function showContent() {
    var str = '<h3>免责条款</h3>';
    str += '<p>一、本网提供的信息仅供参考，本网对各类信息的来源、出处作明确描述。</p>';
    str += '<p>二、本网信息大部份来自权威媒体机构和作者本人，但本网不保证信息的可靠信、真实性与正确性，请读者依此进行投资决策时务必注意阅读信息原版原文。</p>';
    str += '<p>三、对于部分非权威媒体的信息内容本网将特别注明类似“未证实消息，仅供参考”字样，请投资者务必注意核实。</p>';
    str += '<p>四、本网所提供的信托产品统计数据及其相关分析仅供参考，不作为投资使用的依据，据此使用，风险自负。</p>';
    str += '<p>五、本网所转载的信息观点以投资者教育的内容主张并不代表本网站的观点或主张。</p>';
    str += '<p>六、引用本网的研究报告等须注明来源“财来电”，同时，引用的报告仅能作为自身的学术参考用，不能用于商业目的，否则我们有权追究版权责任。</p>';
    str += '<h3>隐私条款</h3>';
    str += '<p>隐私权是您的重要权利。向我们提供您的个人信息是基于对我们的信任，相信我们会负责的态度对待您的个人信息。我们认为您提供的信息只能用于帮助我们为您提供更好的服务。请您认真阅读以下条款，以了解我们的政策。本条款可能在必要时会不定时更改，请注意定期查阅。</p>';
    str += '<p>1、我们需要收集哪些个人资料</p>';
    str += '<p>一般情况下，您不需要提交个人资料就能够访问我们的网站。但是当您需要使用我们的服务时（会员），则必须注册个人资料后才能使用。</p>';
    str += '<p>收集个人资料是为了便于我们向您提供优质高效的服务，例如发送新产品及相关信息。当然，即使您已经注册个人资料，您仍可随时拒绝我们发送的任何信息。</p>';
    str += '<p>2、 我们为个人资料保密</p>';
    str += '<p>我们将采取一定的措施来保护您的个人资料。在未经访问者授权同意的情况下，本网站不会将访问者的个人资料泄露给第三方。但以下情况除外：</p>';
    str += '<p>(1) 根据执法单位之要求或为公共之目的向相关单位提供个人资料；</p>';
    str += '<p>(2) 由于您将用户密码告知他人或与他人共享注册帐户，由此导致的任何个人资料泄露；</p>';
    str += '<p>(3) 由于黑客攻击、计算机病毒侵入或发作、因政府管制而造成的暂时性关闭等影响网络正常经营之不可抗力而造成的个人资料泄露、丢失、被盗用或被窜改等；</p>';
    str += '<p>(4) 由于与本网站链接的其它网站所造成之个人资料泄露及由此而导致的任何法律争议和后果；对于因为您自己的原因造成您的个人资料被他人知晓的，我们不承担任何责任。</p>';
    str += '<p>3、查阅个人资料</p>';
    str += '<p>已在网站注册的您有权查核我们是否保存您的个人资料，并且查阅您个人的资料，并且要求我们更正您的个人资料或由您自行更正。</p>';
    str += '<p>4、对其他网站的友情链接</p>';
    str += '<p>财来电含有其他网站的链接，我们不对这些网站的内容及他们关于隐私权的行为负责，建议您仔细阅读这些网站的个人资料保密制度。</p>';
    str += '<p>5、任何时候如果您认为我们没有遵守这些条款时，请致电或email到通知我们，我们会认真处理您的要求并回复。</p> ';
    art.dialog({
        title: '财来电用户协议',
        lock: true,
        background: '#DDD', // 背景色
        opacity: 0.75, // 透明度
        content: str,
        width: '700px',
        //icon: 'succeed',
        //cancel: true,
        ok: function() {
            if ($('.checkbox').siblings("input[type='checkbox']").is(':checked')) {
            } else {
                $('.checkbox').addClass('checked');
                $('.checkbox').siblings("input[type='checkbox']").attr('checked', 'checked');
            }
        }
    });
}