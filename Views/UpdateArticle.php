<!doctype html>
<html>
<?php
$template = new Template();
$template->getHTMLHeader("Úprava článku");
$template->getMenu("Články");
if($this->logincontroller->isUserLogged()) {
    ?>


    <!-- Začátek textu stránky -->
    <div id="updatearticle">
        <h2>Upravit článek</h2>
        <form method="post">
            <table>
                <tr>
                    <td><label> Název: </label></td>
                    <td><textarea name="articleName" cols="80"
                                  rows="1"><?php $article = $this->articlecontroller->executeGetArticle($_GET['articleID']);
                            echo $article['name']; ?></textarea></td>
                </tr> <!-- get name and content from db and display it in textareas-->
                <tr>
                    <td><label>Obsah:</label></td>
                    <td><textarea name="content" cols="80"
                                  rows="15"><?php $article = $this->articlecontroller->executeGetArticle($_GET['articleID']);
                            echo $article['content']; ?></textarea></td>
                </tr>

            </table>
            <button type="submit" name="action" value="updateArticle"> Upravit článek</button>
        </form>
    </div>
    <?php
} else {
    ?>
    <h6>Je nám líto, ale tato stránka je přístupná pouze pro přihlášené uživatele.</h6>
    <?php

}
?>




</body>
</html>
