<?php
namespace Common\Utils;

use Think\Log;

/**
 * 网络请求类
 *
 * @author lee
 * @version 1.0.0 2015-7-17 下午5:05:32
 */
class CurlUtil
{

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
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // HTTP请求头中"Accept-Encoding: "的值。支持的编码有"identity"，"deflate"和"gzip"。
        // 如果为空字符串""，请求头会发送所有支持的编码类型
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        // 设置cURL允许执行的最长秒数。
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $headers[] = 'X-FORWARDED-FOR:' . self::getIP();
        $headers[] = 'CLIENT-IP:' . self::getIP();
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        // 执行一个cURL会话,函数执行成功时会返回执行的结果，失败时返回 FALSE
        $result = curl_exec($ch);
        // 获取最后一个收到的HTTP代码
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (! $result)
        {
            Log::record('http请求失败：http响应码为' . $httpcode . ' [ERR NUMBER:' . curl_errno($ch) . '][URL:' . $url . ']', Log::ERR);
        } else
        {
            Log::record('请求地址：' . $url . ' ；返回结果： ' . $result, Log::DEBUG);
        }
        
        // 关闭cURL会话
        curl_close($ch);
        // 返回http代码和执行结果
        return $result;
    }

    /**
     * 获取客户端ip地址
     *
     * @return Ambigous <unknown, string> ip地址
     * @author 李磊
     * @version 1.0.0 2014-5-21 下午1:18:29
     */
    public static function getIP()
    {
        if (getenv('HTTP_CLIENT_IP'))
        {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED'))
        {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR'))
        {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED'))
        {
            $ip = getenv('HTTP_FORWARDED');
        } else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
?>