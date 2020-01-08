<?php

/**
 * Class HomePageController controller for HomePage.php
 */
class HomePageController {

    public function work() {
        ob_start();
        require("Views/HomePage.php");
        $obsah = ob_get_clean();

        return $obsah;
    }

}

?>