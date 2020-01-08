<?php

/**
 * Class ArticleController controller for Articles.php and ArticleModel.php
 */
class ArticleController {
    private $arcModel;
    private $logincontroller;

    //TODO obsluha - insert article, get all articles, get all public! articles, get article, delete article , change content?, change name?

    public function __construct() {
        $this->arcModel = new ArticleModel();
        $this->logincontroller= new LoginController();
    }

    public function executeInsertArticle($userID, $name, $content, $file) {
        return $this->arcModel->insertArticle(htmlspecialchars($userID), htmlspecialchars($name), htmlspecialchars($content), htmlspecialchars($file));
    }

    public function executeGetAllArticles() {
        return $this->arcModel->getAllArticles();
    }

    public function executeGetAllPublicArticles() {
        return $this->arcModel->getAllPublicArticles();
    }

    public function executeGetArticle($articleID) {
        return $this->arcModel->getArticle($articleID)->fetch();
    }

    public function executeDeleteArticle($articleID) {
        return $this->arcModel->deleteArticle($articleID);
    }

    public function executeChangeContent($articleID, $content) {
        return $this->arcModel->changeContent(htmlspecialchars($articleID), htmlspecialchars($content));
    }

    public function executeChangeName($articleID, $name) {
        return $this->arcModel->changeName(htmlspecialchars($articleID), htmlspecialchars($name));
    }

    public function executeIsPublic($articleID) {
        return $this->arcModel->isPublic($articleID);
    }

    public function executeChangeState($articleID, $state) {
        return $this->arcModel->changeState($articleID, $state);
    }

    public function executeChangePublic($articleID, $public) {
        return $this->arcModel->changePublic($articleID, $public);
    }

    public function executeGetAuthor($articleID) {
        return $this->arcModel->getAuthor($articleID);
    }

    public function executeArticleAlreadyExists($name, $content) {
        return $this->arcModel->articleAlreadyExists($name, $content);
    }

    public function work() {
        $articles = $this->executeGetAllArticles();
        foreach ($articles as $article) { // for every article test if it should be deleted
            $deleteString = "deleteArticle".$article['articleID'];
            if (isset($_POST[$deleteString])) {
                $this->executeDeleteArticle($article['articleID']);
                ?> <div class="alert alert-success">
                    <strong>Článek byl úspěšně smazán!</strong>
                </div> <?php
            }
        }

        ob_start();
        require("Views/Articles.php");
        $obsah = ob_get_clean();

        return $obsah;

    }

}

?>
