<?php

    /*** mysql hostname ***/
    $hostname = 'localhost';

    /*** mysql username ***/
    $username = 'username';

    /*** mysql password ***/
    $password = 'password';

    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);

        // info, ze jsme pripojeni
        echo 'Connected to database';
    }
    catch(PDOException $e)
    {
        // zobrazit chybu
        echo $e->getMessage();
    }

?>