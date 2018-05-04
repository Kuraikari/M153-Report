<?php
/**
 * Created by PhpStorm.
 * User: zwerm
 * Date: 24.03.2018
 * Time: 17:26
 */

namespace models;


class Collection
{
    private $currentkey;
    private $nextKey;
    private $collection;

    public function __construct(){
        $this->collection = array();
        $this->currentkey = 0;
    }

    public function add($obj, $key=null){
        if ($key == null){
            $this->collection[] = obj;
        }
        else{
            if (isset($this->collection[$key])){
                throw new \Exception("Key $key is already in use!");
            }
            else{
                $this->collection[$key] = $obj;
            }
        }
    }

    public function getNext(){
        if ($this->currentkey >= 0){
            $this->nextKey = $this->currentkey + 1;
            $this->currentkey++;
            return $this->collection[$this->nextKey];
        }
    }

    public function remove($key){
        if (isset($this->collection{$key})){
            unset($this->collection[$key]);
        }
    }

    public function getByIndex($key){
        if (isset($this->collection{$key})){
            return $this->collection[$key];
        }else{
            throw new \Exception("Invalid key - $key");
        }
    }

    public function keys() {
        return array_keys($this->items);
    }

    public function length() {
        return count($this->items);
    }

    public function keyExists($key) {
        return isset($this->items[$key]);
    }
}