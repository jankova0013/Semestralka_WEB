<!doctype html>
<html>
<?php
$template = new Template();
$template->getHTMLHeader("Úprava recenze");
$template->getMenu("Recenze");
if($this->logincontroller->isUserLogged()) {
?>
    <h2>Upravit recenzi</h2>

<h3 id="noenter"> Článek: </h3> <?php
   $articleID = $this->reviewcontroller->executeGetReviewingArticle($_GET['reviewID']);
   $article = $this->articlecontroller->executeGetArticle($articleID['0']['article_articleID']);
   echo " <h5 id='noenter'>".$article['name']."</h5>";
   $review = $this->reviewcontroller->executeGetReview($_GET['reviewID'])['0'];

?>
    <form method="post">
        <table>
            <tr><td>Originalita:</td> <td><select name="originality">
                        <option value="*" <?php
                        if($review["originality"]=="*") {
                            echo "selected='selected'";
                        }
                        ?>>*</option>
                        <option value="**"  <?php
                        if($review["originality"]=="**") {
                            echo "selected='selected'";
                        }
                        ?>>**</option>
                        <option value="***"  <?php
                        if($review["originality"]=="***") {
                            echo "selected='selected'";
                        }
                        ?>>***</option>
                        <option value="****"  <?php
                        if($review["originality"]=="****") {
                            echo "selected='selected'";
                        }
                        ?>>****</option>
                        <option value="*****" <?php
                        if($review["originality"]=="*****") {
                            echo "selected='selected'";
                        }
                        ?>>*****</option>
                    </select></td> </tr>

            <tr><td> Jazyková stránka: </td><td><select name="language">
                        <option value="*" <?php
                        if($review["languageQuality"]=="*") {
                            echo "selected='selected'";
                        }
                        ?>>*</option>
                        <option value="**" <?php
                        if($review["languageQuality"]=="**") {
                            echo "selected='selected'";
                        }
                        ?>>**</option>
                        <option value="***" <?php
                        if($review["languageQuality"]=="***") {
                            echo "selected='selected'";
                        }
                        ?>>***</option>
                        <option value="****" <?php
                        if($review["languageQuality"]=="****") {
                            echo "selected='selected'";
                        }
                        ?>>****</option>
                        <option value="*****" <?php
                        if($review["languageQuality"]=="*****") {
                            echo "selected='selected'";
                        }
                        ?>>*****</option>
                    </select></td> </tr>

            <tr><td> Technická stránka: </td><td>
                <select name="technical">
                    <option value="*" <?php
                    if($review["technicalQuality"]=="*") {
                        echo "selected='selected'";
                    }
                    ?>>*</option>
                    <option value="**" <?php
                    if($review["technicalQuality"]=="**") {
                        echo "selected='selected'";
                    }
                    ?>>**</option>
                    <option value="***" <?php
                    if($review["technicalQuality"]=="***") {
                        echo "selected='selected'";
                    }
                    ?>>***</option>
                    <option value="****" <?php
                    if($review["technicalQuality"]=="****") {
                        echo "selected='selected'";
                    }
                    ?>>****</option>
                    <option value="*****" <?php
                    if($review["technicalQuality"]=="*****") {
                        echo "selected='selected'";
                    }
                    ?>>*****</option>
                    <!--TODO udelat for pro vsechny moznosti a pridat vzdycky hvezdicku -->
                </select>
                </td> </tr>
            <tr><td> Komentář: </td><td><textarea name="comment" rows="3" cols="25"><?php echo $review['comment']; ?></textarea></td> </tr>
        </table>
        <button type="submit" name="action" value="changeReview"> Změnit </button>
    </form>
    <?php
} else {
    ?>
    <h6>Je nám líto, ale tato stránka je přístupná pouze pro přihlášené uživatele.</h6>
    <?php

}
?>

</body>
</html>