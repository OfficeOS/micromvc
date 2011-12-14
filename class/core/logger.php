<?php
/**
 * 日志
 * @author corriezhao
 *
 */

namespace Core;

abstract class Logger {
    protected $messages = array();
    protected $level = 0;
    
    const LEVEL_DEBUG = 0;
    const LEVEL_NOTICE = 1;
    const LEVEL_WARN = 2;
    const LEVEL_ERROR = 3;
    const LEVEL_CRITICAL = 4;
    
    private static $levels = array(
        self::LEVEL_DEBUG => 'debug',
    	self::LEVEL_WARN => 'warn',
    	self::LEVEL_NOTICE =>'notice',
    	self::LEVEL_ERROR => 'error',
    	self::LEVEL_CRITICAL => 'critical',
    );
    
    /**
     * factroy a logger
     * @param string $name
     * @return Log
     */
    public static function factory($name = 'default')
    {
        if(!$config = Config::get("logger.{$name}"))
        {
            throw new Exception('Config not exists for logger->' . $name);
        }
        $class = '\Core\Logger\\' . $config['driver'];
        return new $class($config);
    }

    /**
     * instance a logger
     * @param string $name
     * @return Log
     */
    public static function instance($name = 'default')
    {
        $instance = array();
        if(!isset($instance[$name]))
        {
            $instance[$name] = self::factory($name);
        }
        return $instance[$name];
    }

    public function log($msg, $level = self::LEVEL_NOTICE) 
    {
        if($level < $this->level)
        {
            return;
        }
        $message = array(
            'id' => isset($_SERVER['HTTP_REQUEST_ID']) ? $_SERVER['HTTP_REQUEST_ID'] : '',
            'type' => 'message',
            'timestamp' => microtime(true),
            'msg' => $msg,
            'level' => self::$levels[$level],
            'ip' => $_SERVER['REMOTE_ADDR'],
        );
        $this->messages[] = $message;
    }
    
    public function __call($method, $params)
    {
        if(($level = array_search($method, self::$levels)) !== false)
        {
            $this->log($params[0], $level);
        }
        else
       {
            throw new \BadMethodCallException('Bad Mehtod Call on Logger->' . $method);    
        }
        
    }

    abstract protected function write();

    function __destruct() {
        //析构时写入
        $this->write();
    }
}