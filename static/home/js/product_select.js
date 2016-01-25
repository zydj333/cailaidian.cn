// JavaScript Document
$.fn.sjld = function(productclass, productname) {
    var pcp = productclass + ' p'
    var pnp = productname + ' p'
    var ppn = productclass + ' .m_zlxg2'
    var pns = productname + ' .m_zlxg2'
    var pcli = productclass + ' ul li'
    var pnli = productname + ' ul li'
    $('.m_zlxg').click(function() {
        $(this).find('.m_zlxg2').slideDown(200);
    })
    $('.m_zlxg').mouseleave(function() {
        $(this).find('.m_zlxg2').slideUp(200);
    })
    var pcgsmr = provinceList;
    var pngsmr = provinceList[0].cityList;
    var kuandu = new Array();


    $(pcp).text(pcgsmr[0].name);
    $(pnp).text(pngsmr[0].name);
    //默认城市
    for (a = 0; a < pcgsmr.length; a++) {
        var pcmcmr = pcgsmr[a].name;
        var pcnrmr = "<li>" + pcmcmr + "</li>";
        $(productclass).find('ul').append(pcnrmr);
    }
    for (b = 0; b < pngsmr.length; b++) {
        var pnmcmr = pngsmr[b].name;

        var pnnrmr = "<li>" + pnmcmr + "</li>";
        $(productname).find('ul').append(pnnrmr);
        kuandu[b] = pnmcmr.length * 14 + 20;
    }
    Array.max = function(array)
    {
        return Math.max.apply(Math, array);
    }
    var max_kd = Array.max(kuandu);
    if (max_kd < 278) {
        $(pns).width('278px');
    }
    else {
        $(pns).width(max_kd);
    }

    /*---------------------------------------------------------------------*/

    $(pcli).click(function() {
        var dqpc = $(this).text();
        $(productclass).find('p').text(dqpc);
        $(productclass).find('p').attr('title', dqpc);
        var pcnum = $(this).index();

        var pngs = provinceList[pcnum].cityList;
        var pngs2 = provinceList[pcnum].cityList[0].areaList;
        $(productname).find('ul').text('');
        var kuandu = new Array();
        for (i = 0; i < pngs.length; i++) {
            var pnmc = pngs[i].name;
            var pnnr = "<li>" + pnmc + "</li>";
            $(productname).find('ul').append(pnnr);
            kuandu[i] = pnmc.length * 14 + 20;
        }
        Array.max = function(array)
        {
            return Math.max.apply(Math, array);
        }
        var max_kd = Array.max(kuandu);
        if (max_kd < 278) {
            $(pns).width('278px');
        }
        else {
            $(pns).width(max_kd);
        }
        var qygsdqmr = provinceList[pcnum].cityList[0];
        $(pnp).text(pngs[0].name);
        $('#pcdq_num').val(pcnum);

        /*------------------*/
        $(pnli).click(function() {
            var dqpn = $(this).text();
            var dqpc_num = $('#pcdq_num').val();
            if (dqpc_num == "") {
                dqpc_num = 0;
            }
            else {
                var dqpc_num = $('#pcdq_num').val();
            }
            $(productname).find('p').text(dqpn);
            $(productname).find('p').attr('title', dqpn);
            var pnnum = $(this).index();
        })	//市级
    })//省级
    /*---------------------------------------------------------------------*/



    $(pnli).click(function() {
        var dqpn = $(this).text();
        var dqpc_num = $('#pcdq_num').val();
        if (dqpc_num == "") {
            dqpc_num = 0;
        }
        else {
            var dqpc_num = $('#pcdq_num').val();
        }
        $(productname).find('p').text(dqpn);
        $(productname).find('p').attr('title', dqpn);
        var pnnum = $(this).index();
    })	//市级
    /*---------------------------------------------------------------------*/
    $('.m_zlxg').click(function() {
        $('#pcdq_tj').val($(pcp).text());
        $('#pndq_tj').val($(pnp).text());
    })//表单传值获取

}
var provinceList = [
    {name: '请选择产品', cityList: [
            {name: '请选择产品', }
        ]},
    {name: '信托产品', cityList: [
            {name: 'XT1', },
            {name: 'XT2', }
        ]},
    {name: '资管计划', cityList: [
            {name: 'ZG1', },
            {name: 'ZG2', }
        ]},
    {name: '阳光私募', cityList: [
            {name: 'SM1', },
            {name: 'SM2', }
        ]},
    {name: '保险理财', cityList: [
            {name: 'BX1', },
            {name: 'BX2', },
            {name: 'BX3', }
        ]},
];

