<?php

namespace app\database\activerecord;

use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\UpdateInterface;
use ReflectionClass;

abstract class ActiveRecord implements ActiveRecordInterface
{
  protected $table = null;

  protected $attribute = [];

  public function __construct()
  {
    if(!$this->table)
    {
      $this->table = strtolower((new ReflectionClass($this))->getShortName());
    }
  }

  public function getTable()
  {
    return $this->table;
  }

  public function getAttributes()
  {
    return $this->attribute;
  }

  public function __set($attribute, $value)
  {
    $this->attribute[$attribute] = $value;
  }

  public function __get($attribute)
  {
    return $this->attribute[$attribute];
  }

  public function update(UpdateInterface $updateInterface)
  {
    return $updateInterface->update();
  }

  public function insert()
  {

  }

  public function delete()
  {

  }

  public function find()
  {

  }

  public function findBy()
  {

  }

  public function all()
  {

  }
}