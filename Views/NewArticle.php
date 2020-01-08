<!doctype html>
<?php
$template = new Template();
$template->getHTMLHeader("Nový článek");
$template->getMenu("Články");

if($this->logincontroller->isUserLogged()) {
    ?>

    <!-- Začátek textu stránky -->
    <div id="newarticle">
        <h2>Nový článek</h2>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label> Název: </label></td>
                    <td><input type="text" name="articleName"></td>
                </tr>
                <tr>
                    <td><label>Obsah:</label></td>
                    <td><textarea name="content" cols="80" rows="15"></textarea></td>
                </tr>

            </table>
            <input type="file" accept="application/pdf" name="pdf"> Maximální velikost souboru je 2MB.
            <br>
            <button type="submit" name="action" value="newArticle"> Přidat článek</button>
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
