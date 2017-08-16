<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>张超--个人记账程序</title>

    <link href="/Charge/Public/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Charge/Public/js/jquery-1.11.1.min.js"></script>
    <script src="/Charge/Public/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">张超-记账本</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="/Charge/Public/images/head.jpeg" style="max-height: 100%">
                欢迎使用DEAN记账本
            </a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo session('uid');?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/Charge/index.php/Home/Login/logout"><span class="glyphicon glyphicon-log-out"></span> 退出登录</a></li>
                        <li><a href="/Charge/index.php/Home/User/password"><span class="glyphicon glyphicon-log-out"></span> 更改密码</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li><a href="/Charge/index.php/Home/Account/index"><span class="glyphicon glyphicon-list"></span> 统计列表</a></li>
        <li><a href="/Charge/index.php/Home/Account/modify"><span class="glyphicon glyphicon-plus"></span> 每日一添</a></li>
        <li><a href="/Charge/index.php/Home/Account/count"><span class="glyphicon glyphicon-sort"></span> 图表详情</a></li>
    </ul>
    <div class="attribution">Dean-记账本</div>
</div><!--/.sidebar-->

<input type="hidden" value="/Charge/index.php/Home/Account" id="appurl">
<input type="hidden" value="/Charge/Public" id="publicurl">

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    


<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-list"></span></a></li>
            <li class="active">统计详情</li>
        </ol>
    </div>

</div><!--/.row-->
<div class="row" style="border-bottom: 1px solid #5097f0;margin: 15px 0">
    <div class="col-sm-12 form-inline" style="margin: 10px 0 20px 0;">
        <div class="form-group">
            <label class="" >开始日期：</label>
            <input type="date" class="form-control" id="begintime" value="<?php echo date('Y-m-d',time()-86400*8) ?>">
        </div>
        <div class="form-group">
            <label class="">结束日期：</label>
            <input type="date" class="form-control" id="endtime" value="<?php echo date('Y-m-d',time()-86400) ?>">
        </div>
        <div class="form-group">
            <select class="form-control" id="counttype">
                <option value="0">查看各类消费金额</option>
                <option value="1">每日消费走势</option>
                <option value="2">查看消费占比</option>
                <option value="3">每月消费走势</option>
            </select>
        </div>
        <div class="form-group color-blue" style="float: right;font-family: Microsoft YaHei;font-size: 20px">
            本月累计消费金额：<?php echo ($monthtotal[0]['total']); ?> 元
        </div>
    </div>


</div>
<div class="row">
    <div id="box" style="width: 100%; height: 500px;">
    </div>
    <div class="detail"></div>
</div>

<link href="/Charge/Public/css/datepicker3.css" rel="stylesheet">
<link href="/Charge/Public/css/bootstrap-table.css" rel="stylesheet">
<link href="/Charge/Public/css/styles.css" rel="stylesheet">
<script src="/Charge/Public/js/highcharts.js"></script>
<script src="/Charge/Public/js/bootstrap-datepicker.js"></script>
<script src="/Charge/Public/js/app.js"></script>
<script language="JavaScript">
var begintime;var endtime;
var appurl = $("#appurl").val();
var F = {};

$(function () {
    getColumn();
    $("#counttype").change(function () {
        var v = $(this).val();
        //检查时间区间是否有误
        switch (v){
            case '0':
                getColumn();
                break;
            case '1':
                getTrend();
                break;
            case '2':
                getPie();
                break;
            case '3':
                getMonthTrend();
                break;
        }
    });
    $("#begintime,#endtime").change(function (e) {
        var v= $("#counttype").val();
        switch (v){
            case '0':
                getColumn();
                break;
            case '1':
                getTrend();
                break;
            case '2':
                getPie();
                break;
        }
    })
});

