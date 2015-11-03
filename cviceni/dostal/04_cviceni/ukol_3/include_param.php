<?php
/**
 * Created by PhpStorm.
 * User: martanekx
 * Date: 3.11.2015
 * Time: 14:52
 */


    $include_filename = @$_GET["include_filename"];


    if ($include_filename == "")
    {
        echo "Není žádný parametr. <a href=\"include_param.php?include_filename=data\">Includni data</a>";
    }
    else {
        echo "Parametr z URL - GET: $include_filename";

        // cestu si vzdy musim kontrolovat sam a musim presne kontrolovat mozne vstupy
        // nikdy v parametru nesmim predavat cestu
        if ($include_filename == "data")
            include_once("data.inc.php");
    }