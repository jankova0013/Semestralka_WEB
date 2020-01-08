<?php

/**
 * Class AdministrationArticlesController controller for AdministrationController.php
 */
class AdministrationArticlesController {
    private $logincontroller;
    private $articleController;
    private $reviewcontroller;

    public function __construct() {
        $this->logincontroller = new LoginController();
        $this->reviewcontroller = new ReviewController();
        $this->articleController = new ArticleController();
    }

    public function work() {

        if(isset($_POST["action"])){
            if(($_POST["action"])=="articles"){ // if admin wants to change informations about article(s)
                $articles = $this->articleController->executeGetAllArticles();
                foreach ($articles as $article) { //for every article compare information from database to $_POST information
                    $statestring = "state".$article['articleID']; //string for state for this user (state+userID)
                    $count = count($this->reviewcontroller->executeGetArticlesReviews($article['articleID']));
                    if(isset($_POST[$statestring])){
                        if($_POST[$statestring]!= $article["state"]){ //if it's different
                            if($count>2) { //if article has at least 3 reviews
                                $reviewsID = $this->reviewcontroller->executeGetArticlesReviews($article['articleID']);
                                $wholereviews = true;
                                foreach ($reviewsID as $reviewID) {
                                    $review = $this->reviewcontroller->executeGetReview($reviewID['reviewID']);
                                    if (!$review['0']['originality']) {
                                        $wholereviews = false;
                                    }
                                }
                                if($wholereviews) {
                                    $this->articleController->executeChangeState($article['articleID'], $_POST[$statestring]); // change to $_POST information
                                } else {
                                    ?>
                                    <div class="alert alert-info">
                                        <strong>Článek má požadovaný počet přidělených recenzí, ale nejsou zatím vyplněné recenzenty.</strong>
                                    </div>
                                    <?php
                                }
                            } else { // if article has less than 3 reviews -> alert
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Článek nemá požadovaný počet recenzí.</strong>
                                </div>
                                <?php
                            }
                        }
                    }
                    $publicstring = "public".$article['articleID']; // public string for this article
                    if(isset($_POST[$publicstring])) {
                        if($_POST[$publicstring] != $article['public']) { //it it's different
                            if($count>2) { // if article has at least 3 reviews
                                $reviewsID = $this->reviewcontroller->executeGetArticlesReviews($article['articleID']);
                                $wholereviews = true;
                                foreach ($reviewsID as $reviewID) {
                                    $review = $this->reviewcontroller->executeGetReview($reviewID['reviewID']);
                                    if (!$review['0']['originality']) {
                                        $wholereviews = false;
                                    }
                                }
                                if($wholereviews) {
                                    $this->articleController->executeChangePublic($article['articleID'], $_POST[$publicstring]);
                                } else {
                                    ?>
                                    <div class="alert alert-info">
                                        <strong>Článek má požadovaný počet přidělených recenzí, ale nejsou zatím vyplněné recenzenty.</strong>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Článek nemá požadovaný počet recenzí.</strong>
                                </div>
                                <?php
                            }
                        }
                    }
                }
            }
        }


        ob_start();
        require("Views/AdministrationArticles.php");
        $content = ob_get_clean();

        return $content;

    }

}
?>