//绘制柱状图
function drawColumn(obj){
    var chart = {
        type: 'column'

    };
    var title = {
        text: '<span style="color:#65bdff">消费金额详情（点击可查看明细）</span>'
    };
    var subtitle = {
    };
    var xAxis = {
    };
    var yAxis = {
        min: 0,
        title: {
            text: '消费金额 (元)'
        }
    };
    var tooltip = {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table class="tooltipbox" id="" style="font-size: 12px">',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f} 元</b></td></tr>',
        footerFormat: '</table>',
//            shared: true,
        useHTML: true,
//            followPointer: true,
        hideDelay:40000,
        backgroundColor: '#FCECC0',
        borderWidth: 1,
        style: {
            color: '#6D28BB'
        }

    };
    var plotOptions = {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series: {
            cursor:'pointer',
            events:{
                click: function (e) {
                    var name = F.changeTOEng(e.point.series.name)+"_items";
                    var date = e.point.category;
                    $.ajax({
                        url:appurl+"/getDetail",
                        data:{name:name,date:date},
                        type:'post',
                        success: function (data ,status) {
                            var obj = eval('(' + data + ')');
                            var arr = eval('(' + obj[name] + ')');
                            var html = '';

                            if(arr.length >=4){
                                for(var i=0;i<arr.length;i++){
                                    if((i+1)%2!=0){
                                        html += "<tr>";
                                        html += '<td style="color: '+ e.point.color+'"> '+arr[i]['name']+': </td>';
                                        html += '<td style="font-weight:bold" dx="0"> '+arr[i]['consume']+' 元</td>';
                                    }else{
                                        html += '<td style="color: '+ e.point.color+'"> '+arr[i]['name']+': </td>';
                                        html += '<td style="font-weight:bold" dx="0"> '+arr[i]['consume']+' 元</td></tr>';
                                    }
                                }
                            }else{
                                if(arr.length >0){
                                    for(var i=0;i<arr.length;i++){
                                        html += '<tr><td style="color: '+ e.point.color+'"> '+arr[i]['name']+': </td>';
                                        html += '<td style="font-weight:bold" dx="0"> '+arr[i]['consume']+' 元</td></tr>';
                                    }
                                }else{
                                    html = "<p>NO DATA</p>";
                                }

                            }
                            $(".tooltipbox").html(html);
//                                $(".detail").html(html).css({left: e.offsetX,top: e.offsetY,background: e.point.color}).fadeIn();
                        }
                    });
//<tspan style="font-size: 10px">2016-07-07</tspan>
//<tspan style="fill:#8085e9" x="8" dy="15">●</tspan>
                    //<tspan dx="0"> 其它: </tspan>
                    //<tspan style="font-weight:bold" dx="0">140</tspan>
                }
            }
        }

    };
    var credits = {
        enabled: false
    };
    var series = [];
    var drilldown= function () {
        console.log(1)
    };
    if(obj != null){
        series= [
            {
                name: '餐饮',
                data: obj.food
            },
            {
                name: '公交',
                data: obj.bus
            },
            {
                name: '娱乐',
                data:obj.amuse
            },
            {
                name: '购物',
                data:obj.shopping
            },
            {
                name: '其它',
                data: obj.other
            }];
        xAxis = {
            categories:obj.date,
            crosshair: true
        }
    }

    var json = {};
    json.chart = chart;
    json.title = title;
    json.subtitle = subtitle;
    json.tooltip = tooltip;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.series = series;
    json.plotOptions = plotOptions;
    json.credits = credits;
    json.drilldown = drilldown;
    $('#box').highcharts(json);

}

//绘制走势图
function drawTrend(x,y,type){
    var chart = {
        type: 'line'
    };
    var title = {
        text: '消费总额走势详情'
    };
    var subtitle = {
    };
    var xAxis = {
        categories:x,
        crosshair: true
    };
    var yAxis = {
        min: 0,
        title: {
            text: '消费金额 (元)'
        }
    };
    var tooltip = {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f} 元</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    };
    var plotOptions = {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    };
    var credits = {
        enabled: false
    };

    var str = type=="day"?"每日消费额":"每月消费总额";
    var series= [{
        name: str,
        data: y
    }];

    var json = {};
    json.chart = chart;
    json.title = title;
    json.subtitle = subtitle;
    json.tooltip = tooltip;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.series = series;
    json.plotOptions = plotOptions;
    json.credits = credits;
    $('#box').highcharts(json);
}

