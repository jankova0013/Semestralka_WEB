<!doctype html>
<div>
<?php
$template = new Template();
$template->getHTMLHeader("Články");
$template->getMenu("Články");

        if($this->logincontroller->isUserLogged()) { // if user is logged
            echo "<div id='register'><h2> Články </h2>";
            ?>

           Pro přidání nového článku klikněte na odkaz: <a href="index.php?page=newArticle">Napsat článek</a>

            <br> <br>

            <?php
            $articles = $this->executeGetAllArticles(); // assign to articles all articles

        } else { //if user isn't logged
            echo "<h2><div id='register'>Zveřejněné články</h2>";
            $articles = $this->executeGetAllPublicArticles(); //assign to articles only public articles
        }

        foreach($articles as $article) { //print all articles one by one assigned to $articles
            $user = $this->logincontroller->executeGetUser($article['user_userID']); //get author of this article
            $loggedID = $this->logincontroller->getLoggedUsersID();
            $loggedUser = $this->logincontroller->executeGetUser($loggedID); // current user
            $content = "<b>Název:</b> " . $article['name']." <br> "
                 ."<b>Autor:</b> ".$user[0]['name'] ."<br>";
            if($loggedUser) {
                 if($user[0]['userID']==$loggedUser[0]['userID']) { //if logged user is author of this article
                     $content .= "<b> Stav: </b>" . $article['state'] . " <br>";
                 }
            }
            $content .= "<b>Obsah: </b>".$article['content'] ."<br>";
            if ($article['file'] != ''){
                $content .= '<a href="'.$article['file'].'" download>Stáhnout pdf</a> <br>';  // download link for pdf file
            }
            echo $content;
            if($loggedUser) {
                if($user[0]['userID']==$loggedUser[0]['userID']) { // if logged user is author of this article
                    $linkUpdate = "<a href='index.php?articleID=" . $article['articleID'] . "&page=updateArticle'>Upravit článek</a>";
                    echo $linkUpdate;
                    $buttonDelete = "<form method=post> <input type='submit' name='deleteArticle" . $article['articleID'] . "' value='Smazat článek'> </form>";
                    echo $buttonDelete;
                }
            }
             echo "<br><br>";
        }

    ?>
</div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>