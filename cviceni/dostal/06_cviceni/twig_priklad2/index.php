<?php

    // nacist Twig pres autoloader - pokud nainstalovano pres Composer
    require_once 'vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('sablony');
    $twig = new Twig_Environment($loader, array());

    echo $twig->render('sablona1.htm', array('name' => 'Martin'));