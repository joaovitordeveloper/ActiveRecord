<?php

namespace app\database\activerecord;

use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\InsertInterface;

class Insert implements ActiveRecordExecuteInterface
{
  public function execute(ActiveRecordInterface $activeRecordInterface)
  {
    return 'insert';
  }
}