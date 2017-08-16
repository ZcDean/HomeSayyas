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
        <div class="module-body">
            <div class="profile-head media">
                <a href="#" class="media-avatar pull-left">
                    <img src="http://localhost/img.jpeg">
                </a>
                <div class="media-body">
                    <h4>
                        李健 <small>中午好!</small>
                    </h4>
                    <p class="profile-brief">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                        unknown printer took a galley of type.
                    </p>
                    <div class="profile-details muted">
                        <a href="#" class="btn"><i class="icon-plus shaded"></i>Send Friend Request </a>
                        <a href="#" class="btn"><i class="icon-envelope-alt shaded"></i>Send message </a>
                    </div>
                </div>
            </div>
            <ul class="profile-tab nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Feed</a></li>
                <li><a href="#friends" data-toggle="tab">Friends</a></li>
            </ul>
            <div class="profile-tab-content tab-content">
                <div class="tab-pane fade active in" id="activity">
                    <div class="stream-list">
                        <div class="media stream">
                            <a href="#" class="media-avatar medium pull-left">
                                <img src="images/user.png">
                            </a>
                            <div class="media-body">
                                <div class="stream-headline">
                                    <h5 class="stream-author">
                                        John Donga <small>08 July, 2014</small>
                                    </h5>
                                    <div class="stream-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type.
                                    </div>
                                    <div class="stream-attachment photo">
                                        <div class="responsive-photo">
                                            <img src="images/img.jpg" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <!--/.stream-headline-->
                                <div class="stream-options">
                                    <a href="#" class="btn btn-small"><i class="icon-thumbs-up shaded"></i>Like </a>
                                    <a href="#" class="btn btn-small"><i class="icon-reply shaded"></i>Reply </a><a href="#"
                                                                                                                    class="btn btn-small"><i class="icon-retweet shaded"></i>Repost </a>
                                </div>
                            </div>
                        </div>
                        <!--/.media .stream-->
                        <!--/.media .stream-->
                        <div class="media stream">
                            <a href="#" class="media-avatar medium pull-left">
                                <img src="images/user.png">
                            </a>
                            <div class="media-body">
                                <div class="stream-headline">
                                    <h5 class="stream-author">
                                        John Donga <small>08 July, 2014</small>
                                    </h5>
                                    <div class="stream-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type.
                                    </div>
                                </div>
                                <!--/.stream-headline-->
                                <div class="stream-options">
                                    <a href="#" class="btn btn-small"><i class="icon-thumbs-up shaded"></i>Like </a>
                                    <a href="#" class="btn btn-small"><i class="icon-reply shaded"></i>Reply </a><a href="#"
                                                                                                                    class="btn btn-small"><i class="icon-retweet shaded"></i>Repost </a>
                                </div>
                                <div class="stream-respond">
                                    <div class="media stream">
                                        <a href="#" class="media-avatar small pull-left">
                                            <img src="images/user.png">
                                        </a>
                                        <div class="media-body">
                                            <div class="stream-headline">
                                                <h5 class="stream-author">
                                                    John Donga <small>10 July 14</small>
                                                </h5>
                                                <div class="stream-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                </div>
                                            </div>
                                            <!--/.stream-headline-->
                                        </div>
                                    </div>
                                    <!--/.media .stream-->
                                    <div class="media stream">
                                        <a href="#" class="media-avatar small pull-left">
                                            <img src="images/user.png">
                                        </a>
                                        <div class="media-body">
                                            <div class="stream-headline">
                                                <h5 class="stream-author">
                                                    John Donga <small>12 July 14</small>
                                                </h5>
                                                <div class="stream-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                                    Ipsum is simply dummy text.
                                                </div>
                                            </div>
                                            <!--/.stream-headline-->
                                        </div>
                                    </div>
                                    <!--/.media .stream-->
                                </div>
                                <!--/.stream-respond-->
                            </div>
                        </div>
                        <!--/.media .stream-->
                        <div class="media stream">
                            <a href="#" class="media-avatar medium pull-left">
                                <img src="images/user.png">
                            </a>
                            <div class="media-body">
                                <div class="stream-headline">
                                    <h5 class="stream-author">
                                        John Donga <small>08 July, 2014</small>
                                    </h5>
                                    <div class="stream-text">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type.
                                    </div>
                                </div>
                                <!--/.stream-headline-->
                                <div class="stream-options">
                                    <a href="#" class="btn btn-small"><i class="icon-thumbs-up shaded"></i>Like </a>
                                    <a href="#" class="btn btn-small"><i class="icon-reply shaded"></i>Reply </a><a href="#"
                                                                                                                    class="btn btn-small"><i class="icon-retweet shaded"></i>Repost </a>
                                </div>
                            </div>
                        </div>
                        <!--/.media .stream-->
                        <div class="media stream load-more">
                            <a href="#"><i class="icon-refresh shaded"></i>Load more... </a>
                        </div>
                    </div>
                    <!--/.stream-list-->
                </div>
                <div class="tab-pane fade" id="friends">
                    <div class="module-option clearfix">
                        <form>
                            <div class="input-append pull-left">
                                <input type="text" class="span3" placeholder="Filter by name...">
                                <button type="submit" class="btn">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                        </form>
                        <div class="btn-group pull-right" data-toggle="buttons-radio">
                            <button type="button" class="btn">
                                All</button>
                            <button type="button" class="btn">
                                Male</button>
                            <button type="button" class="btn">
                                Female</button>
                        </div>
                    </div>
                    <div class="module-body">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            John Donga
                                        </h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            Donga John</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.row-fluid-->
                        <br />
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            John Donga</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            Donga John</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.row-fluid-->
                        <br />
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            John Donga</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            Donga John</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.row-fluid-->
                        <br />
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            John Donga</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            Donga John</h3>
                                        <p>
                                            <small class="muted">Pakistan</small></p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <i class="icon-envelope"></i>
                                            </button>
                                            <button class="btn btn-small">
                                                <i class="icon-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.row-fluid-->
                        <br />
                        <div class="pagination pagination-centered">
                            <ul>
                                <li><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#"><i class="icon-double-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.module-body-->
    </div>
    <!--/.module-->
</div>
<script src="/Sayyas/Public/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
            </div>
        </div>
    </div>
</div>

</body>