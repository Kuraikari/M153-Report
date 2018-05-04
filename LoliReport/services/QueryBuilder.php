<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 13.12.2017
 * Time: 11:11
 */


namespace services;


use PDO;
use services\DBConnection;

class QueryBuilder
{
    /** @var PDO */
    protected $db;
    protected $query;
    protected $values;
    protected $fields;
    protected $table;
    protected $fieldsArray;
    protected $fieldsValuesArray;

    public function __construct()
    {
        $this->db = DBConnection::instance();
    }

    public function query($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $this->query = null;
        $this->values = null;
        $this->fields = null;
        $this->table = null;
        $this->fieldsArray = null;
        $this->fieldsValuesArray = null;

        return $stmt;
    }

    public function queryInsert($sql)
    {
        $stmt = $this->db->prepare($sql);

        $params = $this->values;

        // debug($params);
        // debug($stmt);

        $this->query = null;
        $this->values = null;
        $this->fields = null;
        $this->table = null;
        $this->fieldsArray = null;
        $this->fieldsValuesArray = null;
        $stmt->execute($params);

    }

    public function getLastInsertId()
    {
      debug($this->db->lastInsertId());
      return $this->db->lastInsertId();
    }


    public function select($entity)
    {
        $this->query = "Select {$entity} ";

        return $this;
    }

    public function from($table)
    {
        $this->query .= "from {$table} ";

        return $this;
    }

    public function where($attribut, $value)
    {
        $this->query .= "where {$attribut} = {$value} ";

        return $this;
    }

    public function and ($attribut, $value)
    {
        $this->query .= "and {$attribut} = {$value} ";

        return $this;
    }

    public function questionmark($count)
    {
        $string = "";
        for ($i = 1; $i < $count; $i++)
        {
            $string .= "?,";
        }
        $string .= "?";
        return $string;
    }

    public function getTypeOfValue($count)
    {
        $string = "";
        for ($i = 0; $i < $count; $i++)
        {
            $string .= "s";
        }
        return $string;
    }

    public function insert($entity)
    {
        $this->table = $entity;

        return $this;
    }

    public function addField($attribut)
    {
        $this->fields[] = $attribut;

        return $this;
    }

    public function addValue($value)
    {
        $this->values[] = $value;

        return $this;
    }

    public function addLastValue($value)
    {
        $this->values[] = $value;
        $fieldAsString = join(",", $this->fields);
        $valueCount = count($this->values);
        $questionMarks = $this->questionmark($valueCount);
        $tableName = $this->table;

        $this->query = "INSERT INTO $tableName ($fieldAsString) VALUES ($questionMarks)";

        $this->bindparam();
    }


    public function fieldsValuesToArray()
    {
        $fieldsValuesArray = [];
        foreach ($this->fields as $value)
        {
            foreach ($this->values as $value2)
            {
                $fieldsValuesArray[$value] = $value2;
            }
        }
        return $fieldsValuesArray;
    }

    public function fieldsToArray()
    {
        $fieldsArray = [];

        foreach ($this->fields as $value)
        {
            $fieldsArray[] = "$" . $value;
        }
        return $fieldsArray;
    }


    public function bindparam()
    {

        $fieldsValuesArray[] = $this->fieldsValuesToArray();
        $fieldsArray[] = $this->fieldsToArray();

        $valueCount = count($this->values);
        $types = $this->getTypeOfValue($valueCount);

        $this->queryInsert($this->query, "{$types}");
    }

    public function group_concate($attribut, $newAttribut)
    {
        $this->query .= ", group_concat({$attribut}) as {$newAttribut} ";

        return $this;
    }

    public function concate($attribut, $newAttribut)
    {
        $this->query .= ", concat({$attribut}) as {$newAttribut} ";

        return $this;
    }

    public function innerJoin($entity, $attribut, $attributDestination)
    {
        $this->query .= "Inner Join {$entity} on {$attribut} = $attributDestination ";

        return $this;
    }

    public function groubBy($attribut)
    {
        $this->query = "group by {$attribut} ";

        return $this;
    }

    public function update($entity)
    {
        $this->query = "UPDATE {$entity} ";

        return $this;
    }

    public function setFirst($attribut,$value)
    {
        $this->query .= "SET {$attribut} = {$value} ";

        return $this;
    }

    public function set($attribut,$value)
    {
        $this->query .= ", {$attribut} = {$value} ";

        return $this;
    }


    public function execute()
    {
        return $this->query($this->query);
    }

}
