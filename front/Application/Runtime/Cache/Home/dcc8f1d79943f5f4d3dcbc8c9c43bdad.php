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
    <script>
        var module_url = "/Sayyas/index.php/Home";
    </script>
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
        <li><a class="collapsed" data-toggle="collapse" href="#project_noing"><i class="menu-icon icon-beaker"></i>
            <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>业务体系</a>
            <ul id="project_noing" class="collapse unstyled">
                <li><a href="/Sayyas/index.php/Home/Project/modify"><i class="icon-plus"></i>添加业务</a></li>
                <li><a href="/Sayyas/index.php/Home/Project/plist"><i class="icon-list"></i>业务列表</a></li>
            </ul>
        </li>
        <li><a class="collapsed" data-toggle="collapse" href="#project_ing"><i class="menu-icon icon-envelope"></i>
            <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>项目体系</a>
            <ul id="project_ing" class="collapse unstyled">
                <li><a href=""><i class="icon-plus"></i>添加 </a></li>
                <li><a href=""><i class="icon-list"></i>列表 </a></li>
            </ul>
        </li>
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
    <?php if($project_id == ''): ?><div class="module">
            <div class="module-head">
                <h3>添加业务</h3>
            </div>
            <div class="module-body">
                <form class="form-horizontal row-fluid" id="add_form">
                    <div class="control-group">
                        <label class="control-label" for="saleman">业务员</label>
                        <div class="controls">
                            <input type="text" id="saleman"  class="span8" readonly value="李建" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="report_time">报备日期</label>
                        <div class="controls">
                            <input type="date" id="report_time"  class="span8" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="contact">联系人</label>
                        <div class="controls">
                            <input type="text" id="contact"  class="span8" placeholder="联系人姓名" required >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="contact_tel">联系电话</label>
                        <div class="controls">
                            <input type="tel" id="contact_tel"  class="span8" placeholder="联系人电话" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">项目地址</label>
                        <div class="controls">
                            <input type="tel" id="address"  class="span8" placeholder="项目地址" required>
                        </div>
                    </div>

                    <div class="control-group" id="schedules">
                        <label class="control-label">进度明细</label>
                        <div class="controls schedules">
                            <input type="date" name="schedule_date">
                            <input type="text" name="schedule_content" placeholder="业务跟进明细">
                            <i class="icon-plus schedule-plus" title="添加明细"></i>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">确认添加</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <?php else: ?>
        <div class="module">
            <div class="module-head">
                <h3>修改项目进度</h3>
            </div>
            <div class="module-body">
                <form class="form-horizontal row-fluid">
                    <div class="control-group">
                        <label class="control-label" for="saleman">业务员</label>
                        <div class="controls">
                            <input type="text" id="saleman"  class="span8" readonly value="李建" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="report_time">报备日期</label>
                        <div class="controls">
                            <input type="date" id="report_time"  class="span8" value="<?php echo ($project["report_time"]); ?>" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="contact">联系人</label>
                        <div class="controls">
                            <input type="text" id="contact"  class="span8" placeholder="联系人姓名" value="<?php echo ($project["contact"]); ?>" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="contact_number">联系电话</label>
                        <div class="controls">
                            <input type="tel" id="contact_number"  class="span8" placeholder="联系人电话" value="<?php echo ($project["contact_tel"]); ?>" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="address">项目地址</label>
                        <div class="controls">
                            <input type="tel" id="address"  class="span8" placeholder="联系人电话" value="<?php echo ($project["address"]); ?>" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">项目历程</label>
                        <br>
                        <?php if(is_array($project['schedule'])): $i = 0; $__LIST__ = $project['schedule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><div class="controls time-tree">
                                <div class="time-left">
                                    <?php echo ($pro["create_time"]); ?>
                                </div>
                                <div class="time-right"><?php echo ($pro["content"]); ?></div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">确认修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><?php endif; ?>
</div><!--/.content-->
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">系统提示</h4>
            </div>
            <div class="modal-body" id="modifytoast">本次信息添加成功</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">确认</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script src="/Sayyas/Public/js/project_modify.js" type="text/javascript"></script>

            </div>
        </div>
    </div>
</div>

</body>