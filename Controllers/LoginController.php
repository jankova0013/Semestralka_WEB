<?php

/**
 * Class LoginController controller for Login.php and UserModel.php
 */
class LoginController {
      private $usmodel;
      private $mySession;
      private $currSessionKey = "curr_userID";


    // TODO obsluhu - get users, add user, change role, , delete user, ban user

    public function __construct() {
        $this->usmodel = new UserModel();
        $this->mySession = new SessionController();
    }

    public function executeGetAllUsers() {
        return $this->usmodel->getAllUsers();
    }

    public function executeInsertUser($username, $password) {
        $res = $this->usmodel->addUser(htmlspecialchars($username), htmlspecialchars($password));
        return $res;
    }

    public function executeChangeRole($userID, $role){
        $res = $this->usmodel->changeRole($userID, $role);
        return $res;
    }

    public function executeBanUser($userID) {
        $res = $this->usmodel->banUser($userID);
        return $res;
    }

    public function executeUnbanUser($userID) {
        $res = $this->usmodel->unbanUser($userID);
        return $res;
    }

     public function executeUserExists($username, $password) {
        $res = $this->usmodel->userExists($username, $password);
        if($res) {
            //$res->fetchAll();
            //$this->currSessionKey = $res[0]['userID'];
            //$_SESSION[$this->currSessionKey] = $res[0]['userID'];
            $this->mySession->addSession($this->currSessionKey, $res[0]['userID']);
            return $res[0]['userID']; //? true
        } else {
            return "Uzivatel neexistuje."; //? alert
        }
    }

    public function isUserLogged() {
        if (isset($_SESSION[$this->currSessionKey])){
                $logged = true;
                return true;
        } else {
            return false;
        }
    }

    public function logoutUser() {
        $res = $this->mySession->removeSession($this->currSessionKey);
        $logged = false;
        return $res;
    }

    public function isReviewerSession() {
        $userID = $this->mySession->readSession($this->currSessionKey);
        $res = $this->usmodel->getRole($userID);
        if($res) {
            if (($res['0']['role']) == "recenzent") {
                return true;
            } else {
                return false;
            }
        }
        else return false;
    }

    public function isReviewer($userID) {
        $res = $this->usmodel->getRole($userID);
        if($res) {
            if($res['0']['role']==recenzent) {
                return true;
            } else{
                return false;
            }
        } else return false;
    }

    public function executeGetUser($userID){
        return $this->usmodel->getUser($userID);
    }

    public function executeDeleteUser($userID) {
        return $this->usmodel->deleteUser($userID);
    }

    public function getLoggedUsersID() {
        return $this->mySession->readSession($this->currSessionKey);
    }

    public function isAdminSession(){
        $userID = $this->mySession->readSession($this->currSessionKey);
        $res = $this->usmodel->getRole($userID);
        if($res) {
            if (($res['0']['role']) == "správce") {
                return true;
            } else {
                return false;
            }
        }
        else return false;
    }

    public function executeExistSameUsername($username) {
        $res = $this->usmodel->existSameUsername($username);
        return $res;
    }

    public function getLoggedUserID () {
        $userID = $this->mySession->readSession($this->currSessionKey);
        return $userID;
    }
public function work()
{
   // $_POST["action"] = "login";
    //$_POST["name"]= "ametyst";
   // $_POST["passwd"] = "789";
    if (isset($_POST["action"])) {
        if (($_POST["action"]) == "login") { // if user wants to log in
            $check = $this->executeUserExists($_POST["name"], $_POST["passwd"]); //verify user exists and insert userID to session
            if ($this->isUserLogged()) { // is something in session? -> login was successful
                ?>
                <div class="alert alert-success">
                    <strong>Přihlášení proběhlo úspěšně!</strong>
                </div> <?php
            } else { //login failed
                ?>
                <div class="alert alert-danger">
                    <strong>Přihlášení se bohužel nezdařilo. Zkuste to, prosím, znovu.</strong>
                </div>
                <?php
            }
        } else if (($_POST["action"]) == "logout") { //if user wants to log out
            $this->logoutUser();
        }

    }
    ob_start();
    require("Views/Login.php");
    $content = ob_get_clean();

    return $content;


}


}

?>