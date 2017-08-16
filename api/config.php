<?php

// 系统配置
$GLOBALS['config']['system'] = array(
	// 版本号
		'VERSION' => '1.0.0',
	// 是否开启debug模式，此模式记录所有日志
		'IS_DEBUG' => true,
	// 是否开启错误报告
		'IS_ERROR_REPORT' => true,
	// 验证密钥
		'CHECK_KEY' => 'tvmining',
);

// 网站日志配置
$GLOBALS['config']['log'] = array(
	// 日志记录级别（IS_DEBUG为false才有效）
		'log_record_level' => array(
				'DEBUG',
				'INFO',
				'ERROR'
		)
);
//mysql数据库配置
$GLOBALS['config']['mysql'] = array(
		'host' => '127.0.0.1',
		'database' => 'sayyas',
		'user' => 'root',
		'password' => '',
		'port' => 3306
);

// 时区配置
$GLOBALS['config']['timezone_set'] = 'Asia/Shanghai';


?>