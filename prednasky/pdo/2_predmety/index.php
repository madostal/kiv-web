<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
</head>
<body>
<?php 

	// zapnutí výpisu všech chyb
	//error_reporting(E_ALL);

	// nacist konfiguraci
	require_once("inc/db_settings.inc.php");

	// nacist databazovou vrstvu
	require_once("inc/predmety.class.php");
	echo "<!-- objekt predmety.class.php je nacten -->";
	
	
	// pomocna funkce
	if (!function_exists("printr"))
	{
		function printr($val)
		{
			echo "<hr><pre>";
			print_r($val);
			echo "</pre><hr>";
		}
	}
	
	echo "<h1>DB1 - úvod do PHP + MySql/Oracle</h1>";
	echo "<p>V dané databázi musíte mít vytvořenou tabulku předměty.</p>";

	
	echo "<p>SQL pro MySql:</p>";
	echo "<pre><code>
				CREATE TABLE IF NOT EXISTS `predmety` (
				  `zkratka` varchar(10) COLLATE utf8_czech_ci NOT NULL,
				  `nazev` varchar(50) COLLATE utf8_czech_ci NOT NULL,
				  `kredity` int(11) NOT NULL,
				  `hodin_pr` int(11) NOT NULL,
				  `hodin_cv` int(11) NOT NULL,
				  `vlozil` varchar(30) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
				  `datum_vlozeni` datetime NOT NULL,
				  `upravil` varchar(30) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
				  `datum_upraveni` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY (`zkratka`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
			</code></pre>";
	
	
	echo "<p>Testovací data:</p>";
	echo "<pre><code>
				INSERT INTO `predmety` (`zkratka`, `nazev`, `kredity`, `hodin_pr`, `hodin_cv`, `vlozil`, `datum_vlozeni`, `upravil`, `datum_upraveni`) VALUES
					('KIV/DB1', 'Databázové systémy 1', 5, 2, 2, 'Dostal', '2013-11-15 00:00:00', '', '2013-11-15 18:38:31'),
					('KIV/DB2', 'Databázové systémy 2', 6, 4, 5, 'Dostal', '2013-11-15 00:00:00', '', '2013-11-15 18:40:35'),
					('KIV/WEB', 'Web', 3, 2, 1, 'Dostal', '2013-11-15 00:00:00', '', '2013-11-15 18:41:00');
				</code></pre>";
	
	echo "<p>SQL pro Oracle:</p>";
	echo "<pre><code>
				CREATE TABLE predmety
				(
					zkratka VARCHAR2(10) NOT NULL,
					nazev VARCHAR2(50) NOT NULL,
					kredity NUMBER NOT NULL,
					hodin_pr NUMBER NOT NULL,
					hodin_cv NUMBER NOT NULL,
					vlozil VARCHAR2(30) DEFAULT USER NOT NULL,
					datum_vlozeni DATE DEFAULT SYSDATE NOT NULL,
					upravil VARCHAR2(30) DEFAULT USER NOT NULL,
					datum_upraveni VARCHAR2(30) DEFAULT SYSDATE NOT NULL,
					CONSTRAINT predmety_pk PRIMARY KEY (zkratka)
				);
			</code></pre>";
	
	echo "<p>Testovací data:</p>";
	echo "<pre><code>
				INSERT INTO predmety (zkratka, nazev, kredity, hodin_pr, hodin_cv) VALUES ('KIV/DB1', 'Databázové systémy 1', 5, 2, 2);
				</code></pre>";
	echo "<p>Poznámky k testovacím datům pro Oracle:</p>";
	echo "<ul>";
		echo "<li>Nesmí se používat backticks \"`\" k označení názvu sloupců.</li>";
		echo "<li>Oracle umí doplnit login připojeného uživatele. Tohle MySql přes definici v tabulce neumí.</li>";
	echo "</ul>";
	// ***************************************************************************
	// ***********   START MySql  ************************************************
	// ***************************************************************************
	
		echo "<h2>Připojení k MySql</h2>";
		
		// vytvorit objekt s danou konfiguraci
		$predmety = new predmety(DB_CONNECTION_USE_PDO_MYSQL);
	
		// připojit k databázi
		$predmety->Connect();
		
		/*
		// vlozit predmet - nechavat zakomentovane !!!
			
			// asociativni pole - data predmetu
			$predmet = array();
			$predmet["zkratka"] = "KIV/OS";
			$predmet["nazev"] = "Operační systémy";
			$predmet["kredity"] = "4";
			$predmet["hodin_pr"] = "2";
			$predmet["hodin_cv"] = "2";
			$predmet["vlozil"] = "Dostal";
			
			// provest vlozeni
			$predmet_id = $predmety->CreatePredmet($predmet);
				
			// pokud bych mel generovana ID
			//echo "<p>Byl vložen nový předmět s ID: <b>$predmet_id</b>.</p>";
		// konec vlozit predmet
		*/
		
		// nacti vsechny predmety z databaze
		echo "<p>Seznam předmětů z databáze:</p>";
		$predmety_items = $predmety->LoadAllPredmety();
		printr($predmety_items);
		
		// ukazka for
		/*
		for ($i=0; $i < 10; $i++)
		{
			echo "$i <br/>";
		}
		*/
		
		echo "<table>";
		echo "<tr><td>Zkratka</td><td>Název</td><td>Kredity</td></tr>";
		
		if ($predmety_items != null)
		foreach ($predmety_items as $item)
		{
			echo "<tr><td>$item[zkratka]</td><td>$item[nazev]</td><td>$item[kredity]</td></tr>";
			
			// takhle radeji ne
			//echo "<tr><td>".$item["zkratka"]."</td><td>".$item["nazev"]."</td><td>".$item["kredity"]."</td></tr>";
		}

		echo "</table>";
		
		// odpojit od databáze
		$predmety->Disconnect();
		
		// zabit objekt
		unset($predmety);
		
	// ***************************************************************************
	// ***********   KONEC MySql  ************************************************
	// ***************************************************************************
	
	// ***************************************************************************
	// ***********   START Oracle  ***********************************************
	// ***************************************************************************
	
		echo "<h2>Připojení k Oracle</h2>";
		
		// vytvorit objekt s danou konfiguraci
		$predmety = new predmety(DB_CONNECTION_USE_DIRECT_ORACLE);
	
		// připojit k databázi
		$predmety->Connect();
		
		/*
		// vlozit predmet - nechavat zakomentovane !!!
			
			// asociativni pole - data predmetu
			$predmet = array();
			$predmet["zkratka"] = "KIV/OS";
			$predmet["nazev"] = "Operační systémy";
			$predmet["kredity"] = "4";
			$predmet["hodin_pr"] = "2";
			$predmet["hodin_cv"] = "2";

			// provest vlozeni
			$predmet_id = $predmety->CreatePredmet($predmet);
			
			// pokud bych mel generovana ID
			//echo "<p>Byl vložen nový předmět s ID: <b>$predmet_id</b>.</p>";
		// konec vlozit predmet
		*/
		
		
		// nacti vsechny predmety z databaze
		echo "<p>Seznam předmětů z databáze:</p>";
		$predmety_items = $predmety->LoadAllPredmety();
		printr($predmety_items);

		
		// odpojit od databáze
		$predmety->Disconnect();
	
	// ***************************************************************************
	// ***********   KONEC Oracle  ***********************************************
	// ***************************************************************************

?>
</body>
</html>