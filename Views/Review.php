<!doctype html>
<html>

<?php
$template = new Template();
$template->getHTMLHeader("Recenze");
$template->getMenu("Recenze");


        if ($this->logincontroller->isReviewerSession()) { //verification user's role from session
        if(!isset($_GET['articleID'])) { // if user doesn't want to manage reviews (want to see his reviews)
        echo "<div id='review' class='container-fluid'> ";
        echo "<h2> Vaše recenze </h2>";
        $reviewsID = $this->executeGetReviewersReviews($userID); //get user's reviews

        foreach ($reviewsID as $reviewID) {
            $review = $this->executeGetReview($reviewID['reviewID'])[0]; // whole review in an array
            $article = $this->articlecontroller->executeGetArticle($review['article_articleID']);
            $loggedID = $this->logincontroller->getLoggedUsersID();
            $loggedUser = $this->logincontroller->executeGetUser($loggedID); //current user

            $content = "<b>Článek: </b> " . $article['name'] . " <br> "
                . "<table> <tr><td> <b>Originalita: </b>" . $review['originality'] . "</td><td><b>Jazyková stránka: </b>" . $review['languageQuality'] . "</td><td> <b>Zpracování: </b>" . $review['technicalQuality'] . "</td></tr></table> "
                . "<b>Komentář:</b> " . $review['comment'] . "<br>";


            echo $content;

            if ($article['public'] == 'ne') { //if article isn't public reviewer can edit or delete it
                $link = "<a href='index.php?page=updateReview&reviewID=".$review['reviewID'] ."'>Upravit recenzi</a>";
                echo $link;
                $buttonDelete = "<form method=post> <input type='submit' name='deleteReview" . $review['reviewID'] . "' value='Smazat recenzi'> </form>";
                echo $buttonDelete;
            }
            echo "<br>";
            echo "<br>";
            echo "<br>";
        }
        echo "</div>";
        }
        } else if(!isset($_GET['articleID'])) { //if current user isn't reviewer
            $message = "<h6>Je nám líto, ale tato stránka je přístupná pouze pro recenzenty.</h6>";
            echo $message;
        }

        if(isset($_GET['articleID'])) { // if user wants to manage reviews
            if ($this->logincontroller->isUserLogged()) {
                $article = $this->articlecontroller->executeGetArticle($_GET['articleID']);
                $users = $this->logincontroller->executeGetAllUsers();
                echo "<h5>Článek: " . $article['name'] . "</h5>";
                ?>
                <form method="post">
                    Přidělit recenzi: <select name='reviewerID'>
                        <?php
                        foreach ($users as $user) {
                            if ($this->logincontroller->isReviewer($user['userID'])) {
                                $options .= "<option value='" . $user['userID'] . "'>" . $user['name'] . "</option> ";
                            }
                        }
                        echo $options;
                        ?>
                    </select>
                    <button type="submit" name="action" value="addReview">Přidělit</button>
                </form>
                <br>
                <?php
                $reviews = $this->executeGetArticlesReviews($_GET['articleID']);
                foreach ($reviews as $review) {
                    $content = "<b>Recenzent:</b> " . $this->logincontroller->executeGetUser($review['user_userID'])['0']['name']
                        . "<table> <tr><td> <b>Originalita:</b> " . $review['originality'] . "</td><td> &nbsp &nbsp <b>Jazyková stránka</b>: " . $review['languageQuality'] . "</td><td> &nbsp&nbsp<b>Zpracování:</b> " . $review['technicalQuality'] . "</td></tr></table> "
                        . "<b>Komentář:</b> " . $review['comment'];
                    echo $content;
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                }
            } else { //if user isn't logged in
                $message = "<h6>Je nám líto, ale tato stránka je přístupná pouze pro recenzenty.</h6>";
                echo $message;

            }
        }
    ?>

       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>