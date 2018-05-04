<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.10.2017
 * Time: 09:35
 */

namespace controller;


class HttpHandler
{

    public function isPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public function isGet(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        } else {
            return false;
        }
    }

    public function getData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = [];
            foreach ($_POST as $key => $value)
            {
                $post[$key] =  htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
            return $post;
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $get = htmlspecialchars($_GET, ENT_QUOTES, 'UTF-8');
            return $get;
        }
    }

    public function redirect(string $controller, string $action)
    {
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/" . $controller . "/" . $action);
    }

}