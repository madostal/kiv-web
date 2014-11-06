<?php 


	$page = @$_REQUEST["page"];

	if ($page == "") $page = "uvod";

	
	// povolene stranky
	$povolene_stranky = array("uvod", "kontakt");
	
	if (!in_array($page, $povolene_stranky))
	{
		exit;
	}
	
	// nacist obsah
	$nazev_souboru = "content/$page.inc.php";
	
	if (file_exists($nazev_souboru) && !is_dir($nazev_souboru))
	{
		$obsah = file_get_contents($nazev_souboru);
	}
	
	// obsah vypisu nebo poslu do Twigu
	echo $obsah;
?>