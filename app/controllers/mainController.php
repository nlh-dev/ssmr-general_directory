<?php

namespace app\controllers;

use app\models\mainModel;

class mainController extends mainModel
{
    public function getDataController($tableName, $tableNameOrder, $orderBy)
    {
        $getData_Query = "SELECT * FROM $tableName ORDER BY $tableNameOrder $orderBy";
        $getData_SLQ = $this->dbRequestExecute($getData_Query);
        $getData_SLQ->execute();
        return $getData_SLQ;
    }
}