<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\InsertInterface;

class Insert implements ActiveRecordExecuteInterface
{
  public function execute(ActiveRecordInterface $activeRecordInterface)
  {
    try {
      $query = $this->createQuery($activeRecordInterface);
      $connection = Connection::connect();

      $prepare = $connection->prepare($query);
      return $prepare->execute($activeRecordInterface->getAttributes());

    } catch (\Throwable $th) {
      formatExcetion($th);
    }
  }

  private function createQuery(ActiveRecordInterface $activeRecordInterface)
  {
    $sql = "INSERT INTO {$activeRecordInterface->getTable()} (";
    $sql.= implode(',', array_keys($activeRecordInterface->getAttributes())) . ') VALUES (';
    $sql.= ':' . implode(',:', array_keys($activeRecordInterface->getAttributes())) . ')';

    return $sql;
  }
}