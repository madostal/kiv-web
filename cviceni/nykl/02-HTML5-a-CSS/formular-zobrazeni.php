<!doctype html>
<?php
function vypis($vstup){
    $text= "<table border><tr><td>key</td><td>value</td></tr>";
    foreach($vstup as $key => $value){
        $text.= "<tr><td>".$key."</td><td>".((is_array($value))?vypis($value):$value)."</td></tr>";
    }
    $text.= "</table>";
    return $text;
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Přijatá data z formuláře</title>
    </head>
    <body>
        <h1>Přijatá data z formuláře</h1>
        
<div><strong>Post:</strong> <br>
<?php
    echo vypis($_POST);
?></div>
        
<div><strong>Get:</strong> <br>
<?php
    echo vypis($_GET);
?></div>
        
    </body>
</html>