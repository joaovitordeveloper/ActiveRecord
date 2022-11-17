<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use Exception;

class Update implements ActiveRecordExecuteInterface
{

  private string $fields;
  private string $value;

  public function __construct($fields, $value)
  {
    $this->fields = $fields;
    $this->value = $value;
  }

  public function execute(ActiveRecordInterface $activeRecordInterface)
  {
    try {

      $query = $this->creatQuery($activeRecordInterface);

      $connection = Connection::connect();

      $attributes = array_merge($activeRecordInterface->getAttributes(),[
        $this->fields => $this->value
      ]);

      $prepare = $connection->prepare($query);
      $prepare->execute($attributes);

      return $prepare->rowCount();
    } catch (\Throwable $th) {
      formatExcetion($th);
    }
  }

  private function creatQuery(ActiveRecordInterface $activeRecordInterface)
  {
    if(array_key_exists('id', $activeRecordInterface->getAttributes()))
    {
      throw new Exception('O campo id não pode ser passado para o update');
    }

    $sql = "UPDATE {$activeRecordInterface->getTable()} SET ";

    foreach ($activeRecordInterface->getAttributes() as $key => $value) {
     
        $sql.= "{$key} = :{$key},";
      
    }

    $sql = rtrim($sql, ',');

    $sql.= " WHERE {$this->fields} = :{$this->fields}";

    return $sql;
  }
}