$.fn.sjld = function(productclass, productname,provinceList) {
    var pcp = productclass + ' p'
    var pnp = productname + ' p'
    var ppn = productclass + ' .m_zlxg2'
    var pns = productname + ' .m_zlxg2'
    var pcli = productclass + ' ul li'
    var pnli = productname + ' ul li'
    $('.m_zlxg').click(function() {
        $(this).find('.m_zlxg2').slideDown(200);
    })
    $('.m_zlxg').mouseleave(function() {
        $(this).find('.m_zlxg2').slideUp(200);
    })
    var pcgsmr = provinceList;
    var pngsmr = provinceList[0].cityList;
    var kuandu = new Array();


    $(pcp).text(pcgsmr[0].name);
    $(pnp).text(pngsmr[0].name);
    //默认城市
    for (a = 0; a < pcgsmr.length; a++) {
        var pcmcmr = pcgsmr[a].name;
        var pcnrmr = "<li>" + pcmcmr + "</li>";
        $(productclass).find('ul').append(pcnrmr);
    }
    for (b = 0; b < pngsmr.length; b++) {
        var pnmcmr = pngsmr[b].name;

        var pnnrmr = "<li>" + pnmcmr + "</li>";
        $(productname).find('ul').append(pnnrmr);
        kuandu[b] = pnmcmr.length * 14 + 20;
    }
    Array.max = function(array)
    {
        return Math.max.apply(Math, array);
    }
    var max_kd = Array.max(kuandu);
    if (max_kd < 278) {
        $(pns).width('278px');
    }
    else {
        $(pns).width(max_kd);
    }

    /*---------------------------------------------------------------------*/

    $(pcli).click(function() {
        var dqpc = $(this).text();
        $(productclass).find('p').text(dqpc);
        $(productclass).find('p').attr('title', dqpc);
        var pcnum = $(this).index();

        var pngs = provinceList[pcnum].cityList;
        var pngs2 = provinceList[pcnum].cityList[0].areaList;
        $(productname).find('ul').text('');
        var kuandu = new Array();
        for (i = 0; i < pngs.length; i++) {
            var pnmc = pngs[i].name;
            var pnnr = "<li>" + pnmc + "</li>";
            $(productname).find('ul').append(pnnr);
            kuandu[i] = pnmc.length * 14 + 20;
        }
        Array.max = function(array)
        {
            return Math.max.apply(Math, array);
        }
        var max_kd = Array.max(kuandu);
        if (max_kd < 278) {
            $(pns).width('278px');
        }
        else {
            $(pns).width(max_kd);
        }
        var qygsdqmr = provinceList[pcnum].cityList[0];
        $(pnp).text(pngs[0].name);
        $('#pcdq_num').val(pcnum);

        /*------------------*/
        $(pnli).click(function() {
            var dqpn = $(this).text();
            var dqpc_num = $('#pcdq_num').val();
            if (dqpc_num == "") {
                dqpc_num = 0;
            }
            else {
                var dqpc_num = $('#pcdq_num').val();
            }
            $(productname).find('p').text(dqpn);
            $(productname).find('p').attr('title', dqpn);
            var pnnum = $(this).index();
        })	//市级
    })//省级
    /*---------------------------------------------------------------------*/



    $(pnli).click(function() {
        var dqpn = $(this).text();
        var dqpc_num = $('#pcdq_num').val();
        if (dqpc_num == "") {
            dqpc_num = 0;
        }
        else {
            var dqpc_num = $('#pcdq_num').val();
        }
        $(productname).find('p').text(dqpn);
        $(productname).find('p').attr('title', dqpn);
        var pnnum = $(this).index();
    })	//市级
    /*---------------------------------------------------------------------*/
    $('.m_zlxg').click(function() {
        $('#pcdq_tj').val($(pcp).text());
        $('#pndq_tj').val($(pnp).text());
    })//表单传值获取

}
/*
var provinceList = [
    {name: '请选择产品', cityList: [
            {name: '请选择产品', }
        ]},
    {name: '信托产品', cityList: [
            {name: 'XT1', },
            {name: 'XT2', }
        ]},
    {name: '资管计划', cityList: [
            {name: 'ZG1', },
            {name: 'ZG2', }
        ]},
    {name: '阳光私募', cityList: [
            {name: 'SM1', },
            {name: 'SM2', }
        ]},
    {name: '保险理财', cityList: [
            {name: 'BX1', },
            {name: 'BX2', },
            {name: 'BX3', }
        ]},
];*/