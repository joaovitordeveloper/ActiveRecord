<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use Exception;

class FindAll implements ActiveRecordExecuteInterface
{
  private array $where;
  private string $limit;
  private string $offset;
  private string $fields;

  public function __construct(array $where = [], string $limit = '', string $offset = '', string $fields = '*')
  {
    $this->where  = $where;
    $this->limit  = $limit;
    $this->offset = $offset;
    $this->fields = $fields;
  }

  public function execute(ActiveRecordInterface $activeRecordInterface)
  {
    try {

      $query = $this->createQuery($activeRecordInterface);
      $connection = Connection::connect();
      $prepare = $connection->prepare($query);
      $prepare->execute($this->where);

      return $prepare->fetchAll();
      
    } catch (\Throwable $th) {
      formatExcetion($th);
    }
  }

  public function createQuery(ActiveRecordInterface $activeRecordInterface)
  {

    if(count($this->where) > 1)
    {
      throw new Exception('No Where so pode passar um indice');
    }

    $where = array_keys($this->where);
    $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()}";
    $sql .= (!$this->where) ? '' : " WHERE {$where[0]} = :{$where[0]}";
    $sql .= (!$this->limit) ? '' : " LIMIT {$this->limit}";
    $sql .= ($this->offset != '') ? " offset {$this->offset}" : '';


    return $sql;
  }
}