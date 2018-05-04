<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 18.12.2017
 * Time: 18:53
 */

namespace services;
use services\QueryBuilder;

class DatabaseSeeder
{
    protected function chekExistsUsers()
    {
        $query = new QueryBuilder();

        $myQuery = $query
            ->select("*")
            ->from("user")
            ->execute();

        if(count($myQuery->fetchAll()) == 0)
        {
            return false;
        }else {
            return true;
        }
    }

    public function run()
    {
        $user = $this->chekExistsUsers();
        if($user == false)
        {

            $query = new QueryBuilder();

            $pass = $this->returnEncryptedString("Pass1234");

            $query
                ->insert("user")
                ->addField("Username")
                ->addField("Firstname")
                ->addField("Lastname")
                ->addField("Email")
                ->addField("Password")
                ->addField("roleFk")
                ->addValue("jerom.r")
                ->addValue("Jerom")
                ->addValue("Rajan")
                ->addValue("jeromrajan@hotmail.com")
                ->addValue("$pass")
                ->addLastValue("1");

            $query
                ->insert("user")
                ->addField("Username")
                ->addField("Firstname")
                ->addField("Lastname")
                ->addField("Email")
                ->addField("Password")
                ->addField("roleFk")
                ->addValue("MuellerA")
                ->addValue("Alfred")
                ->addValue("Mueller")
                ->addValue("alfred.mueller@gmx.com")
                ->addValue("$pass")
                ->addLastValue("2");


            $query
                ->insert("user")
                ->addField("Username")
                ->addField("Firstname")
                ->addField("Lastname")
                ->addField("Email")
                ->addField("Password")
                ->addField("roleFk")
                ->addValue("Peter")
                ->addValue("Peter")
                ->addValue("Griffin")
                ->addValue("peter.griffin@gmail.com")
                ->addValue("$pass")
                ->addLastValue("2");

            $query
                ->insert("user")
                ->addField("Username")
                ->addField("Firstname")
                ->addField("Lastname")
                ->addField("Email")
                ->addField("Password")
                ->addField("roleFk")
                ->addValue("Homie")
                ->addValue("Homer")
                ->addValue("Simpson")
                ->addValue("homerS@gmail.com")
                ->addValue("$pass")
                ->addLastValue("2");

        }
    }

    public function returnEncryptedString($passwordEnter): String
    {
        return password_hash($passwordEnter, PASSWORD_DEFAULT);
    }
}