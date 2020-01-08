<?php
$app = new ApplicationStart();
$app->appStart();

/**
 * Start of application
 */
class ApplicationStart {

    public function __construct()
    {
        // include all needed files
        require_once("settings.php");
        require_once("Models\UserModel.php");
        require_once ("Controllers/SessionController.php");
        require_once("Views/Template.php");
        require_once("Models/ArticleModel.php");
        require_once("Models\DatabaseModel.php");
        require_once("Controllers/LoginController.php");
        require_once("settings.php");
        require_once("Controllers/ArticleController.php");
        require_once("Controllers/ReviewController.php");
        require_once("Models/ReviewModel.php");
    }

    public function appStart(){

        if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)) { // finds the right page to display
            $pageKey = $_GET["page"];
        } else { // if page isn't set or doesn't exist in the list -> choose default page
            $pageKey = DEFAULT_WEB_PAGE_KEY;
        }
        session_start();

        $pageInfo = WEB_PAGES[$pageKey];

        require_once(DIRECTORY_CONTROLLERS ."/".$pageInfo["file_name"]);

        $controller = new $pageInfo["class_name"](); // create instance of relevant controller

        echo $controller->work();

    }
}

?>