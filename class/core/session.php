<?php
/**
 * Session
 *
 * Stores session data in encrypted cookies to save database/memcached load .
 * Flash uploaders and session masquerading should make use of the open() method
 * to allow hyjacking of sessions . Sessions stored in cookies must be under 4KB .
 *
 * Also make sure to call the token methods if using forms to help prevent CSFR .
 * <input value = "<?php print Session::token();
?>" name = "token" />
 *
 * @package        MicroMVC
 * @author         David Pennington
 * @copyright      (c) 2011 MicroMVC Framework
 * @license        http://micromvc.com/license
 ********************************** 80 Columns *********************************
 */
namespace Core;

class Session
{

    protected static $sessions;

    /**
     * Configure the session settings, check for problems, and then start the session .
     *
     * @param array $config an optional configuration array
     * @return boolean
     */
    public static function start($name = 'SESSION')
    {
        // Was the session already started?
        if (!empty($_SESSION)) return FALSE;
        static::$sessions = $_SESSION = Cookie::get($name);
        return TRUE;
    }


    /**
     * Called at end-of-page to save the current session data to the session cookie
     *
     * return boolean
     */
    public static function save($name = 'SESSION')
    {
        if (static::$sessions != $_SESSION) {
            return Cookie::set($name, $_SESSION);
        }
    }


    /**
     * Destroy the current users session
     */
    public static function destroy($name = 'SESSION')
    {
        Cookie::set($name, '');
        unset($_COOKIE[$name]);
        foreach ($_SESSION as $k => $v) {
            unset($_SESSION[$k]);
        }
    }


    /**
     * Create new session token or validate the token passed
     *
     * @param string $token value to validate
     * @return string|boolean
     */
    public static function token($token = NULL)
    {
        if (!isset($_SESSION)) return FALSE;

        // If a token is given, then lets match it
        if ($token !== NULL) {
            if (!empty($_SESSION['token']) && $token === $_SESSION['token']) {
                return TRUE;
            }

            return FALSE;
        }

        return $_SESSION['token'] = token();
    }

}

// END