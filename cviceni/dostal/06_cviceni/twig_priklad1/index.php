<?php

    // hello world
    require_once 'vendor/autoload.php';

    // nebo rucne atd.
    /*
    require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
    require_once 'vendor/twig/twig/lib/Twig/ExistsLoaderInterface.php';
    require_once 'vendor/twig/twig/lib/Twig/LoaderInterface.php';
    require_once 'vendor/twig/twig/lib/Twig/Loader/Array.php';
    */
    $loader = new Twig_Loader_Array(array(
        'index' => 'Hello {{ name }}!',
    ));
    $twig = new Twig_Environment($loader);

    echo $twig->render('index', array('name' => 'Fabien'));