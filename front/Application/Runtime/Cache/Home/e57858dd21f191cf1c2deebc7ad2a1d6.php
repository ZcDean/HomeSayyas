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

<input type="hidden" value="/Charge/index.php/Home/User" id="appurl">
<input type="hidden" value="/Charge/Public" id="publicurl">

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> 修改密码</div>
            <div class="panel-body">
                <form class="form-horizontal" action="/Charge/index.php/Home/User/password" method="post">
                    <fieldset>
                        <!-- Name input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="oldpwd">原密码</label>
                            <div class="col-md-4 inputtext">
                                <input type="password" id="oldpwd"  name="oldpwd"  class="form-control" >
                                <div class="password">请输入原密码</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="newpwd"><span class="glyphicon glyphicon-"></span>新密码</label>
                            <div class="col-md-4 inputtext">
                                <input id="newpwd" name="newpwd" type="password"   class="form-control in">
                                <div class="password">请输入新密码</div>
                                <div class="password-degree">
                                    <span id="l"></span>
                                    <span id="m"></span>
                                    <span id="s"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ensurepwd">确认密码</label>
                            <div class="col-md-4 inputtext">
                                <input id="ensurepwd" name="ensurepwd" type="password" class="form-control" >
                                <div class="password">请确认新密码</div>
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2 widget-left">
                                <button type="submit" class="btn btn-primary btn-md pull-left" id="commit" onsubmit="return check()">提交</button>
                            </div>
                            <div class="col-md-2">
                                <div class="alert alert-info">
                                    <a href="#" class="close" data-dismiss="alert">
                                        &times;
                                    </a>
                                    <strong><?php echo ($error); ?></strong>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>


    </div><!--/.col-->

</div><!--/.row-->
<link href="/Charge/Public/css/styles.css" rel="stylesheet">

<script src="/Charge/Public/js/app.js"></script>
</div>



</body>

</html>