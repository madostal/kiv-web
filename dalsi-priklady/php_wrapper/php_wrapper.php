<?php

	// varianta1 - pujde ve wampu s php 5.3
	//interpretem PHP zpracuje obsah promenne
	function phpWrapper2($content) 
	{
		ob_start();
		$content = str_replace('<'.'?php','<'.'?',$content);
		eval('?'.'>'.trim($content).'<'.'?');
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}
	
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
	
	// nactu php kod
	$text_do_hlavicky = "abc123";
	
	echo "Ukazka 1:";
	
	$filename= "php_kod.inc.php";
	$vystup = phpWrapperFromFile($filename);
	echo $vystup;
	
?>