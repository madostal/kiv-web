<?php

	// univerzalni, funguje vzdy
	function phpWrapperFromFile($filename)
	{
		ob_start();
	
		if (file_exists($filename) && !is_dir($filename))
		{
			include($filename);
		}
	
		// nacte to z outputu
		$obsah = ob_get_clean();
		return $obsah;
	}

	$page = @$_REQUEST["page"];
	
	if ($page == "")
		$page = "uvod";


	// volba souboru
	$obsah_filename = "";
	
	if ($page == "uvod")
		$obsah_filename = "obsah/uvod.inc.php";
	
	
	// zpracovat soubor a nacist do promenne
	$obsah = phpWrapperFromFile($obsah_filename);
	
	// vypis nebo twig
		// vypis primo
		echo "Hlavicka";
		echo $obsah;
		echo "Patička";
		
		// spravne by to melo byt vypsano pres twig
	
?>