<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.10.2017
 * Time: 11:32
 */

namespace services;


use PDO;

class DBConnection
{
    private static $instance = null;
    private $config;

    /**
     * DBConnection constructor.
     * @param $config
     */
    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__.'/../config/database.ini');

    }

    public static function instance()
    {
      if(DBConnection::$instance == null)
      {
          DBConnection::$instance = new PDO('mysql:host=localhost;dbname=db_report','root','');
      }
      return DBConnection::$instance;
    }


}
