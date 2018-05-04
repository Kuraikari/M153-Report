<?php

namespace models;

use services\QueryBuilder;

class Validator
{
    /*private $validationConfiguration = [
        'firstname' => [
            'required' => true,
            'maxLength' => 20
        ],
        'registerDate'=>[
            'isDate' => true
        ]
    ];*/
    private $entity;
    private $isValid = true;
    private $validationConfiguration = [];
    /*private $errors = [
        'firstname' => [
            'required' => 'Firstname cannot be left empty.'
        ]
    ];*/
    private $errors = [];

    /**
     * Validator constructor.
     * @param $entity
     */
    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }


    public function isRequired($property, $bool = true)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['required'] = $bool;
    }

    public function maxLength($property, $number)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['maxLength'] = $number;
    }

    public function minLength($property, $number)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['minLength'] = $number;
    }

    public function isDate($property, $bool = true)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['isDate'] = $bool;
    }

    private function addPropertyIfNotExistent($property)
    {
        if (!isset($this->validationConfiguration[$property])) {
            $this->validationConfiguration[$property] = [];
        }
    }

    public function isEmail($property, $bool = true)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['isEmail'] = $bool;
    }

    public function isMatch($property1, $property2)
    {
        $this->addPropertyIfNotExistent($property1);
        $this->validationConfiguration[$property2]['isMatch'] = [$property2];
        $this->validationConfiguration[$property1]['isMatch'] = [$property1];

    }

    public function userExists($property)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['userExists'] = true;
    }

    public function isValidePassword($property, $bool = true)
    {
        $this->addPropertyIfNotExistent($property);
        $this->validationConfiguration[$property]['isValidePassword'] = $bool;
    }


    public function validate(): bool
    {
        $this->isValid = true;
        foreach ($this->validationConfiguration as $propertyName => $propertyConfiguration) {
            if (isset($propertyConfiguration['required']) && $propertyConfiguration['required'] == true) {
                $this->isValid = !empty($this->entity->$propertyName);
                if ($this->isValid == false) {
                    $this->errors['required'] = ucfirst($propertyName) . " cannot be left empty";
                }
            }

            if (isset($propertyConfiguration['maxLength']) && $propertyConfiguration['maxLength'] > 0) {
                $bool = strlen($this->entity->$propertyName) <= $propertyConfiguration['maxLength'];
                if ($bool == false) {
                    $this->isValid = false;
                    $this->errors['maxLength'] = ucfirst($propertyName) . "it can be only " . $propertyConfiguration['maxLength'] . " long";
                }
            }

            if (isset($propertyConfiguration['isDate']) && $propertyConfiguration['isDate'] == true) {
                if (!$this->entity->$propertyName instanceof \DateTime) {
                    $this->isValid = false;
                    $this->errors['isdate'] = ucfirst($propertyName) . "is a invalid date";
                }
            }


            if (isset($propertyConfiguration['isMatch']))
            {
                $pass2 = $this->validationConfiguration['Password2']['isMatch'][0];
                $pass1 = $this->validationConfiguration['Password1']['isMatch'][0];

                if ($this->entity->$pass2 != $this->entity->$pass1) {

                    $this->isValid = false;
                    $this->errors['isMatch'] = "Password not match!";
                }
            }

            if (isset($propertyConfiguration['isEmail']) && $propertyConfiguration['isEmail'] == true) {
                if (!filter_var($this->entity->$propertyName, FILTER_VALIDATE_EMAIL)) {
                    $this->isValid = false;
                    $this->errors['isEmail'] = ucfirst($propertyName) . " is invalide";
                }
            }

            if (isset($propertyConfiguration['minLength'])) {
                $bool = strlen($this->entity->$propertyName) >= $propertyConfiguration['minLength'];
                if ($bool == false) {
                    $this->isValid = false;
                    $this->errors['minLength'] =  "Password must be " . $propertyConfiguration['minLength'] . " long";
                }
            }

            if (isset($propertyConfiguration['isValidePassword']) && $propertyConfiguration['isValidePassword'] == true) {
                if (!preg_match("/[A-Za-z]/", $this->entity->$propertyName) &&
                    !preg_match("/[0-9]+/", $this->entity->$propertyName)) {
                    $this->isValid = false;
                    $this->errors['isValidePassword'] = "Password is not valide";
                }
            }


            if (isset($propertyConfiguration['userExists'])) {

                $query = new QueryBuilder();

                $myQuery = $query
                    ->select("*")
                    ->from("user")
                    ->where("username", "'" . $this->entity->$propertyName . "'")
                    ->execute();

                $count = $myQuery->rowCount();
                if ($count >= 1) {
                    $this->isValid = false;
                    $this->errors['userExists'] = ucfirst($propertyName) . " is already taken";
                }
            }

        }
        return $this->isValid;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }




}
