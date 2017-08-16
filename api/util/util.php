<?php
if (! defined('CORE'))
{
    exit('Request Error!');
}

/**
 * 实用函数集合
 *
 * 替代lib_common
 *
 * @author itprato<445307582@qq>
 * @version $Id$
 */
class util
{

    public static $client_ip = null;

    public static $cfc_handle = null;

    /**
     * 获得用户的真实IP 地址
     *
     * @param
     *            多个用多行分开
     * @return void
     */
    public static function get_client_ip()
    {
        static $realip = null;
        if (self::$client_ip !== null)
        {
            return self::$client_ip;
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR2']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR2']);
            foreach ($arr as $ip)
            {
                $ip = trim($ip);
                if ($ip != 'unknown')
                {
                    $realip = $ip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($arr as $ip)
            {
                $ip = trim($ip);
                if ($ip != 'unknown')
                {
                    $realip = $ip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        } else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            } else
            {
                $realip = '0.0.0.0';
            }
        }
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        self::$client_ip = ! empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return self::$client_ip;
    }

    /**
     * 写文件
     */
    function put_file($file, $content, $flag = 0)
    {
        $pathinfo = pathinfo($file);
        if (! empty($pathinfo['dirname']))
        {
            if (file_exists($pathinfo['dirname']) === false)
            {
                if (@mkdir($pathinfo['dirname'], 0777, true) === false)
                {
                    return false;
                }
            }
        }
        if ($flag === FILE_APPEND)
        {
            return @file_put_contents($file, $content, FILE_APPEND);
        } else
        {
            return @file_put_contents($file, $content, LOCK_EX);
        }
    }

    /**
     * 获得当前的Url
     */
    public static function get_cururl()
    {
        if (! empty($_SERVER["REQUEST_URI"]))
        {
            $scriptName = $_SERVER["REQUEST_URI"];
            $nowurl = $scriptName;
        } else
        {
            $scriptName = $_SERVER["PHP_SELF"];
            $nowurl = empty($_SERVER["QUERY_STRING"]) ? $scriptName : $scriptName . "?" . $_SERVER["QUERY_STRING"];
        }
        return $nowurl;
    }

    /**
     * 检查路径是否存在
     * @parem $path
     *
     * @return bool
     */
    public static function path_exists($path)
    {
        $pathinfo = pathinfo($path . '/tmp.txt');
        if (! empty($pathinfo['dirname']))
        {
            if (file_exists($pathinfo['dirname']) === false)
            {
                if (mkdir($pathinfo['dirname'], 0777, true) === false)
                {
                    return false;
                }
            }
        }
        return $path;
    }

