<?php

/**
 * Class AdministrationController controller for AdministrationController.php
 */
    class AdministrationController {
        private $logincontroller;

        public function __construct() {
            $this->logincontroller = new LoginController();
        }

        public function work() {

                if (isset($_POST["action"])) {
                    if ($_POST["action"] == "users") { //if admin wants to change information about user(s)
                        $users = $this->logincontroller->executeGetAllUsers();
                        foreach ($users as $user) { // user after user check if informations are the same in database as in $_POST
                            $rolestring = "role" . $user['userID']; // string for $_POST["role"] for this user
                            if (isset($_POST[$rolestring])) {
                                if ($_POST[$rolestring] != $user["role"]) { //if it's different
                                    $this->logincontroller->executeChangeRole($user["userID"], $_POST[$rolestring]);
                                }
                            }
                            $banstring = "ban" . $user['userID']; //string for ban for this user
                            if (($_POST[$banstring]) != $user["ban"]) { //if it's different
                                if ($_POST[$banstring] == "NULL") {
                                    $this->logincontroller->executeUnbanUser($user["userID"]);
                                } else if ($_POST[$banstring] == "ano") {
                                    $this->logincontroller->executeBanUser($user["userID"]);
                                }
                            }
                            $deletestring = "deleteUser" . $user['userID']; // string for delete for this user
                            if (isset($_POST[$deletestring])) {
                                if (($_POST[$deletestring]) == "yes") { //if it's checked, delete user
                                    $this->logincontroller->executeDeleteUser($user["userID"]);
                                }
                            }
                        }
                    }
                }

            ob_start();
            require("Views/Administration.php");
            $obsah = ob_get_clean();

            return $obsah;

        }

    }
?>