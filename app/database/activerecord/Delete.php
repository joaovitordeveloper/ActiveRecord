<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use Exception;

class Delete implements ActiveRecordExecuteInterface
{
  private string $field;
  private string $value;

  public function __construct($field, $value)
  {
    $this->field = $field;
    $this->value = $value;
  }

  public function execute(ActiveRecordInterface $activeRecordInterface)
  {
    try {
      $query = $this->createQuery($activeRecordInterface);
      $connection = Connection::connect();

      $prepare = $connection->prepare($query);
      $prepare->execute([$this->field => $this->value]);

      return $prepare->rowCount();

    } catch (\Throwable $th) {
      formatExcetion($th);
    }
  }

  private function createQuery(ActiveRecordInterface $activeRecordInterface)
  {
    if($activeRecordInterface->getAttributes())
    {
      throw new Exception('Para deletar não precisa passar nenhum atributo');
    }
    $sql = "DELETE FROM {$activeRecordInterface->getTable()}";
    $sql.= " WHERE {$this->field} = :{$this->field}";

    return $sql;
  }
}