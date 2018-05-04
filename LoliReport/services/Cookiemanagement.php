<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 18.12.2017
 * Time: 09:46
 */

namespace services;


class Cookiemanagement
{

    public static function set($key,$value,$days)
    {
        if($days == true)
        {
            setcookie($key, $value, time() + (86400 * $days), "/");
        }else {
            setcookie($key, $value);
        }
    }

    public static function delete($key)
    {
        setcookie($key, "", time() - 1, "/");
    }

}