<?php

class UserModel {
    /**instance of database**/
    private $db;

    public function __construct() {
        $this->db = new DatabaseModel();
    }
    
    public function getAllUsers(): array {
        $q = "SELECT * FROM user";
        $users = $this->db->executeQuery($q);
        return $users->fetchAll();
    }

    public function deleteUser($userID) {
        $q = "DELETE FROM user WHERE userID = $userID";
        return $this->db->executeQueryBool($q);
    }

    public function addUser($username, $password) {
        $q = "INSERT INTO `user` (`userID`, `name`, `password`, `role`, `ban`) VALUES (NULL, :username, :password, 'autor', NULL)";
        $res = $this->db->executePrepare($q);
        $res->bindValue(":username", $username);
        $res->bindValue(":password", $password);
        if($res->execute()) {
            ?> <div class="alert alert-success">
                <strong>Registrace proběhla úspěšně!</strong>
            </div> <?php
            return true;
        } else {
            ?>
            <div class="alert alert-danger">
                <strong>Registrace bohužel neproběhla úspěšně. Zkuste to, prosím, znovu.</strong>
            </div>
            <?php
            return false;
        }

    }

    public function changeRole($userID, $role) {
        $q = "UPDATE `user` SET `role`= '$role' WHERE `userID`=$userID";
        return $this->db->executeQueryBool($q);
    }

    public function banUser($userID){
        $q = "UPDATE `user` SET `ban`= 'ano' WHERE `userID`=$userID";
        return $this->db->executeQueryBool($q);
    }

    public function unbanUser($userID) {
        $q = "UPDATE `user` SET `ban`= NULL WHERE `userID`=$userID";
        return $this->db->executeQueryBool($q);
    }

    public function userExists($username, $password) {
        $q = "SELECT * from `user` WHERE `name`=:username AND `password`=:password";
        $res = $this->db->executePrepare($q);
        $res->bindValue(":username", $username);
        $res->bindValue(":password", $password);
        if($res->execute()){
            return $res->fetchAll();
        } else {
            ?>
            <div class="alert alert-danger">
                <strong>Přihlášení se bohužel nezdařilo. Zkuste to, prosím, znovu.</strong>
            </div>
            <?php
            return null;
        }

    }

    public function getRole($userID) {
        $q = "SELECT `role` FROM `user` WHERE `userID`='$userID'";
        $res = $this->db->executeQuery($q);
        if($res){
            return $res->fetchAll();
        } else {
            return $res;
        }

    }

    public function getUser($userID){
        $q = "SELECT * FROM `user` WHERE `userID`='$userID'";
        return $this->db->executeQuery($q)->fetchAll();
    }

        public function existSameUsername($username) {
            $q = "SELECT * from `user` WHERE `name`=:username";
            //return $this->db->executeQuery($q);
            $res = $this->db->executePrepare($q);
            $res->bindValue(":username", $username);
            $res->execute();
            $res = $res->fetchAll();
            if($res){
                return true;
            } else {
                return false;
            }

    }


}

?>