<?php
/** DB settings */
define("DB_SERVER", "127.0.0.1");
define("DB_NAME", "web_semestralka");
define("DB_USER","root");
define("DB_PASS","");

/*define("TB_USER", "user");
define("TB_ARTICLE", "article");
define("TB_REVIEW", "review");
*/
const DIRECTORY_CONTROLLERS = "Controllers";
const DIRECTORY_MODELS = "Models";
const DIRECTORY_VIEWS = "Views";

const WEB_PAGES = array(
    // login
    "login" => array("file_name" => "LoginController.php",
        "class_name" => "LoginController"),

    "articles" => array("file_name" => "ArticleController.php",
        "class_name" => "ArticleController"),

    "homepage" => array("file_name" => "HomePageController.php",
        "class_name" => "HomePageController"),

    "reviews" => array("file_name" => "ReviewController.php",
        "class_name" => "ReviewController"),

    "administration" => array("file_name" => "AdministrationController.php",
        "class_name" => "AdministrationController"),

    "registration" => array("file_name" => "RegistrationController.php",
        "class_name" => "RegistrationController"),

    "administrationArticles" => array("file_name" => "AdministrationArticlesController.php",
        "class_name" => "AdministrationArticlesController"),

    "updateReview" => array("file_name" => "UpdateReviewController.php",
        "class_name" => "UpdateReviewController"),

    "newArticle" => array("file_name" => "NewArticleController.php",
        "class_name" => "NewArticleController"),

    "updateArticle" => array("file_name" => "UpdateArticleController.php",
        "class_name" => "UpdateArticleController"),

);

const DEFAULT_WEB_PAGE_KEY = "homepage";


?>