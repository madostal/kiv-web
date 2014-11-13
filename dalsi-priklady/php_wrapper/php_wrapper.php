<?php

	//interpretem PHP zpracuje obsah promenne
	function phpWrapper($content) 
	{
		ob_start();
		$content = str_replace('<'.'?php','<'.'?',$content);
		eval('?'.'>'.trim($content).'<'.'?');
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}
	
	echo "<br/>Ukázka 1: ";
	$string = "Hello <?php echo \"World\"; ?> !";
	$string = phpWrapper($string);
	echo $string;
	

	// nactu php kod
	$text_do_hlavicky = "abc123";
	
	echo "<br/>Ukázka 2: ";
	$php_kod = file_get_contents("php_kod.inc.php");
	//$php_kod;
	$vystup = phpWrapper($php_kod);
	echo $vystup;
	
?>