    /**
     * 判断是否为utf8字符串
     * @parem $str
     *
     * @return bool
     */
    public static function is_utf8($str)
    {
        if ($str === mb_convert_encoding(mb_convert_encoding($str, "UTF-32", "UTF-8"), "UTF-8", "UTF-32"))
        {
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * 公共分页函数
     *
     * @param array $config
     *            $config['current_page'] //当前页数
     *            $config['page_size'] //每页显示多少条
     *            $config['total_rs'] //总记录数
     *            $config['url_prefix'] //网址前缀
     *            $config['page_name'] //当前分页变量名(默认是page_no， 即访问是用 url_prefix&page_no=xxx )
     *            $config['move_size'] //前后偏移量（默认是5）
     *            $config['input'] //是否使用输入跳转框(0|1)
     *            输出格式：
     *            <div class="page">
     *            <span class="nextprev">&laquo; 上一页</span>
     *            <span class="current">1</span>
     *            <a href="">2</a>
     *            <a href="" class="nextprev">下一页 &raquo;</a>
     *            <span>共 100 页</span>
     *            </div>
     *            
     * @return string
     */
    public static function pagination($config)
    {
        // 参数处理
        $url_prefix = empty($config['url_prefix']) ? '' : $config['url_prefix'];
        $current_page = empty($config['current_page']) ? 1 : intval($config['current_page']);
        $page_name = empty($config['page_name']) ? 'page_no' : $config['page_name'];
        $page_size = empty($config['page_size']) ? 0 : intval($config['page_size']);
        $total_rs = empty($config['total_rs']) ? 0 : intval($config['total_rs']);
        $total_page = ceil($total_rs / $page_size);
        $move_size = empty($config['move_size']) ? 5 : intval($config['move_size']);
        
        // 总页数不到二页返回空
        if ($total_page < 2)
        {
            return '';
        }
        
        // 分页内容
        $pages = '<div class="pagenumber">';
        
        // 下一页
        $next_page = $current_page + 1;
        // 上一页
        $prev_page = $current_page - 1;
        // 末页
        $last_page = $total_page;
        
        // 上一页、首页
        if ($current_page > 1)
        {
            $pages .= "<a href='{$url_prefix}' class='first-page'>首页</a>\n";
            $pages .= "<a href='{$url_prefix}&{$page_name}={$prev_page}' class='prev'>&laquo;&lt;</a>\n";
        } else
        {
            $pages .= "<a class='first-page'>首页</a>\n";
            $pages .= "<a class='prev'>&laquo;&lt;</a>\n";
        }
        
        // 前偏移
        for ($i = $current_page - $move_size; $i < $current_page; $i ++)
        {
            if ($i < 1)
            {
                continue;
            }
            $pages .= "<a href='{$url_prefix}&{$page_name}={$i}'>$i</a>\n";
        }
        // 当前页
        $pages .= "<span class='current'>" . $current_page . "</span>\n";
        
        // 后偏移
        $flag = 0;
        if ($current_page < $total_page)
        {
            for ($i = $current_page + 1; $i <= $total_page; $i ++)
            {
                $pages .= "<a href='{$url_prefix}&{$page_name}={$i}'>$i</a>\n";
                $flag ++;
                if ($flag == $move_size)
                {
                    break;
                }
            }
        }
        
        // 下一页、末页
        if ($current_page != $total_page)
        {
            $pages .= "<a href='{$url_prefix}&{$page_name}={$next_page}' class='next'>&gt;&raquo;</a>\n";
            $pages .= "<a href='{$url_prefix}&{$page_name}={$last_page}' class='last-page'>末页</a>\n";
        } else
        {
            $pages .= "<a class='next'>&gt;&raquo;</a>\n";
            $pages .= "<a class='last-page'>末页</a>\n";
        }
        
        // 增加输入框跳转
        if (! empty($config['input']))
        {
            $pages .= '<input type="text" class="page" onkeydown="javascript:if(event.keyCode==13){ location=\'' . $url_prefix . '&' . $page_name .
                 '=\'+this.value; }" onkeyup="value=value.replace(/[^\d]/g,\'\')" />';
        }
        
        $pages .= "<span>共 {$total_page} 页 / {$total_rs} 条记录</span>\n";
        $pages .= '</div>';
        
        return $pages;
    }

    /**
     * utf8编码模式的中文截取2，单字节截取模式
     * 这里不使用mbstring扩展
     *
     * @return string
     */
    public static function utf8_substr($str, $slen, $startdd = 0)
    {
        return mb_substr($str, $startdd, $slen, 'UTF-8');
    }

    /**
     * 从普通时间返回Linux时间截(strtotime中文处理版)
     * @parem string $dtime
     *
     * @return int
     */
    public static function cn_strtotime($dtime)
    {
        if (! preg_match("/[^0-9]/", $dtime))
        {
            return $dtime;
        }
        $dtime = trim($dtime);
        $dt = Array(
            1970,
            1,
            1,
            0,
            0,
            0
        );
        $dtime = preg_replace("/[\r\n\t]|日|秒/", " ", $dtime);
        $dtime = str_replace("年", "-", $dtime);
        $dtime = str_replace("月", "-", $dtime);
        $dtime = str_replace("时", ":", $dtime);
        $dtime = str_replace("分", ":", $dtime);
        $dtime = trim(preg_replace("/[ ]{1,}/", " ", $dtime));
        $ds = explode(" ", $dtime);
        $ymd = explode("-", $ds[0]);
        if (! isset($ymd[1]))
        {
            $ymd = explode(".", $ds[0]);
        }
        if (isset($ymd[0]))
        {
            $dt[0] = $ymd[0];
        }
        if (isset($ymd[1]))
        {
            $dt[1] = $ymd[1];
        }
        if (isset($ymd[2]))
        {
            $dt[2] = $ymd[2];
        }
        if (strlen($dt[0]) == 2)
        {
            $dt[0] = '20' . $dt[0];
        }
        if (isset($ds[1]))
        {
            $hms = explode(":", $ds[1]);
            if (isset($hms[0]))
            {
                $dt[3] = $hms[0];
            }
            if (isset($hms[1]))
            {
                $dt[4] = $hms[1];
            }
            if (isset($hms[2]))
            {
                $dt[5] = $hms[2];
            }
        }
        foreach ($dt as $k => $v)
        {
            $v = preg_replace("/^0{1,}/", '', trim($v));
            if ($v == '')
            {
                $dt[$k] = 0;
            }
        }
        $mt = mktime($dt[3], $dt[4], $dt[5], $dt[1], $dt[2], $dt[0]);
        if (! empty($mt))
        {
            return $mt;
        } else
        {
            return strtotime($dtime);
        }
    }
    
    // 将中文进行 urlencode 转换
    public static function q_encode($str)
    {
        $data_code = "";
        $data = array_filter(explode(" ", $str));
        $data = array_flip(array_flip($data));
        foreach ($data as $ss)
        {
            if (strlen($ss) > 1)
            {
                $data_code .= str_replace("%", "", urlencode($ss)) . " ";
            }
        }
        $data_code = trim($data_code);
        return $data_code;
    }

    public static function get_domain($url)
    {
        $pattern = "/[\w-]+\.(com|net|org|gov|cc|biz|info|cn)(\.(cn|hk))*/";
        preg_match($pattern, $url, $matches);
        if (count($matches) > 0)
        {
            return $matches[0];
        } else
        {
            $rs = parse_url($url);
            $main_url = $rs["host"];
            if (! strcmp(long2ip(sprintf("%u", ip2long($main_url))), $main_url))
            {
                return $main_url;
            } else
            {
                $arr = explode(".", $main_url);
                $count = count($arr);
                $endArr = array(
                    "com",
                    "net",
                    "org",
                    "3322"
                ); // com.cn net.cn 等情况
                if (in_array($arr[$count - 2], $endArr))
                {
                    $domain = $arr[$count - 3] . "." . $arr[$count - 2] . "." . $arr[$count - 1];
                } else
                {
                    $domain = $arr[$count - 2] . "." . $arr[$count - 1];
                }
                return $domain;
            } // end if(!strcmp...)
        } // end if(count...)
    }
    // end function
    
    /**
     * getConstellation 根据出生生日取得星座
     *
     * @param String $brithday
     *            用于得到星座的日期 格式为yyyy-mm-dd
     *            
     * @param Array $format
     *            用于返回星座的名称
     *            
     * @return String
     */
    public static function get_constellation($birthday, $format = null)
    {
        $pattern = '/^\d{4}-\d{1,2}-\d{1,2}$/';
        if (! preg_match($pattern, $birthday, $matchs))
        {
            return null;
        }
        $date = explode('-', $birthday);
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
        {
            return null;
        }
        // 设定星座数组
        $constellations = array(
            '摩羯座',
            '水瓶座',
            '双鱼座',
            '白羊座',
            '金牛座',
            '双子座',
            '巨蟹座',
            '狮子座',
            '处女座',
            '天秤座',
            '天蝎座',
            '射手座'
        );
        
        // 或
        /*
         * $constellations = array(
         * 'Capricorn', 'Aquarius', 'Pisces', 'Aries', 'Taurus', 'Gemini',
         * 'Cancer','Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius',);
         */
        
        // 设定星座结束日期的数组，用于判断
        $enddays = array(
            19,
            18,
            20,
            20,
            20,
            21,
            22,
            22,
            22,
            22,
            21,
            21
        );
        // 如果参数format被设置，则返回值采用format提供的数组，否则使用默认的数组
        if ($format != null)
        {
            $values = $format;
        } else
        {
            $values = $constellations;
        }
        // 根据月份和日期判断星座
        switch ($month)
        {
            case 1:
                if ($day <= $enddays[0])
                {
                    $constellation = $values[0];
                } else
                {
                    $constellation = $values[1];
                }
                break;
            case 2:
                if ($day <= $enddays[1])
                {
                    $constellation = $values[1];
                } else
                {
                    $constellation = $values[2];
                }
                break;
            case 3:
                if ($day <= $enddays[2])
                {
                    $constellation = $values[2];
                } else
                {
                    $constellation = $values[3];
                }
                break;
            case 4:
                if ($day <= $enddays[3])
                {
                    $constellation = $values[3];
                } else
                {
                    $constellation = $values[4];
                }
                break;
            case 5:
                if ($day <= $enddays[4])
                {
                    $constellation = $values[4];
                } else
                {
                    $constellation = $values[5];
                }
                break;
            case 6:
                if ($day <= $enddays[5])
                {
                    $constellation = $values[5];
                } else
                {
                    $constellation = $values[6];
                }
                break;
            case 7:
                if ($day <= $enddays[6])
                {
                    $constellation = $values[6];
                } else
                {
                    $constellation = $values[7];
                }
                break;
            case 8:
                if ($day <= $enddays[7])
                {
                    $constellation = $values[7];
                } else
                {
                    $constellation = $values[8];
                }
                break;
            case 9:
                if ($day <= $enddays[8])
                {
                    $constellation = $values[8];
                } else
                {
                    $constellation = $values[9];
                }
                break;
            case 10:
                if ($day <= $enddays[9])
                {
                    $constellation = $values[9];
                } else
                {
                    $constellation = $values[10];
                }
                break;
            case 11:
                if ($day <= $enddays[10])
                {
                    $constellation = $values[10];
                } else
                {
                    $constellation = $values[11];
                }
                break;
            case 12:
                if ($day <= $enddays[11])
                {
                    $constellation = $values[11];
                } else
                {
                    $constellation = $values[0];
                }
                break;
        }
        return $constellation;
    }

    function getExplorer()
    {
        if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 8.0"))
        {
            return "Explorer";
        } else
        {
            if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 7.0"))
            {
                return "Explorer";
            } else
            {
                if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 6.0"))
                {
                    return "Explorer";
                } else
                {
                    if (strpos($_SERVER["HTTP_USER_AGENT"], "Firefox/3"))
                    {
                        return "Firefox";
                    } else
                    {
                        if (strpos($_SERVER["HTTP_USER_AGENT"], "Firefox/2"))
                        {
                            return "Firefox";
                        } else
                        {
                            if (strpos($_SERVER["HTTP_USER_AGENT"], "Chrome"))
                            {
                                return "Chrome";
                            } else
                            {
                                if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari"))
                                {
                                    return "Safari";
                                } else
                                {
                                    if (strpos($_SERVER["HTTP_USER_AGENT"], "Opera"))
                                    {
                                        return "Opera";
                                    } else
                                    {
                                        return $_SERVER["HTTP_USER_AGENT"];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function randomkeys($length)
    {
        $pattern = '1234567890abcdefhijklmnopqrstuvwxyzABCDEFHIJKLOMNOPQRSTUVWXYZ';
        $key = '';
        for ($i = 0; $i < $length; $i ++)
        {
            $key .= $pattern{mt_rand(0, 35)}; // 生成php随机数
        }
        return $key;
    }

    /**
     * Ajax方式返回数据到客户端
     *
     * @param mixed $data
     *            要返回的数据
     * @param String $type
     *            AJAX返回数据格式
     * @return void 默认AJAX 数据返回格式,可选JSON XML ...
     */
    public static function ajaxReturn($data, $type = '')
    {
        if (empty($type))
        {
            $type = 'JSON';
        }
        switch (strtoupper($type))
        {
            case 'JSON':
                exit(json_encode($data));
            case 'XML':
                exit(); // 待完善
            case 'JSONP':
                exit(); // 待完善
            case 'EVAL':
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
        }
    }

    /**
     * Ajax方式返回数据到客户端
     *
     * @param mixed $msg
     *            错误信息
     * @param int $code
     *            错误编码
     * @param String $type
     *            AJAX返回数据格式
     * @return void 默认AJAX 数据返回格式,可选JSON XML ...
     *         返回格式 {'status':false,msg:{...}}
     */
    public static function ajaxError($msg = '', $code = -1, $type = '')
    {
        $new = array();
        $new['status'] = 'failure';
        $new['code'] = $code;
        $new['msg'] = $msg;
        self::ajaxReturn($new, $type);
    }

    /**
     * Ajax方式返回数据到客户端
     *
     * @param mixed $data
     *            要返回的数据
     * @param int $code
     *            返回编码
     * @param String $type
     *            AJAX返回数据格式
     * @param int $count
     *            总结果条数，部分分页返回的接口使用
     * @return void 默认AJAX 数据返回格式,可选JSON XML ...
     *         格式 {'state':status,msg:{...}}
     */
    public static function ajaxTrue($data, $code = '', $count = '', $type = '')
    {
        $new = array();
        $new['status'] = 'success';
        $new['data'] = $data;
        if ($code !== '')
        {
            $new['code'] = $code;
        }
        if ($count !== '')
        {
            $new['total'] = $count;
        }
        self::ajaxReturn($new, $type);
    }

    /**
     * 统一返回
     *
     * @param unknown $data            
     * @param string $type            
     */
    public static function ajaxCommon($data, $type = '')
    {
        if (empty($type))
        {
            $type = 'JSON';
        }
        switch (strtoupper($type))
        {
            case 'JSON':
                exit(json_encode($data));
            case 'XML':
                exit(); // 待完善
            case 'JSONP':
                exit(); // 待完善
            case 'EVAL':
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
        }
    }

    /**
     * 输出堆栈信息
     *
     * @return string
     */
    public static function print_stack_trace()
    {
        $array = debug_backtrace();
        unset($array[0]);
        $html = '';
        foreach ($array as $row)
        {
            $html .= $row['file'] . ':' . $row['line'] . '行,调用方法:' . $row['function'] . "<p>";
        }
        return $html;
    }

    /**
     * 验证debugkey的方法
     *
     * @version 1.0.0 2016年8月5日 上午9:51:43
     * @author lilei
     */
    private static function debugkey()
    {
        return md5($GLOBALS['config']['system']['VERSION']);
    }

    /**
     * 验证sigtime
     *
     * @param unknown $sigtime            
     */
    public static function check($data)
    {
        $check_result = array();
        $check_result['status'] = 'failure';
        $debug_key = $data['cdkey'];
        if ($GLOBALS['config']['system']['IS_DEBUG'] == true)
        {
            $debug_key = self::debugkey();
        }
        if ($debug_key && $debug_key == self::debugkey())
        {
            $check_result['status'] = 'success';
            return $check_result;
        } else
        {
            $sign = $data['sign'];
            $time = $data['time'];
            // 签名步骤一：按字典序排序参数
            ksort($data);
            $buff = '';
            // 去掉签名和cdkey
            unset($data['sign']);
            unset($data['cdkey']);
            // 签名步骤二：在数组最后加入KEY
            $data['key'] = $GLOBALS['config']['system']['CHECK_KEY'];
            // 将数组使用&k=v拼接
            foreach ($data as $k => $v)
            {
                $data[$k] = $k . '=' . $v;
            }
            $buff = join('&', $data);
            // 签名步骤三：MD5加密
            $string = md5($buff);
            // 签名步骤四：所有字符转为大写
            $result = strtoupper($string);
            // 验证签名
            if ($result == $sign)
            {
                // 验证时间
                $now = time();
                if (abs($now - $time) <= $GLOBALS['config']['system']['EFFECTIVE_TIME'])
                {
                    $check_result['status'] = 'success';
                    return $check_result;
                } else
                {
                    $check_result['msg'] = '请求超时';
                    return $check_result;
                }
            } else
            {
                $check_result['msg'] = '签名错误';
                return $check_result;
            }
        }
    }

    /**
     * 检查参数是否有空
     *
     * @param array $parameter
     *            需要检测的参数数组
     */
    public static function check_param($parameter)
    {
        $result = true;
        
        // 如果是数组
        if (is_array($parameter))
        {
            Log::debug('需要验证的参数数组:' . json_encode($parameter));
            foreach ($parameter as $k)
            {
                $val = request($k);
                if ($val == null || $val == '')
                {
                    Log::error('参数' . $k . '的值为空;请求参数:' . json_encode(req::$forms));
                    util::ajaxError('参数' . $k . '的值为空');
                }
            }
        } else
        {
            Log::debug('需要验证的参数' . $parameter);
            $val = request($parameter);
            if ($val == null || $val == '')
            {
                Log::error('参数:' . $parameter . '值为空;请求参数:' . json_encode(req::$forms));
                util::ajaxError('参数:' . $parameter . '值为空');
            }
        }
        
        return $result;
    }

    /**
     * 请求URL地址，并得到返回信息
     *
     * @param string $url
     *            地址
     * @param String $method
     *            请求类型
     * @param array $data
     *            参数数组
     * @param string $contentType
     *            提交内容类型
     * @param string $accept
     *            接收返回內容類型
     * @param boolean $xhr
     *            是否模拟xmlhttprequest
     * @param boolean $ssl
     *            是否使用ssl鏈接
     * @return multitype:mixed
     * @author 李磊
     * @version 1.0.0 2015-7-17 下午5:05:49
     */
    public static function curl($url, $method = 'GET', $data = array(), $contentType = null, $accept = null, $xhr = false, $ssl = false)
    {
        // 初始化一个cURL会话
        $ch = curl_init();
        // 设置使用一个自定义的请求信息来代替"GET"或"HEAD"作为HTTP请求
        if ($method !== 'GET')
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else
        {
            // 处理参数
            if (count($data) > 0)
            {
                $str = '';
                foreach ($data as $k => $v)
                {
                    $str .= '&' . $k . '=' . $v;
                }
                if (strpos($url, '?') !== false)
                {
                    $url .= $str;
                } else
                {
                    $url .= '?' . substr($str, 1);
                }
            }
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        }
        // 设置需要获取的URL地址
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        // 返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // HTTP请求头中"Accept-Encoding: "的值。支持的编码有"identity"，"deflate"和"gzip"。
        // 如果为空字符串""，请求头会发送所有支持的编码类型
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        // 设置cURL允许执行的最长秒数。
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $headers[] = 'X-FORWARDED-FOR:' . util::get_client_ip();
        $headers[] = 'CLIENT-IP:' . util::get_client_ip();
        if ($xhr == true)
        {
            $headers[] = 'X-Requested-With: XMLHttpRequest';
        }
        if ($accept != null)
        {
            $headers[] = 'ACCEPT:' . $accept;
        }
        // 设置请求头
        if ($contentType != null)
        {
            $headers[] = 'Content-Type: ' . $contentType;
        }
        // 设置请求头的IP地址
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // ssl设置
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        // 执行一个cURL会话,函数执行成功时会返回执行的结果，失败时返回 FALSE
        $result = curl_exec($ch);
        // 获取最后一个收到的HTTP代码
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (! $result)
        {
            Log::error('http请求失败：http响应码为' . $httpcode . ' [ERR NUMBER:' . curl_errno($ch) . '][URL:' . $url . ']');
        } else
        {
            Log::debug('请求地址：' . $url . ' ；返回结果： ' . $result);
        }
        
        // 关闭cURL会话
        curl_close($ch);
        // 返回http代码和执行结果
        return $result;
    }

    /**
     * 生成uuid
     *
     * @return string
     * @version 1.0.0 2015年7月24日 下午3:21:08
     * @author lilei
     */
    public static function getUUid()
    {
        $chars = strtolower(md5(uniqid(rand())));
        $uuid = substr($chars, 0, 8);
        $uuid .= substr($chars, 8, 4);
        $uuid .= substr($chars, 12, 4);
        $uuid .= substr($chars, 16, 4);
        $uuid .= substr($chars, 20, 12);
        return $uuid;
    }

    public static function sort($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
    {
        if (is_array($arrays))
        {
            foreach ($arrays as $array)
            {
                if (is_array($array))
                {
                    $key_arrays[] = $array[$sort_key];
                } else
                {
                    return false;
                }
            }
        } else
        {
            return false;
        }
        array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
        return $arrays;
    }

    public static function obj2arr($object)
    {
        $array = array();
        if (is_object($object))
        {
            foreach ($object as $key => $value)
            {
                $array[$key] = $value;
            }
        } else
        {
            $array = $object;
        }
        return $array;
    }
}