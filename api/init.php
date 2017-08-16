<?php

/**
 * 框架核心入口文件
 *
 * 环境检查，核心文件加载
 *
 * @author itprato<2500875@qq>
 * @version $Id$
 */

// 核心库目录
define('CORE', dirname(__FILE__));

// 系统配置
require CORE . '/config.php';

// PHP报告模式
if ($GLOBALS['config']['system']['IS_ERROR_REPORT'] == true)
{
    error_reporting(E_ERROR);
} else
{
    error_reporting(0);
}

// 开启register_globals会有诸多不安全可能性，因此强制要求关闭register_globals
if (ini_get('register_globals'))
{
    exit('php.ini register_globals must is Off! ');
}

// 设置时区
date_default_timezone_set($GLOBALS['config']['timezone_set']);

// 外部请求程序处理(路由)
require CORE . '/util/req.php';
// 加载核心类库
include_once ('util/log.php');
include_once ('util/util.php');
include_once ('model/Medoo.php');
include_once ('model/db.php');
// 初始化日志类
$isDebug = $GLOBALS['config']['system']['IS_DEBUG'] || request('cdkey');
Log::INIT(new Logger($isDebug));

// 处理请求数据
req::init();

/**
 * 致命错误处理接口
 * 系统发生致命错误后的提示
 * (致命错误是指发生错误后要直接中断程序的错误，如数据库连接失败、找不到控制器等)
 */
function handler_fatal_error($errtype, $msg)
{
    $log_str = $errtype . ':' . $msg;
    if ($GLOBALS['config']['system']['IS_DEBUG'])
    {
        throw new Exception($log_str);
    } else
    {
        log::error($log_str);
    }
}

/**
 * 路由控制
 *
 * @param $ctl 控制器
 *            @parem $ac 动作
 * @return void
 */
function run_controller()
{
    try
    {
        $ac = preg_replace("/[^0-9a-z_]/i", '', req::item('a', 'index'));
        $ac = empty($ac) ? $ac = 'index' : $ac;
        
        $ctl = preg_replace("/[^0-9a-z_]/i", '', req::item('c', 'index'));
        $path_file = 'controller/' . $ctl . '.php';
        
        if (file_exists($path_file))
        {
            include_once ($path_file);
        } else
        {
            throw new Exception("Contrl {$path_file} is not exists!");
        }
        if (method_exists($ctl, $ac) === true)
        {
            $instance = new $ctl();
            $instance->$ac();
        } else
        {
            throw new Exception("Method {$ctl}::{$ac}() is not exists!");
        }
    } catch (Exception $e)
    {
//        handler_fatal_error('init.php run_controller()', $e->getMessage() . ' url:' . util::get_cururl());
        util::ajaxReturn(array(
            'status' => 'failure',
            'msg' => $e->getMessage(),
            'code' => '400'
        ));
    }
}

/**
 * req::item 别名函数
 */
function request($key, $df = '')
{
    return req::item($key, $df);
}