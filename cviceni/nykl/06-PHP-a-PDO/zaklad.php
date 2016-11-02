<?php 
// zaklad stranky

/**
 *  Vytvoreni hlavicky stranky.
 *  @param string $title Nazev stranky.
 */
function head($title=""){    
?>
<!doctype>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <style>
            body { background-color: orange; }
            nav { background-color: darkblue; margin-bottom: 10px; padding: 5px; color:lightgray;}
            nav a { color: aliceblue; padding: 5px;}
        </style>
    </head>
    <body>
        <h1><?php echo $title; ?></h1>
        <nav>Menu: 
            <a href="index.php?page=0">Login/Logout</a> |
            <a href="index.php?page=1">Registrace</a> |
            <a href="index.php?page=2">Sprava osobních údajů</a> |
            <a href="index.php?page=3">Sprava uživatelů</a>
        </nav>
        <div>
<?php 
}

/**
 *  Vytvoreni paticky.
 */
function foot(){
?>                
        </div>
    </body>
</html>


<?php
    
}

?>