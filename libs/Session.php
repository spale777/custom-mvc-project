<?php

class Session
{
    public static function renew()
    {
        session_regenerate_id(true);
    }

    public static function unsetKeys($key = false)
    {
        if ($key) {
            foreach($key as $key) {
                unset($_SESSION[$key]);
            }
        } else {
            foreach ($_SESSION as $key => $value) {
                unset ($_SESSION[$key]);
            }
        }
    }

    public static function init()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

}