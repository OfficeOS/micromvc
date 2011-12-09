<?php
/**
 * 缓存
 * @author corriezhao
 *
 */
namespace Core;

abstract class Cache {
    private static $config = array();

    /**
     * Cache Factory
     * @param string $name
     * @return Cache
     */
    public static function factory($name = 'default')
    {
        if(!$config = config('Cache')->$name)
        {
            return false;
        }
        $class = '\Core\Cache\\' . ucfirst(strtolower($config['driver']));
        return new $class($config);
    }
    
	/**
     * Instance Cache
     * @param string $name
     * @return Cache
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
    
    public function set($key, $vlaue, $timeout = 0){}
    
    public function get($key){}
    
    public function delete($key){}   
}