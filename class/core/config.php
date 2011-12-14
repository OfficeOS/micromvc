<?php
/**
 * Config
 * @author Corrie Zhao <hfcorriez@gmail.com>
 */

namespace Core;

class Config {
    public static $config = array();

    /**
     * init config
     * @param array $config		values
     */
    public static function setup($config){
        self::$config = $config;
    }

    /**
     * get config
     * @param string $key
     */
    public static function get($key = false, $default = null){
        $tmp = $default;
        if (strpos($key, '.') !== false) 
        {
            $key_array = explode('.', $key);
            $count = count($key_array);
            if(isset(self::$config[$key_array [0]]))
            {
                $tmp = self::$config[$key_array [0]];
                for ($i = 1; $i < $count; $i++) 
                {
                    $k = $key_array [$i];
                    if (!isset($tmp [$k])) 
                    {
                        $tmp = $default;
                        break;
                    } 
                    else 
                 {
                        $tmp = $tmp [$k];
                    }
                }
            }
        }
        else 
       {
            if(isset(self::$config[$key]))
            {
                $tmp = self::$config[$key];
            }
        }
        return $tmp;
    }

    /**
     * set config
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value){
        if (strpos($key, '.') !== false) 
        {
            $key_array = explode('.', $key);
            $c = count($key_array);
            $tmp = & self::$config[$key_array [0]];
            for ($i = 1; $i < $c; $i++) 
            {
                $tmp = & $tmp[$key_array[$i]];
                if ($i == $c - 1) $tmp = $value;
            }
        } 
        else
       {
            self::$config[$key] = $value;
        }
    }
}