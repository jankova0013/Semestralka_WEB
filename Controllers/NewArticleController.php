<?php
/**
 * Class NewArticleController controller for NewArticle.php
 */

class NewArticleController{
    private $logincontroller;
    private $articlecontroller;

    public function __construct() {
    $this->articlecontroller = new ArticleController();
    $this->logincontroller = new LoginController();
    }

    public function work() {
        if(isset($_POST["action"])) {
            if($_POST["action"]=="newArticle"){
                if($_POST["articleName"]!= "" && $_POST["content"] != "") {
                    $authorID = $this->logincontroller->getLoggedUsersID();
                    if($_FILES["pdf"]["size"]) {
                        $file = $this->saveFile($_FILES['pdf'], $authorID);
                    } else {
                        $file = NULL;
                    }
                    if($file=="0") {
                        ?>
                        <div class="alert alert-danger">
                            <strong>Soubor se bohužel nepodařilo nahrát. Ujistěte se tedy, zda je Vámi zvolený soubor ve formátu pdf a nepřesahuje maximální velikost 2 MB a zkuste to, prosím, znovu.</strong>
                        </div>
                        <?php
                    } else if(!$this->articlecontroller->executeArticleAlreadyExists($_POST["articleName"], $_POST["content"])) {
                        $res = $this->articlecontroller->executeInsertArticle($authorID, $_POST["articleName"], $_POST["content"], $file);
                    }
                } else {
                    ?>
                    <div class="alert alert-danger">
                        <strong> Pro přidání příspěvku musí být vyplněn název i obsah.</strong>
                    </div>
                    <?php
                }
            }
        }

        ob_start();
        require("Views/NewArticle.php");
        $content = ob_get_clean();

        return $content;
    }

    public function saveFile($file, $authorID){
        $directory = "uploads/". $authorID. "/";
        if(!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $f = $directory . basename($file['name']);
        $size = $file['size'];

        if($size > 2000000) { // if it's bigger than 2 MB (unnecessary because PHP upload won't upload bigger file
            return 0;
        }
        $res = move_uploaded_file($file["tmp_name"], $f);
        if ($res) {
            return $f;
        } else {
            echo  "Soubor se bohužel nepovedlo nahrát, zkuste to, prosím, znovu.";
            return 0;
        }
    }




}