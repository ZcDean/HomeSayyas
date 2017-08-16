<?php

class Logger
{

    private $file = '';

    private $isDebug = true;

    public function __construct($isDebug = true)
    {
        $this->file = './logs/' . date('Y-m-d') . '-record.log';
        $this->isDebug = $isDebug;
    }

    public function record($msg, $level = 'ERROR')
    {
        // 只记录error级别，除非指定isDebug为true
        if ($this->isDebug || in_array($level, $GLOBALS['config']['log']['log_record_level']))
        {
            $logName = $this->file;
            // 单个日志最大100M
            if (file_exists($logName) && filesize($logName) > 104857600)
            {
                $newname = './logs/' . date('Y-m-d') . '_' . time() . '-record.log';
                rename($logName, $newname);
            }
            $logContent = '[' . date('Y-m-d H:i:s') . '][' . self::getClientIP() . "][$level] " . $msg . "\r\n";
            if ($this->isDebug)
            {
                $logContent = '[DEBUG]|' . $logContent;
            }
            file_put_contents($logName, $logContent, FILE_APPEND);
        }
    }

    public static function getClientIP()
    {
        $unknown = 'unknown';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown))
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if (false !== strpos($ip, ','))
        {
            $ip = reset(explode(',', $ip));
        }
        return $ip;
    }
}

class Log
{

    private static $instance = null;

    public static function INIT($logger = null)
    {
        if ($logger instanceof Logger)
        {
            self::$instance = $logger;
        } else
        {
            self::$instance = new Logger();
        }
    }

    public static function debug($msg)
    {
        if (self::$instance == null)
        {
            self::INIT();
        }
        self::$instance->record($msg, 'DEBUG');
    }

    public static function info($msg)
    {
        if (self::$instance == null)
        {
            self::INIT();
        }
        self::$instance->record($msg, 'INFO');
    }

    public static function error($msg, $exception = null, $filename = null)
    {
        if (self::$instance == null)
        {
            self::INIT();
        }
        if ($exception !== null && is_subclass_of($exception, '\Exception'))
        {
            self::$instance->record($msg . "\r\n\t" . $exception->getMessage(), 'ERROR', $filename);
        } else
        {
            self::$instance->record($msg, 'ERROR', $filename);
        }
    }
}
?>