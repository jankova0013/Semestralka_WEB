<?php

/**
* Class processing database requirements
*/
class DatabaseModel {
    /** $pdo object working with database **/
    private $pdo;
    
    public function __construct() {
        require_once("settings.php");
        $this->pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $this->pdo->exec("set names utf8"); //set character set from client to server to utf8
    }

    /**
     * method processing query
     * If query doesn't end successfully, method will throw relevant error and return NULL
     * @param string $query query to process
     * @return false|PDOStatement|null
     */

    public function executeQuery ($q) {
        $res = $this->pdo->query($q);

        if ($res) {
            return $res;
        } else {
            $error = $this->pdo->errorInfo();
            echo $error[2];
            return NULL;
        }
    }

    public function executeQueryBool($q) {
        $res = $this->executeQuery($q);
        if($res) {
            return true;
        } else {
            return false;
        }
    }

    public function executePrepare($q) {
        return $this->pdo->prepare($q);
    }



    
    
}

?>