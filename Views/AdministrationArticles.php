<!doctype html>
<html>
<?php
$template = new Template();
$template->getHTMLHeader("Administrace článků");
$template->getMenu("Administrace");

        if($this->logincontroller->isAdminSession()){ //if user is admin
            ?>

            <!-- Začátek textu stránky -->
            <div id="admin">
            <h2 id="noenter"> Administrace článků </h2>
            Pro administraci uživatelů klikněte na odkaz: <a href="index.php?page=administration">administrace uživatelů</a>
            <br><br>

            <form method="post">
                <?php
                $table = "<table><tr><td>Název</td><td>Obsah</td><td>Autor</td><td>Recenze</td><td>Stav</td><td>Veřejný</td></tr>";
                $articles = $this->articleController->executeGetAllArticles();

                foreach ($articles as $article) {
                    $table .= "<tr><td>" . substr($article['name'], 0, 40);
                    if (strlen($article['name']) > 40) {
                        $table .= "..";
                    }
                    $table .= "</td>";
                    $table .= "<td>" . mb_substr($article['content'], 0, 80);
                    if (strlen($article['content']) > 80) {
                        $table .= "..";
                    }
                    $table .= "</td>";
                    $table .= "<td>" . $this->logincontroller->executeGetUser($article['user_userID'])['0']['name'] . "</td>";
                    $count = count($this->reviewcontroller->executeGetArticlesReviews($article['articleID'])); // count of reviews
                    $table .= "<td>Počet recenzí: " . $count . " <a href='index.php?page=reviews&articleID=" . $article['articleID'] . "'>recenze</a></td>";
                    $table .= "<td><select name='state" . $article['articleID'] . "'>
                    <option value='v řízení' ";
                    if (($article["state"]) == "v řízení") {
                        $table .= "selected='selected'";
                    }
                    $table .= "> v řízení </option>";
                    $table .= "<option value='přijat' ";
                    if (($article["state"]) == "přijat") {
                        $table .= "selected='selected'";
                    }
                    $table .= "> přijat </option>";
                    $table .= "<option value='odmítnut' ";
                    if (($article["state"]) == "odmítnut") {
                        $table .= "selected='selected'";
                    }
                    $table .= "> odmítnut </option>";
                    $table .= "</select></td>";
                    $table .= "<td> <select name='public" . $article['articleID'] . "'>";
                    $table .= "<option value='ano' ";
                    if ($article["public"] == "ano") {
                        $table .= "selected='selected'";
                    }
                    $table .= "> ano </option>";
                    $table .= "<option value='ne' ";
                    if ($article["public"] == "ne") {
                        $table .= "selected='selected'";
                    }
                    $table .= "> ne </option>";
                    $table .= "</select></td>";
                }

                $table .= "</table>";
                echo $table;
                ?>
                <button type="submit" name="action" value="articles"> Potvrdit</button>
            </form>
            </div>

            <?php
        } else { // if user isn't admin
            ?>

            <div id="admin"><h6> Administrace je přístupná pouze administrátorům.</h6></div>

            <?php
        }
    ?>



</body>
</html>




