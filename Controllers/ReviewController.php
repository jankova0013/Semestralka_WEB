<?php

/**
 * Class ReviewController controller for Review.php and ReviewModel.php
 */
class ReviewController {
    private $reviewModel;
    private $logincontroller;
    private $articlecontroller;

    public function __construct() {
        $this->reviewModel = new ReviewModel();
        $this->articlecontroller = new ArticleController();
        $this->logincontroller = new LoginController();
    }

    public function newReview($reviewerID, $articleID, $authorID) {
        return $this->reviewModel->newReview($reviewerID, $articleID, $authorID);
    }

    /**
     * method updates review. If it's reviewed for the first time -> it will be updated
     * if it's adjustment -> is reviewing article public? -> yes - it will not be updated | no - it will be updated
     * @param $reviewID
     * @param $originality
     * @param $language
     * @param $technical
     * @param $comment
     * @param $isPublic
     * @return bool|mixed
     */
    public function changeReview($reviewID, $originality, $language, $technical, $comment, $isPublic) {
        $res = $this->reviewModel->isNewReview($reviewID); // is this new review or change?
        if($res['originality'] == NULL) {
            $change = false;
        } else {
            $change = true;
        }

        if(!$change) { // if it's reviewed for the first time
            $res = $this->reviewModel->addReview($reviewID, $originality, $language, $technical, htmlspecialchars($comment));
        } else if ($isPublic) { // if it's change -> is it public?
            ?>
            <div class="alert alert-danger">
                <strong>Příspěvek je již zveřejněn. Recenzi tudíž není možné změnit.</strong>
            </div>
            <?php
            return false;
        } else {
            $res = $this->reviewModel->addReview($reviewID, $originality, $language, $technical, htmlspecialchars($comment));
        }

        return $res;

    }

    public function executeGetReview($reviewID) {
       // $reviewID = $reviewID['reviewID'];
        $reviews = $this->reviewModel->getReview($reviewID);
        return $reviews;
    }

    public function executeGetArticlesReviews($articleID) {
        $reviews = $this->reviewModel->getArticlesReviews($articleID);
        if($reviews==NULL) {
            return NULL;
        } else {
            return $reviews->fetchAll();
        }
    }

    public function executeIsAlreadyAssigned($articleID, $reviewerID) {
        $res = $this->reviewModel->isAlreadyAssigned($articleID, $reviewerID);
        if($res) {
            return $res->fetchAll();
        } else {
            return NULL;
        }
    }

    public function executeGetReviewingArticle($reviewID) {
        $res= $this->reviewModel->getReviewingArticle($reviewID);
        if ($res) {
            return $res->fetchAll();
        } else {
            return null;
        }
    }

    public function executeGetReviewersReviews($userID) {
        $reviews = $this->reviewModel->getReviewersReviews($userID);
        return $reviews;
    }

    public function executeDeleteReview($reviewID) {
        return $this->reviewModel->deleteReview($reviewID);
    }

    public function work() {

        if(isset($_POST['action'])){
            if($_POST['action']=="addReview") { //if user wants to add review
                if(isset($_POST['reviewerID'])) {
                    $assigned = $this->executeIsAlreadyAssigned($_GET['articleID'], $_POST['reviewerID']);
                    if($assigned==NULL) { // if this review wasn't already assigned to this reviewer
                        if(!$this->articlecontroller->executeIsPublic($_GET["articleID"])) {
                            $author = $this->articlecontroller->executeGetAuthor($_GET['articleID']);
                            $this->newReview($_POST['reviewerID'], $_GET['articleID'], $author['user_userID']);
                        } else {
                            ?>
                            <div class="alert alert-secondary">
                                <strong>Tento článek je již zveřejněn - není možné přidat novou recenzi.</strong>
                            </div> <?php
                        }
                    } else { ?>
                        <div class="alert alert-secondary">
                            <strong>Recenze byla tomuto uživateli již přiřazena.</strong>
                        </div> <?php
                    }
                }
            }
        }

        $userID = $this->logincontroller->getLoggedUserID();
        $reviewsID = $this->executeGetReviewersReviews($userID); // gets ID of all reviews of current user
        if ($reviewsID) {
            foreach ($reviewsID as $reviewID) { //check all of them if user wants to delete them
                $deleteString = "deleteReview".$reviewID['reviewID'];
                if (isset($_POST[$deleteString])) {
                    $this->executeDeleteReview($reviewID['reviewID']);
                    ?> <div class="alert alert-success">
                        <strong>Recenze byla úspěšně smazána!</strong>
                    </div> <?php
                }
            }
        }

        ob_start();
        require("Views/Review.php");
        $obsah = ob_get_clean();

        return $obsah;

    }

}

?>
