<?php
    namespace app\controllers;
    use app\models\mainModel;
    use Exception;

    class dashboardController extends mainModel{

        public function countWifiRegistersController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) as total FROM wifi_directory");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }

        public function countDevicesDeliveredController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) as total FROM devices WHERE device_isDelivered = 1");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }
    }

?>