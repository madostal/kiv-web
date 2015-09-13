<?php

	/**
	 *  Ukazka jednoduche aplikace s MVC.
	 *
	 */
	
	// nacist konfiguraci
	require 'config/config.inc.php';
	require 'config/functions.inc.php';					// pomocne funkce
	
	// nacist objekty - soubory .class.php
	require 'application/core/app.class.php';			// drzi hlavni funkcionalitu cele aplikace, obsahuje routing = navigovani po webu
	require 'application/core/db.class.php';			// zajisti pristup k db a spolecne metody pro dalsi pouziti
	require 'application/core/predmety.class.php';		// zajisti pristup ke konkretnim db tabulkam - objekt vetsinou zajisti pristup k cele sade souvisejicich tabulek
	
	// start the application
	$app = new app();
	
	// pripojit k db
	$app->Connect();
	
	// pripojeni k db
	$db_connection = $app->GetConnection();
	
	// vytvorit objekt, ktery mi poskytne pristup k DB a vlozit mu connector k DB
	$predmety = new predmety($db_connection);
	
	
	// nacist vstupy - napr. ID clanku, ktery mam zobrazit
		$id = @$_REQUEST["id"] + 0;
		
		// nebo q = pozadovane url, ktere jsem dostal z .htaccess
	
	
	// zpracovat si data pro vystup
		// nejake vypocty apod
		$a = 1;
		$b = 2;
		//$c = $a + $b;
		$c = $app->Secti($a, $b);
	
		
	// nacist vsechny predmety
		$predmety_data = $predmety->LoadAllPredmety();
		echo "Predmety:";
		printr($predmety_data);	// specialni funkce pro vypis
		
	// Vypis dat
		// TODO nevypisovat to primo, ale s vyuzitim sablonovaciho systemu
		// v nejhorsim to musi byt aspon v oddelenem souboru v casti templates nebo view
		
		echo "<html>";
			echo "<head>";
			echo "</head>";
			echo "<body>";
				echo "<h1>Moje aplikace</h1>";
				
				echo "Použitá databáze: ".DB_DATABASE_NAME."<br/>";
				echo "c = $c <br/>";
			echo "</body>";
		echo "</html>";
	// Konec vypis dat
?>