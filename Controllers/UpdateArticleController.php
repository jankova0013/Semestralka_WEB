<?php

/**
 * Class UpdateArticleController controller for UpdateArticle.php
 */
class UpdateArticleController {

    private $reviewcontroller;
    private $articlecontroller;
    private $logincontroller;

    public function __construct() {
        $this->articlecontroller = new ArticleController();
        $this->reviewcontroller = new ReviewController();
        $this->logincontroller = new LoginController();
    }

    public function work() {
        if(isset($_POST["action"])) {
            if($_POST["action"]=="updateArticle"){ //if user wants to edit article
                if($_POST["articleName"]!= "" && $_POST["content"] != "") {
                    $res = $this->articlecontroller->executeChangeName($_GET['articleID'], $_POST["articleName"]);
                    $res2 = $this->articlecontroller->executeChangeContent($_GET['articleID'],$_POST["content"]);
                    ?> <div class="alert alert-success">
                        <strong>Úprava článku proběhla úspěšně.</strong>
                    </div> <?php
                }
            }
        }
        ob_start();
        require("Views/UpdateArticle.php");
        $content = ob_get_clean();

        return $content;
    }

}