<!doctype html>
<html>
<?php
$template = new Template();
$template->getHTMLHeader("Přihlášení");
$template->getMenu("Přihlášení");

    if (!$this->isUserLogged()) {
    ?>
    <div id="login">
    <h2> Přihlášení uživatele </h2>
    <form method="post">
        <table>
            <tr><td>Jméno:</td> <td><input type="text" name="name"> </td> </tr>
            <tr><td> Heslo: </td><td><input type="password" name="passwd"></td> </tr>
        </table>
        <button type="submit" name="action" value="login"> Odeslat </button>
    </form>
    <br>
    </div>

 <?php

    } else { //if user is logged
        ?>
    <div id="login">
        <h2> Odhlášení uživatele</h2>
        <form method="post">
            <button type="submit" name="action" value="logout"> Odhlásit </button>
        </form>
    </div>
    <?php
    }
    ?>


        
        
    
    </body>
</html>