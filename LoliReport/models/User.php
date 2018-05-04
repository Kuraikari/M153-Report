<?php

namespace models;
use services\QueryBuilder;
use services\Sessionmanagement;

/**
 * Created by PhpStorm.
 * User: Danis
 * Date: 19.10.2017
 * Time: 17:16
 */
class User extends Entity
{
    public $Id;
    public $Username;
    public $Firstname;
    public $Lastname;
    public $Email;
    public $Password1;
    public $Password2;
    public $Image;
    public $Token;

    public function getUsername()
    {
        return $this->Username;
    }

    public function getErrors()
    {
        return $this->validator->getErrors();
    }

    protected function defaultValidationConfiguration()
    {
        parent::defaultValidationConfiguration();

        $this->validator->maxLength('Username',32);
        $this->validator->maxLength('Firstname',32);
        $this->validator->maxLength('Lastname',32);
        $this->validator->maxLength('Email',64);
        $this->validator->isRequired('Username');
        $this->validator->userExists('Username');
        $this->validator->userExists('Username');
        $this->validator->isRequired('Firstname');
        $this->validator->isRequired('Lastname');
        $this->validator->isRequired('Password1');
        $this->validator->isValidePassword('Password1');
        $this->validator->minLength('Password1', 8);
        $this->validator->isRequired('Password2');
        $this->validator->isValidePassword('Password2');
        $this->validator->minLength('Password2', 8);
        $this->validator->isMatch('Password1','Password2');
        $this->validator->isRequired('Email');
        $this->validator->isEmail('Email');
    }

    public function save()
    {
        $query = new QueryBuilder();

        $query
            ->insert("user")
            ->addField("Username")
            ->addField("Firstname")
            ->addField("Lastname")
            ->addField("Email")
            ->addField("Password")
            ->addField("roleFk")
            ->addValue("$this->Username")
            ->addValue("$this->Firstname")
            ->addValue("$this->Lastname")
            ->addValue("$this->Email")
            ->addValue("$this->Password1")
            ->addLastValue("2");
    }

    public function saveEdit()
    {
        $username = unserialize(Sessionmanagement::get('user'))['username'];

        $query = new QueryBuilder();

        $query
            ->update("user")
            ->setFirst("Firstname","'".$this->Firstname."'")
            ->set("Lastname","'".$this->Lastname."'")
            ->set("Email","'".$this->Email."'")
            ->set("Image","'".$this->Image."'")
            ->where("username","'".$username."'")
            ->execute();

    }

    public  function  saveEditNoImage()
    {
        $username = unserialize(Sessionmanagement::get('user'))['username'];

        $query = new QueryBuilder();

        $query
            ->update("user")
            ->setFirst("Firstname","'".$this->Firstname."'")
            ->set("Lastname","'".$this->Lastname."'")
            ->set("Email","'".$this->Email."'")
            ->where("username","'".$username."'")
            ->execute();
    }


}