//绘制饼图
function drawPie(obj){

    var chart = {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false
    };
    var title = {
        text: '各类消费占比'
    };
    var tooltip = {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    };
    var plotOptions = {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true
            },
            showInLegend: true
        }
    };
    var series= [{
        type: 'pie',
        name: '比重',
        data: [['餐饮',obj.food],['娱乐',obj.amuse],['公交',obj.bus],['购物',obj.shopping],['其他',obj.others]]
    }];

    var json = {};
    json.chart = chart;
    json.title = title;
    json.tooltip = tooltip;
    json.series = series;
    json.plotOptions = plotOptions;
    $('#box').highcharts(json);
}

//检查时间区间是否合格
F.checkTime =function(){
    begintime = $("#begintime").val();
    endtime = $("#endtime").val();

    if(begintime > endtime){
        $("#modal-body").html('您选择的时间范围有误！');
        $('#myModal').modal('show');
        return false;
    }

    if(begintime == "" && endtime ==""){
        $("#modal-body").html('请至少选择一个时间点');
        $('#myModal').modal('show');
        return false;
    }

    begintime = begintime ==""?endtime:begintime;
    endtime = endtime==""?begintime:endtime;

    var date_diff=Date.parse(endtime)-Date.parse(begintime);
    if(date_diff > 30*86400000 ){

        //alert("时间区间请控制在30天内");
        $("#modal-body").html('时间区间请控制在30天内');
        $('#myModal').modal('show');
        return false;
    }

}

F.changeTOEng = function (name) {

    switch (name){
        case "餐饮":
            return 'food';
        case "娱乐":
            return "amuse";
        case "公交":
            return "bus";
        case "购物":
            return "shopping";
        case "其它":
            return "other";
    }
}

function getColumn(){
    F.checkTime();
    $.ajax({
        type: 'POST',
        url: appurl+'/getColumn',
        data:{begin:begintime,end:endtime},
        timeout: 3000 ,//请求超时时间
        success: function (res, status) {

            if(status == "success"){
                var obj = eval('(' + res + ')');
                drawColumn(obj);
            }
        },
        //请求超时
        error: function () {
            alert("无法获取服务器数据，请稍后再试！");
        }

    },'json');
}

function getTrend(){
    F.checkTime();
    $.ajax({
        type: 'POST',
        url: appurl+'/getTrend',
        data:{begin:begintime,end:endtime,type:'day'},
        timeout: 3000 ,//请求超时时间
        success: function (res, status) {

            if(status == "success"){
                var obj = eval('(' + res + ')');
                drawTrend(obj.x,obj.y);
            }
        },
        //请求超时
        error: function () {
            alert("无法获取服务器数据，请稍后再试！");
        }

    },'json');
}

function getMonthTrend(){
    $.ajax({
        type: 'POST',
        url: appurl+'/getTrend',
        data:{type:'month'},
        timeout: 3000 ,//请求超时时间
        success: function (res, status) {

            if(status == "success"){
                var obj = eval('(' + res + ')');
                drawTrend(obj.x,obj.y,'month');
            }
        },
        //请求超时
        error: function () {
            alert("无法获取服务器数据，请稍后再试！");
        }

    },'json');
}

function getPie(){
    F.checkTime();
    $.ajax({
        type: 'POST',
        url: appurl+'/getPie',
        data:{begin:begintime,end:endtime},
        timeout: 3000 ,//请求超时时间
        success: function (res, status) {

            if(status == "success"){
                var obj = eval('(' + res + ')');
                drawPie(obj)
            }
        },
        //请求超时
        error: function () {
            alert("无法获取服务器数据，请稍后再试！");
        }

    });
}
</script>
</div>



</body>

</html>