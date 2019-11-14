<?php 

	// Twig v.2 stahnout s vyuzitim Composeru nebo z Githubu.

/////////////////////////////////////////////////////////////////////////////////////////////

	// priprava dat pro zobrazeni v sablone (nahrazuje vrstvu Model)
	$template_params = array();
	$template_params["nadpis"] = "Seznam osob";

    // vyplnim "nejaky" obsah 
    // - na ukázku je použit obsah s HTML, který může poskytnout např. WYSIWYG editor.
    $template_params["obsah"] = "<p>První odstavec <b>textu</b>.</p> <p>Druhý <i>odstavec</i> textu.</p>";

    // uzivatele
    $template_params["uzivatele"] = array(
                                        array("jmeno"=>"František", "prijmeni"=>"Novotný"),
                                        array("jmeno"=>"Emil", "prijmeni"=>"Opatrný"),
                                        array("jmeno"=>"Běta", "prijmeni"=>"Malá")
                                    );
    // ovoce
    $template_params["ovoce"] = array("jablko","hruška","třešeň","švestka");

/////////////////////////////////////////////////////////////////////////////////////////////

    // nacist twig z vendor component ziskanych s vyuzitim Composer
    require_once '../composer/vendor/autoload.php';
    // ukazkova sablona
    $template = 'ukazkova-sablona.twig';

    // cesta k adresari se sablonami - od tohoto souboru
    $loader = new \Twig\Loader\FilesystemLoader('sablony');
    // nacteni prostredi s "nacitacem" sablon (takhle je to bez cache)
    $twig = new \Twig\Environment($loader);

    // render vrati kompletni vyplnenou sablonu pro vypis
	echo $twig->render($template, $template_params);

/////////////////////////////////////////////////////////////////////////////////////////////
?>