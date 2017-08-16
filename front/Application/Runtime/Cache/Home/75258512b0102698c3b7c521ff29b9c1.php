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
    

<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">
        &times;
    </a>
    <strong>敬告！</strong>数据删除后不可恢复，请谨慎操作
</div>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-list"></span></a></li>
        <li class="active">每日流向统计详情</li>
        <li style="float: right"><a class="btn btn-primary" href="#" style="margin-top: -7px;">查看统计</a></li>
    </ol>
</div><!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if($empty == ''): ?><table class="table table-responsive" data-toggle="table"   data-show-refresh="true" data-show-toggle="true" data-show-columns="true"  data-select-item-name="toolbar1" data-pagination="true"  >
                        <thead>
                        <tr >
                            <th data-field="img" data-sortable="true">日期</th>
                            <th data-field="eat"  data-sortable="true">餐饮</th>
                            <th data-field="eatitems" >餐饮分项</th>
                            <th data-field="shop" data-sortable="true">购物</th>
                            <th data-field="shopitems" >购物分项</th>
                            <th data-field="amuse" data-sortable="true">娱乐</th>
                            <th data-field="amuseitems" >娱乐分项</th>
                            <th data-field="bus" data-sortable="true">公交</th>
                            <th data-field="busitems" >公交分项</th>
                            <th data-field="other" data-sortable="true">其他</th>
                            <th data-field="otheritems" >其他分项</th>
                            <th data-field="total" data-sortable="true">总计</th>
                            <th data-field="cancle" data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($k % 2 );++$k;?><tr>
                                <td><?php echo ($row["date"]); ?></td>
                                <td><?php echo ($row["food"]); ?></td>
                                <td>
                                    <?php if(is_array($row["food_items"])): $k1 = 0; $__LIST__ = $row["food_items"];if( count($__LIST__)==0 ) : echo "$no" ;else: foreach($__LIST__ as $key=>$food): $mod = ($k1 % 2 );++$k1;?><p>用途：<span><?php echo ($food["name"]); ?></span> 消费：<span><?php echo ($food["consume"]); ?></span></p><?php endforeach; endif; else: echo "" ;endif; ?>
                                </td>
                                <td><?php echo ($row["shopping"]); ?></td>
                                <td>
                                    <?php if(is_array($row["shopping_items"])): $k2 = 0; $__LIST__ = $row["shopping_items"];if( count($__LIST__)==0 ) : echo "$no" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($k2 % 2 );++$k2;?><p>用途：<span><?php echo ($shop["name"]); ?></span> 消费：<span><?php echo ($shop["consume"]); ?></span></p><?php endforeach; endif; else: echo "$no" ;endif; ?>
                                </td>
                                <td><?php echo ($row["amuse"]); ?></td>
                                <td>
                                    <?php if(is_array($row["amuse_items"])): $k3 = 0; $__LIST__ = $row["amuse_items"];if( count($__LIST__)==0 ) : echo "$no" ;else: foreach($__LIST__ as $key=>$amuse): $mod = ($k3 % 2 );++$k3;?><p>用途：<span><?php echo ($amuse["name"]); ?></span> 消费：<span><?php echo ($amuse["consume"]); ?></span></p><?php endforeach; endif; else: echo "$no" ;endif; ?>
                                </td>
                                <td><?php echo ($row["bus"]); ?></td>
                                <td>
                                    <?php if(is_array($row["bus_items"])): $k4 = 0; $__LIST__ = $row["bus_items"];if( count($__LIST__)==0 ) : echo "$no" ;else: foreach($__LIST__ as $key=>$bus): $mod = ($k4 % 2 );++$k4;?><p>用途：<span><?php echo ($bus["name"]); ?></span> 消费：<span><?php echo ($bus["consume"]); ?></span></p><?php endforeach; endif; else: echo "$no" ;endif; ?>
                                </td>
                                <td><?php echo ($row["other"]); ?></td>
                                <td>
                                    <?php if(is_array($row["other_items"])): $k5 = 0; $__LIST__ = $row["other_items"];if( count($__LIST__)==0 ) : echo "$no" ;else: foreach($__LIST__ as $key=>$other): $mod = ($k5 % 2 );++$k5;?><p>用途：<span><?php echo ($other["name"]); ?> </span>消费：<span><?php echo ($other["consume"]); ?></span></p><?php endforeach; endif; else: echo "$no" ;endif; ?>
                                </td>
                                <td><?php echo ($row["total"]); ?></td>
                                <td>
                                    <span class="glyphicon glyphicon-edit color-orange" id="<?php echo ($row["id"]); ?>" title="暂不支持修改" style="cursor: pointer"></span>
                                    <span class="glyphicon glyphicon-remove color-orange deletebtn" id="<?php echo ($row["id"]); ?>" title="删除" style="cursor: pointer"></span>
                                </td>
                            </tr><?php endforeach; endif; else: echo "$no" ;endif; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="empty"><img src="/Charge/Public/images/nodata.png"></div><?php endif; ?>
            </div>
        </div>
    </div>
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
                    系统通知
                </h4>
            </div>
            <div class="modal-body" id="modal-body" style="text-align: center" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                        data-dismiss="modal">关闭
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->

</div><!--/.main-->

<link href="/Charge/Public/css/bootstrap-table.css" rel="stylesheet">
<link href="/Charge/Public/css/styles.css" rel="stylesheet">

<script src="/Charge/Public/js/bootstrap-table.js"></script>
<script src="/Charge/Public/js/app.js"></script>
</div>



</body>

</html>