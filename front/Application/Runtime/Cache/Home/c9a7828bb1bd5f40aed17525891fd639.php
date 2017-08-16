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
    <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-plus"></span></a></li>
        <li class="active">添加流向</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-8">
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert">
                &times;
            </a>
            <strong>说明：</strong>添加分项后的对应的父级初始为0
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> 详细</div>
            <div class="panel-body">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Name input-->
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2 control-label" for="calendar1">日期</label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" id="calendar1" name="date"   class="form-control"  value="<?php echo date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <span class="help-block color-blue" id="datetool">默认为当前日期</span>
                            </div>
                        </div>
                        <div class="form-group parentitem">
                            <label class="col-md-2 col-sm-2 control-label" for="food"><span class="glyphicon glyphicon-"></span>餐饮</label>
                            <div class="col-md-6 col-sm-6">
                                <input id="food" name="food" type="number" value="0" step="0.01"  class="form-control in">

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <button class="addsubitem" type="button"><span class="glyphicon glyphicon-plus"></span>添加餐饮分项</button>
                                <input type="hidden" value="food">
                            </div>
                        </div>
                        <div class="form-group parentitem">
                            <label class="col-md-2 col-sm-2 control-label" for="amuse">娱乐</label>
                            <div class="col-md-6 col-sm-6">
                                <input id="amuse" name="amuse" type="number" value="0" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <button class="addsubitem" type="button"><span class="glyphicon glyphicon-plus"></span>添加娱乐分项</button>
                                <input type="hidden" value="amuse">
                            </div>
                        </div>
                        <div class="form-group parentitem">
                            <label class="col-md-2 col-sm-2 control-label" for="bus">公交</label>
                            <div class="col-md-6 col-sm-6">
                                <input id="bus" name="bus" type="number" value="0" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <button class="addsubitem" type="button"><span class="glyphicon glyphicon-plus"></span>添加公交分项</button>
                                <input type="hidden" value="bus">
                            </div>
                        </div>
                        <div class="form-group parentitem">
                            <label class="col-md-2 col-sm-2 control-label" for="shopping">购物</label>
                            <div class="col-md-6 col-sm-6">
                                <input id="shopping" name="shopping" type="number" value="0" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <button class="addsubitem" type="button"><span class="glyphicon glyphicon-plus"></span>添加购物分项</button>
                                <input type="hidden" value="shopping">
                            </div>
                        </div>
                        <div class="form-group parentitem">
                            <label class="col-md-2 col-sm-2 control-label" for="other">其他</label>
                            <div class="col-md-6 col-sm-6">
                                <input id="other" name="other" type="number" value="0" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <button class="addsubitem" type="button"><span class="glyphicon glyphicon-plus"></span>添加其他分项</button>
                                <input type="hidden" value="other">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2 control-label" for="remark">备注</label>
                            <div class="col-md-8 col-sm-8">
                                <textarea class="form-control color-blue" name="remark" rows="7" id="remark"></textarea>
                            </div>
                        </div>


                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-10 col-sm-10 widget-right">
                                <button type="button" class="btn btn-primary btn-md pull-right" id="commit" >提交</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>


    </div><!--/.col-->

    <div class="col-md-4">

        <div class="panel panel-primary">
            <div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-calendar"></span>日历</div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading dark-overlay">今天详情</div>
            <div class="panel-body">


            </div>
        </div>

    </div><!--/.col-->
</div><!--/.row-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    系统提示
                </h4>
            </div>
            <div class="modal-body">
                获取选项分类数据超时，请重试！
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">关闭
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<link href="/Charge/Public/css/datepicker3.css" rel="stylesheet">
<link href="/Charge/Public/css/styles.css" rel="stylesheet">

<script src="/Charge/Public/js/chart.min.js"></script>
<script src="/Charge/Public/js/bootstrap-datepicker.js"></script>
<script src="/Charge/Public/js/app.js"></script>
<script src="/Charge/Public/js/modify.js"></script>
<script>
    $("#calendar1").datepicker({});
    $('#calendar').datepicker({

    });

</script>
</div>



</body>

</html>