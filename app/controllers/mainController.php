<?php

namespace app\controllers;

use app\models\mainModel;
use Exception;
class mainController extends mainModel
{
    public function getDataController($tableName, $tableNameOrder, $orderBy)
    {
        $getData_Query = "SELECT * FROM $tableName ORDER BY $tableNameOrder $orderBy";
        $getData_SLQ = $this->dbRequestExecute($getData_Query);
        $getData_SLQ->execute();
        return $getData_SLQ;
    }

    public function countDataController($tableName){
        $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) AS totalCount FROM $tableName");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
    }

    public function countConditionalDataController($tableName, $conditionValue, $conditionColumn){
        $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) AS totalCount FROM $tableName WHERE $conditionColumn = $conditionValue");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
    }
}