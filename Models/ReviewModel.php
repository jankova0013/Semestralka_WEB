<?php

class ReviewModel {
    private $db;

    public function __construct() {
        $this->db = new DatabaseModel();
    }

    /**
     * method will insert new review
     * @param $reviewerID
     * @param $articleID
     * @param $authorID
     * @return bool
     */
    public function newReview($reviewerID, $articleID, $authorID) {
        $q = "INSERT INTO `review`(`reviewID`, `originality`, `languageQuality`, `technicalQuality`, `comment`, `user_userID`, `article_articleID`, `article_user_userID`) VALUES (NULL, NULL, NULL, NULL, NULL, '$reviewerID', '$articleID', '$authorID')";
        return $this->db->executeQueryBool($q);
    }

    /**
     * method will update (add reviewer's review) review in database
     * @param $reviewID
     * @param $originality
     * @param $languageQuality
     * @param $technicalQuality
     * @param $comment
     * @return bool
     */
    public function addReview($reviewID, $originality, $languageQuality, $technicalQuality, $comment) {
        $q = "UPDATE `review` SET `originality` = '$originality', `languageQuality`= '$languageQuality', `technicalQuality` = '$technicalQuality', `comment` = :comment WHERE `reviewID` = $reviewID";
        $res = $this->db->executePrepare($q);
        $res->bindValue(":comment",$comment);
        if($res->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * method returns if article is reviewed for the first time or it's just adjustment
     * @param $reviewID
     * @return mixed
     */
    public function isNewReview($reviewID) {
        $q = "SELECT `originality` FROM `review` WHERE `reviewID`='$reviewID'";
        return $this->db->executeQuery($q)->fetch();
    }

    public function getReview($reviewID) {
        $q = "SELECT * FROM `review` WHERE `reviewID`='$reviewID'";
        return $this->db->executeQuery($q)->fetchAll();
    }

    public function getArticlesReviews($articleID) {
        $q = "SELECT * FROM `review` WHERE `article_articleID`='$articleID'";
        return $this->db->executeQuery($q);
    }

    /**
     * method returns if this reviewer already has assigned this review
     * @param $articleID
     * @param $reviewID
     * @return false|PDOStatement|null
     */
    public function isAlreadyAssigned($articleID, $reviewID){
        $q = "SELECT * FROM `review` WHERE `article_articleID`='$articleID' AND `user_userID`='$reviewID'";
        return $this->db->executeQuery($q);
    }

    public function getReviewingArticle($reviewID) {
        $q = "SELECT `article_articleID` FROM `review` WHERE `reviewID`='$reviewID'";
        return $this->db->executeQuery($q);
    }

    public function getReviewersReviews($reviewerID) {
        $q = "SELECT `reviewID` FROM `review` WHERE `user_userID`='$reviewerID'";
        $res = $this->db->executeQuery($q);
        if($res) {
            return $res->fetchAll();
        } else {
            return null;
        }
    }

    public function deleteReview($reviewID) {
        $q = "DELETE FROM `review` WHERE `reviewID`=$reviewID";
        return $this->db->executeQueryBool($q);
    }



}

?>