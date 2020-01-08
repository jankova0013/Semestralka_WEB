<?php
/**
 * Class RegistrationController controller for Registration.php
 */

class RegistrationController {
    private $usmodel;
    private $logincontroller;

    public function __construct() {
        $this->usmodel = new UserModel();
        $this->logincontroller = new LoginController();
    }

    public function work() {

        if(isset($_POST["action"])) {
            if($_POST["action"]=="register") { // if user wants to register
                if($_POST["name"]!= "" && $_POST["passwd"] != "") { // is filled username and password?
                    if(!$this->logincontroller->executeExistSameUsername($_POST["name"])) { // checks if this username is not used
                        $this->logincontroller->executeInsertUser($_POST["name"], $_POST["passwd"]);
                    } else { //username is already taken
                        ?>
                        <div class="alert alert-danger">
                            <strong>Toto uživatelské jméno již používá někdo jiný. </strong>Vyberte si, prosím, jiné a zkuste to znovu.
                        </div>
                        <?php
                    }
                } else { // if isn't filled username and password
                    ?>
                    <div class="alert alert-danger">
                        <strong>Vyplňte, prosím, jméno i heslo.</strong>
                    </div>
                    <?php
                }
            }
        }

        ob_start();
        require("Views/Registration.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}