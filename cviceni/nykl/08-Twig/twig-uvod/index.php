<?php 

	// Twig stahnout z githubu a nahrat do slozky twig-master.
    // Kontrolu provedete dle umisteni souboru Autoloader.php, viz dále.
    // Tento soubor zastupuje Controller i Model z MVC.
    // Využitím Twig jsou vytvářeny šablony, tj. část View z MVC.
	
	// načtení twigu
	require_once 'twig-master/lib/Twig/Autoloader.php';
	Twig_Autoloader::register(); // registrace autoloaderu sablon

	// cesta k adresari se sablonami - od tohoto souboru
	$loader = new Twig_Loader_Filesystem('sablony'); // urcim prostor sablon
	$twig = new Twig_Environment($loader); // nactu prostredi s "nacitacem" sablon (takhle je to bez cache)

	// ziskani dane sablony z nacteneho prostredi
	$template = $twig->loadTemplate('ukazkova-sablona.tpl');
	
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

    // render vrati kompletni vyplnenou sablonu pro vypis
	echo $template->render($template_params);
?>