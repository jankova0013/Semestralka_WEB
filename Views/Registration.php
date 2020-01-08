<!doctype html>
<html>
<?php
$template = new Template();
$template->getHTMLHeader("Registrace");
$template->getMenu("Registrace");
?>
        
    <!-- Začátek textu stránky -->

    <div id="register">
        <h2> Registrace uživatele </h2>
        <form method="post">
            <table>
                <tr><td>Jméno: </td><td> <input type="text" name="name"> <br></td></tr>
                <tr><td>Heslo: </td><td> <input type="password" name="passwd"> <br></td></tr>
            </table>
            <button type="submit" name="action" value="register"> Registrovat </button>
        </form>
        <br>
    </div>


        
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>