<?php
// 返回JSON数据格式到客户端 包含状态信息
header('Content-Type:application/json;');
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
//引入初始化文件
require 'init.php';
run_controller();
?>