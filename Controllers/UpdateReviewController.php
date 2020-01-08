<?php
/**
 * Class UpdateReviewController controller for UpdateReview.php
 */

class UpdateReviewController {
    private $reviewcontroller;
    private $articlecontroller;
    private $logincontroller;

    public function __construct() {
        $this->articlecontroller = new ArticleController();
        $this->reviewcontroller = new ReviewController();
        $this->logincontroller = new LoginController();
    }

    public function work() {
        if(isset($_POST["action"])){
            if($_POST["action"]=="changeReview"){ //if user wants to edit review
                $articleID = $this->reviewcontroller->executeGetReviewingArticle($_GET["reviewID"]);
                $public = $this->articlecontroller->executeIsPublic($articleID['0']['article_articleID']);//is article public?
                $res = $this->reviewcontroller->changeReview($_GET["reviewID"], $_POST["originality"], $_POST["language"], $_POST["technical"], $_POST["comment"], $public);
                if($res) { // edit was successful
                    ?> <div class="alert alert-success">
                        <strong>Změna recenze proběhla úspěšně!</strong>
                    </div> <?php
                } else { // edit wasn't successful
                    ?>
                    <div class="alert alert-danger">
                        <strong>Změna recenze se bohužel nezdařila. Zkuste to, prosím, znovu.</strong>
                    </div>
                    <?php

                }
            }
        }

        ob_start();
        require("Views/UpdateReview.php");
        $obsah = ob_get_clean();

        return $obsah;

    }

}