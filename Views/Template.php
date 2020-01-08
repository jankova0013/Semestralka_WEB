<?php

class Template {

    /**
     * method returns HTML <head> and <header>
     * @param $header page title
     */
 
    public function getHTMLHeader($header) {

    $header = " <head>
        <meta charset=\"utf-8\">
        <!-- nastaveni viewportu -->
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

        <title>".$header."</title>


        <!-- CSS Bootstrapu (JS v paticce) -->
       <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

        <!-- Font Awesome -->
       <!-- <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>-->
       
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

    <!-- JS Bootstrapu (CSS v hlavicce) -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>


        
        <link rel='stylesheet' href='Views/style.css'>

    </head>
    <body>
    
    <!-- Hlavička -->
    <header class='container' id='header'>
        <h1>Enviromental Days 2019 </h1>
        <p class='text-success font-weight-bold'> Oficiální stránky letošního ročníku envrimentální konference.</p>
    </header>
    ";
    echo $header;

    }

    /**
     * method returns menu of webpage
     * @param $pageTitle to choose which page in menu is active
     */
    public function getMenu($pageTitle) {
        $menu = '<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                Menu
               <span class="navbar-toggler-icon"></span>
            </button>';
        $page = 0;
        switch ($pageTitle) {
             case "Úvod":
                 $page = 1;
                 break;
             case "Články":
                 $page = 2;
                 break;
             case "Recenze":
                 $page = 3;
                 break;
            case "Administrace":
                 $page = 4;
                 break;
            case "Přihlášení" :
                $page = 5;
                break;
            case "Registrace":
                $page = 6;
                break;
        }
       



        $menu .= '<div class="collapse navbar-collapse navbar-center" id="collapsibleNavbar">
            <ul class="navbar-nav navbar-center">
                 <li class="nav-item '; if($page==1) {$menu .= 'active';} $menu .='">
                    <a class="nav-link" href="index.php?page=homepage">Úvod </a>
                </li>
                <li class="nav-item '; if($page==2) {$menu .= 'active';} $menu .='">
                    <a class="nav-link" href="index.php?page=articles">Články </a>
                </li>
                <li class="nav-item '; if($page==3) {$menu .= 'active';} $menu .='">
                    <a class="nav-link" href="index.php?page=reviews">Recenze</a>
                </li>
                <li class="nav-item '; if($page==4) {$menu .= 'active';} $menu .='">
                    <a class="nav-link" href="index.php?page=administration">Administrace</a>
                </li>
                <li class="nav-item '; if($page==5) {$menu .= 'active';} $menu .='">
                    <a class="nav-link" href="index.php?page=login">Přihlášení</a>
                </li>
                <li class="nav-item '; if($page==6) {$menu .= 'active';} $menu .='">
                    <a class="nav-link" href="index.php?page=registration">Registrace</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    ';
        echo $menu;
}
    
    
    
    
    
    
}
?>