<html>
<head></head>
<body>
<?php

	// musim zapnout session
	session_start();
	
	// data o uzivateli budu ukladat do session do klice [cms_user]
	$session_key_app = "cms_user";
	
	// existuje tento klic v poli session?
	if (isset($_SESSION[$session_key_app]))
	{
		// ano, existuje
	}
	else 
	{
		// ne, neexistuje, musim ho zalozit
		$_SESSION[$session_key_app] = array();
	}
	
	
	// na zacatek zpracovat nejake pocatecni akce = action
	$action = @$_REQUEST["action"];
	
	// provest prihlaseni, pokud je pozadovano
	if ($action == "login_go")
	{
		// nekdo se pokousi prihlasit
		print_r($_POST);
		
		$login = $_POST["login"];
		$heslo = $_POST["heslo"];
		
		if ($login == "admin" && $heslo == "admin")
		{
			echo "Uživatel je přihlášen. <br/>";
			
			// prihlasit
			$_SESSION[$session_key_app]["login"] = $login;
			
		}
		else
		{
			// špatný login a heslo
			echo "Uživatel není přihlášen. Špatný login nebo heslo.<br/>";
		}
	}
	
	// provest odhlaseni
	if ($action == "logout_go")
	{
		$_SESSION[$session_key_app] = array();
		unset($_SESSION[$session_key_app]);
	}
	
	
	
	// je uzivatel prihlaseny? Existuje klic login?
	if (isset($_SESSION[$session_key_app]["login"]))
	{
		$uzivatel_prihlasen = true;
	}
	else
		$uzivatel_prihlasen = false;
	
	
	// neprihlasenemu uzivateli zobrazim prihlasovaci formular
	if ($uzivatel_prihlasen == false)
	{
		echo "<h2>Formulář pro přihlášení</h2>";
		
		echo "<br/><br/><form method=\"post\" action=\"index.php\">";
			echo "<input type=\"hidden\" name=\"action\" value=\"login_go\">";
			
			echo "Login <input type=\"text\" name=\"login\">";
			echo " Heslo <input type=\"password\" name=\"heslo\">";
			echo "<input type=\"submit\" value=\"Odeslat\">";
		echo "</form>";
	}
	else
	{
		echo "<h2>Formulář nezobrazuji, uživatel přihlášen</h2>";
		
		echo "<a href=\"index.php?action=logout_go\">Odhlásit</a>";
	}

?>
</body>
</html>