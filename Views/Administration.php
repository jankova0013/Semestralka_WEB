<!doctype html>
<html>
<?php
$template = new Template();
$template->getHTMLHeader("Administrace");
$template->getMenu("Administrace");

if($this->logincontroller->isAdminSession()) { //if user is admin
    ?>

    <!-- Začátek textu stránky -->
    <div id="admin">
    <h2 id="noenter"> Administrace uživatelů </h2>
    Pro administraci článků klikněte na odkaz: <a href="index.php?page=administrationArticles">administrace článků</a>
    <br><br>

    <!-- form for user administration -->
    <form method="post">
    <?php
    $table = "<table> <tr> <td>Jméno </td> <td> Heslo</td> <td>Role</td><td>Akce</td></tr>";
    $users = $this->logincontroller->executeGetAllUsers();

    foreach($users as $user) {
        $table .= "<tr><td>".$user['name']."</td>
         <td>".$user['password']."</td>
         <td><select name='role".$user['userID']."'> <option value='autor' "; if($user['role']=="autor"){$table.= "selected='selected'";}
            $table .= ">autor</option>
            <option value='recenzent' "; if($user['role']=='recenzent'){$table.= "selected='selected'";}
            $table .= ">recenzent</option>
            <option value='správce' "; if($user['role']=="správce"){$table.= "selected='selected'";}
            $table .= ">správce</option>
         </select></td>
         <td> <td> ban: <select name='ban".$user['userID']."'> <option value='ano' "; if(($user["ban"])=="ano"){$table.= "selected='selected'";}
            $table .= ">ano</option>
            <option value='NULL' "; if(($user["ban"])==NULL){$table.= "selected='selected'";}
            $table .= ">ne</option></td>
            <td>Smazat: <input type='checkbox' name='deleteUser".$user['userID']."' value='yes'> </td></tr>";
    }
    $table .= "</table>";
    echo $table;

    ?>
        <button type="submit" name="action" value="users">Potvrdit</button>
    </form>
    </div>

    <?php
   } else { // if user isn't admin
    ?>
        <div id="admin">
       <h6>Omlouváme se, administrace je přístupná pouze pro administrátory.</h6>
        </div>

    <?php
   }
    ?>






    
    
       
        
        
    
    </body>
</html>