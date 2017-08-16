<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>项目首页</title>
    <link type="text/css" href="/Sayyas/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="/Sayyas/Public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="/Sayyas/Public/css/theme.css" rel="stylesheet">
    <link type="text/css" href="/Sayyas/Public/images/icons/css/font-awesome.css" rel="stylesheet">
    <script src="/Sayyas/Public/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="/Sayyas/Public/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="/Sayyas/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand"><strong>SAYYAS</strong></a>
                </div>
                <div class="span9">
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <form class="navbar-search pull-left input-append" action="#">
                            <input type="text" class="span3">
                            <button class="btn" type="button">
                                <i class="icon-search"></i>
                            </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">帮助
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">手册</a></li>
                                    <li><a href="#">新手教程</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">技术支持 张总</li>
                                </ul>
                            </li>
                            <li><a href="#">关于 </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="http://localhost/img.jpeg" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">个人档案</a></li>
                                    <li><a href="#">更改密码</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">退出登录</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /navbar-inner -->
</div>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span3">
                <div class="sidebar">
    <ul class="widget widget-menu unstyled">
        <li><a href="/Sayyas/index.php/Home/Index/index" class="<?php echo ($index); ?>"><i class="menu-icon icon-dashboard "></i>首页</a></li>
        <li><a href="/Sayyas/index.php/Home/Project/plist" class="<?php echo ($project); ?>"><i class="menu-icon icon-list "></i> 项目列表 </a></li>
        <li><a href="/Sayyas/index.php/Home/Project/modify" class="<?php echo ($modify); ?>"><i class="menu-icon icon-plus"></i> 添加进度 </a></li>
        <!--<li><a href=""><i class="menu-icon icon-inbox"></i>Inbox <b class="label green pull-right">-->
            <!--11</b> </a></li>-->
    </ul>
    <ul class="widget widget-menu unstyled">
        <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
        </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
        </i>个人信息</a>
            <ul id="togglePages" class="collapse unstyled">
                <li><a href=""><i class="icon-edit"></i>修改信息 </a></li>
                <li><a href=""><i class="icon-edit"></i>修改头像 </a></li>
                <li><a href=""><i class="icon-edit"></i>修改密码</a></li>
            </ul>
        </li>
        <li><a href="#"><i class="menu-icon icon-signout"></i>退出登录 </a></li>
    </ul>
</div>
            </div>
            <div class="span9">
                
<div class="content">

    <div class="module">
        <div class="module-head">
            <h3>项目列表</h3>
        </div>
        <div class="module-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>业务员</th>
                    <th>报备日期</th>
                    <th>联系人</th>
                    <th>联系电话</th>
                    <th>项目地址</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($projects)): $i = 0; $__LIST__ = $projects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($i); ?></td>
                        <td>李健</td>
                        <td><?php echo ($row["report_time"]); ?></td>
                        <td><?php echo ($row["contact"]); ?></td>
                        <td><?php echo ($row["contact_tel"]); ?></td>
                        <td><?php echo ($row["address"]); ?></td>
                        <td>
                            <a href="#" class="small" title="查看" data-id="<?php echo ($row["id"]); ?>">
                                <i class="icon-search"></i>
                            </a>
                            <a href="#" class="small" style="margin-left: 5px;" title="删除">
                                <i class="icon-remove"></i>
                            </a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div><!--/.module-->

</div><!--/.content-->

            </div>
        </div>
    </div>
</div>

</body>