<?php

namespace app\controllers;

use app\models\mainModel;


class observationsController extends mainModel
{

    public function saveObservationsController()
    {
        $observationReason = strtoupper($this->cleanRequest($_POST['observationReason']));
        $observationDate = $this->cleanRequest($_POST['observationDate']);
        $observationType = $this->cleanRequest($_POST['observationType']);
        $observationPriority = $this->cleanRequest($_POST['observationPriority']);
        $observationDescription = $this->cleanRequest($_POST['observationDescription']);

        if (empty($observationReason) || empty($observationDate) || empty($observationType) || empty($observationPriority) || empty($observationDescription)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $observationsRegisterData = [
            [
                "db_FieldName" => "observation_user_ID",
                "db_ValueName" => ":observationUser_ID",
                "db_realValue" => 1
            ],
            [
                "db_FieldName" => "observation_reason",
                "db_ValueName" => ":reason",
                "db_realValue" => $observationReason
            ],
            [
                "db_FieldName" => "observation_type_ID",
                "db_ValueName" => ":type_ID",
                "db_realValue" => $observationType
            ],
            [
                "db_FieldName" => "observations_priority_ID",
                "db_ValueName" => ":priority_ID",
                "db_realValue" => $observationPriority
            ],
            [
                "db_FieldName" => "observation_description",
                "db_ValueName" => ":description",
                "db_realValue" => $observationDescription
            ],
            [
                "db_FieldName" => "observation_createdAtDate",
                "db_ValueName" => ":createdAtDate",
                "db_realValue" => $observationDate
            ],
            [
                "db_FieldName" => "observation_createdAtTime",
                "db_ValueName" => ":createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "observation_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => $observationDate
            ],
            [
                "db_FieldName" => "observation_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "observation_isDone",
                "db_ValueName" => ":isDone",
                "db_realValue" => false
            ],
        ];
    }
}
