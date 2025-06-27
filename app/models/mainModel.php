<?php

namespace app\models;

use \PDO;
use DateTime;

if (file_exists(__DIR__ . "/../../config/server.php")) {
    require_once __DIR__ . "/../../config/server.php";
}

class mainModel
{
    private $dbServer = DB_SERVER;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPassword = DB_PASSWORD;

    // FUNCTION TO EXECUTE CONNECTION TO DATA BASE //
    protected function dbConnect()
    {
        $dbConnection = new PDO("mysql:host=" . $this->dbServer . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPassword);
        $dbConnection->exec("SET CHARACTER SET utf8");
        return $dbConnection;
    }

    // FUNCTION TO EXECUTE A REQUEST DATA TO DATABASE
    public function dbRequestExecute($dbRequest)
    {
        $dbRequest_SQL = $this->dbConnect()->prepare($dbRequest);
        $dbRequest_SQL->execute();
        return $dbRequest_SQL;
    }

    // FUNCTION TO AVOID SQL INJECTION
    public function cleanRequest($string)
    {
        $forbiddenWords = ["<script>", "</script>", "<script src", "<script type=", "SELECT * FROM", "SELECT ", " SELECT ", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">", "==", "=", ";", "::"];

        $string = trim($string);
        $string = stripslashes($string);

        foreach ($forbiddenWords as $forbiddenWord) {
            $string = str_ireplace($forbiddenWord, "", $string);
        }
        $string = trim($string);
        $string = stripslashes($string);
        return $string;
    }

    // FUNCTION TO VERIFY DATA
    protected function verifyData($filter, $string)
    {
        if (preg_match("/^" . $filter . "$/", $string)) {
            return false;
        } else {
            return true;
        }
    }

    // MAIN FUNCTION TO SAVE DATA INTO ANY TABLE FROM DATABASE
    protected function saveData($table, $data)
    {

        $saveData_Query = "INSERT INTO $table (";
        $C = 0;
        foreach ($data as $key) {
            if ($C >= 1) {
                $saveData_Query .= ",";
            }
            $saveData_Query .= $key["db_FieldName"];
            $C++;
        }

        $saveData_Query .= ") VALUES(";
        $C = 0;
        foreach ($data as $key) {
            if ($C >= 1) {
                $saveData_Query .= ",";
            }
            $saveData_Query .= $key["db_ValueName"];
            $C++;
        }
        $saveData_Query .= ")";

        $dbSaveData_SQL = $this->dbConnect()->prepare($saveData_Query);

        foreach ($data as $key) {
            $dbSaveData_SQL->bindParam($key["db_ValueName"], $key["db_realValue"]);
        }

        $dbSaveData_SQL->execute();
        return $dbSaveData_SQL;
    }

    // FUNCTION TO SELECT DATA FROM DATABASE
    public function selectData($type, $table, $field, $id)
    {
        $type = $this->cleanRequest($type);
        $table = $this->cleanRequest($table);
        $field = $this->cleanRequest($field);
        $id = $this->cleanRequest($id);

        if ($type == "Unique") {
            $dbSelectData_SQL = $this->dbConnect()->prepare("SELECT * FROM $table WHERE $field = :ID");
            $dbSelectData_SQL->bindParam(":ID", $id);
        } elseif ($type == "Normal") {
            $dbSelectData_SQL = $this->dbConnect()->prepare("SELECT $field FROM $table");
        }
        $dbSelectData_SQL->execute();

        return $dbSelectData_SQL;
    }

    // FUNCTION TO DELETE DATA FROM DATABASE
    protected function deleteData($table, $field, $id)
    {
        $delteData_SQL = $this->dbConnect()->prepare("DELETE FROM $table WHERE $field= :ID");
        $delteData_SQL->bindParam(":ID", $id);
        $delteData_SQL->execute();

        return $delteData_SQL;
    }

    // FUNCTION TO UPDATE DATA FROM DATABASE
    protected function updateData($table, $data, $condition)
    {
        $updateData_Query = "UPDATE $table SET ";

        $C = 0;
        foreach ($data as $key) {
            if ($C >= 1) {
                $updateData_Query .= ",";
            }
            $updateData_Query .= $key["db_FieldName"] . "=" . $key["db_ValueName"];
            $C++;
        }

        $updateData_Query .= " WHERE " . $condition["condition_FieldName"] . "=" . $condition["condition_ValueName"];
        $updateData_SQL = $this->dbConnect()->prepare($updateData_Query);
        foreach ($data as $key) {
            $updateData_SQL->bindParam($key["db_ValueName"], $key["db_realValue"]);
        }

        $updateData_SQL->bindParam($condition["condition_ValueName"], $condition["condition_realValue"]);
        $updateData_SQL->execute();
        return $updateData_SQL;
    }

    // FUNCTION TO PAGINATE DATA
    protected function paginationData($page, $numPages, $url, $buttons)
    {
        $table = '
        <div class="flex items-center justify-end mt-3">
        <nav aria-label="Page navigation">';

        if ($page <= 1) {
            $table .= '
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="#" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 rounded-s-lg bg-gray-900 border-gray-700 cursor-not-allowed">Anterior</a>
                </li>';
        } else {
            $table .= '
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="' . $url . ($page - 1) . '/" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 rounded-s-lg bg-gray-900 hover:bg-gray-800 border-gray-700 hover:text-white transition duration-100">Anterior</a>
                </li>
            <li>
                <a href="' . $url . '1/" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 bg-gray-900 hover:bg-gray-800 border-gray-700 hover:text-white transition duration-100">1</a>
            </li>';
        }

        $iterationCounter = 0;
        for ($counter = $page; $counter <= $numPages; $counter++) {
            if ($iterationCounter >= $buttons) {
                break;
            }
            if ($page == $counter) {
                $table .= '
                <li>
                    <a href="' . $url . $counter . '/" aria-current="page" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 bg-gray-900 hover:bg-gray-800 border-gray-700 hover:text-white transition duration-100">' . $counter . '</a>
                </li>';
            } else {
                $table .= '
                <li>
                    <a href="' . $url . $counter . '/" aria-current="page" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 bg-gray-900 hover:bg-gray-800 border-gray-700 hover:text-white transition duration-100">' . $counter . '</a>
                </li>';
            }
            $iterationCounter++;
        }

        if ($page == $numPages) {
            $table .= '
                <li>
                    <a href="#" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 bg-gray-900 border-gray-700 rounded-e-lg cursor-not-allowed">Siguiente</a>
                </li>
            </ul>';
        } else {
            $table .= '
                <li>
                    <a href="' . $url . ($page + 1) . '/" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-300 border border-gray-300 bg-gray-900 hover:bg-gray-800 border-gray-700 hover:text-white transition duration-100 rounded-e-lg">Siguiente</a>
                </li>
            </ul>
        </div>';
        }

        $table .= '</nav>';
        return $table;
    }

    // FUNCTION TO FORMAT DATE TIME
    protected function formatTimeDots($timeString)
    {
        $dateTime = new DateTime($timeString);
        $dateTimeDots = str_replace(['am', 'pm'], ["a. m.", "p. m."], $dateTime->format("h:i a"));
        return $dateTimeDots;
    }
}
