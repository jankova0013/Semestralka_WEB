<?php

/**
 * Class ArticleModel for every query from table `article`
 */
class ArticleModel {

    /**instance of database**/
    private $db;

    public function __construct() {
        $this->db = new DatabaseModel();
    }

    /**
     * method inserts new article
     * @param $userID
     * @param $name
     * @param $content
     * @param $file
     * @return bool - result - true if it's inserted, false if it's not
     */
    public function insertArticle($userID, $name, $content, $file) {
        $q = "INSERT INTO `article` (`articleID`, `user_userID`, `name`, `content`, `file`, `public`, `state`) VALUES (NULL, :userID, :articlename, :content, :file, 'ne', 'v řízení')";
        $res = $this->db->executePrepare($q);
        $res->bindValue(":userID", $userID);
        $res->bindValue(":articlename", $name);
        $res->bindValue(":content", $content);
        $res->bindValue(":file", $file);
        if($res->execute()){
            ?> <div class="alert alert-success">
            <strong>Příspěvek byl úspěšně vložen!</strong>
            </div> <?php
            return true;
        } else {
            ?>
            <div class="alert alert-danger">
             <strong>Příspěvek se bohužel nepodařilo vložit. Zkuste to, prosím, znovu.</strong>
            </div>
            <?php
            return false;
        }
    }

    /**
     * @return array - array of all articles from database
     */
    public function getAllArticles() {
        $q = "SELECT * FROM `article`";
        return $this->db->executeQuery($q)->fetchAll();
    }

    /**
     * @return array = array of all public articles from database
     */
    public function getAllPublicArticles() {
        $q = "SELECT * FROM `article` WHERE `public`='ano'";
        return $this->db->executeQuery($q)->fetchAll();
    }

    /**
     * method returns relevant article if it's in database, otherwise null
     * @param $articleID
     * @return false|PDOStatement|null
     */
    public function getArticle($articleID) {
        $q = "SELECT * FROM `article` WHERE `articleID`='$articleID'";
        return $this->db->executeQuery($q);
    }

    /**
     * method deletes relevant article from databse
     * @param $articleID
     * @return bool
     */
    public function deleteArticle($articleID) {
        $q = "DELETE FROM `article` WHERE `articleID`='$articleID'";
        return $this->db->executeQueryBool($q);
    }

    public function changeContent($articleID, $content) {
        $q = "UPDATE `article` SET `content`=:content WHERE `articleID`='$articleID'";
        $res = $this->db->executePrepare($q);
        $res->bindValue(":content", $content);
        if($res->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changeName($articleID, $name) {
        $q = "UPDATE `article` SET `name`=:articlename WHERE `articleID`=$articleID";
        //return $this->db->executeQueryBool($q);
        $res = $this->db->executePrepare($q);
        $res->bindValue(":articlename", $name);
        if($res->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isPublic($articleID) {
        $q = "SELECT `public` FROM `article` WHERE `articleID`='$articleID'";
        $res = $this->db->executeQuery($q)->fetch();
        if($res['public'] == "ano") {
            return true;
        } else {
            return false;
        }
    }

    public function changeState($articleID, $state) {
        $q = "UPDATE `article` SET `state`='$state' WHERE `articleID`='$articleID'";
        return $this->db->executeQueryBool($q);
    }

    public function changePublic($articleID, $public) {
       $q = "UPDATE `article` SET `public`='$public' WHERE `articleID`='$articleID'";
       return $this->db->executeQueryBool($q);
    }

    public function getAuthor($articleID) {
        $q = "SELECT `user_userID` FROM `article` WHERE `articleID`='$articleID'";
        $res = $this->db->executeQuery($q);
        if($res){
            return $res->fetch();
        }
        else return "";
    }

    public function articleAlreadyExists($name, $content){
        $q = "SELECT `articleID` FROM `article` WHERE `name`=:articlename AND `content`=:content";
        $res = $this->db->executePrepare($q);
        $res->bindValue(":articlename", $name);
        $res->bindValue(":content", $content);
        $res->execute();
        $res = $res->fetchAll();
        if($res) {
            return true;
        } else {
            return false;
        }
    }

}

?>