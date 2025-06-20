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

        public function countWithdrewDevicesController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) as total FROM devices WHERE device_isDelivered = 0");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }

        public function countObservationsController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) AS totalCount FROM observations WHERE observation_isDone = 0");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }
        
        public function countLocationsController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) AS totalCount FROM locations WHERE location_isEnable = 1");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }
        
        public function countDepartmentsController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) AS totalCount FROM departments WHERE department_isEnable = 1");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }

        public function countStorageTypesController(){
            $totalRegisters = 0;
            try {
                $dbCountRequest = $this->dbRequestExecute("SELECT COUNT(*) AS totalCount FROM storage_types");
                $totalRegisters = $dbCountRequest->fetchColumn();
            } catch (Exception $e) {
                $totalRegisters = 0;
            }
            return $totalRegisters;
        }
    }

?>