<?php
// wrapper/adapter pro vypis sablony v PHP
// vyuzito pro sablona.wrap.php	
class Wrapper {
	
    /*
     *  Nacitani sablon ze souboru vyuzitim Wrapperu.
     *  Návrhovy vzor Adapter. (univerzalni, funguje vzdy)
     *  @param string $filename Nazev souboru i s cestou.
     *  @return string          Obsah souboru pro vypsani.
     */
    public static function phpWrapperFromFile($filename)
	{
		ob_start(); // odchytava vystup
		
		if (file_exists($filename) && !is_dir($filename))
		{
            // nacte soubor
            // protoze jde o vypis HTML, tak se vystup ulozi do pameti 
			include($filename); 
		}
        
        // vrati vystup z pameti
		$obsah = ob_get_clean();
		
        return $obsah;
	}	
}
?>
