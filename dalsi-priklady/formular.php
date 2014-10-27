<?php 

	$action = @$_REQUEST["action"] ."";

	if ($action == "")
	{
		// zobrazit form
		echo "	<form method=\"post\">
					<input type=\"hidden\" name=\"action\" value=\"login\">
				
					Login: <input type=\"text\" name=\"data[login]\" /><br/>
					Heslo: <input type=\"password\" name=\"data[heslo]\" /><br/>
					<input type=\"submit\" value=\"Odeslat\" /><br/>
				</form>";
	}
	else 
	{
		// zpracovat data
		$data = $_POST["data"];	
		
		echo "obsah pole data je: ";
		print_r($data);
	}

?>