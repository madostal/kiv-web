<?php

/**
 * Wrapper/adapter pro vypis sablony v PHP.
 * Ukazano s sablonou sablona.tpl.php.
 */
class MyWrapper {
	
    /*
     *  Nacitani sablon ze souboru vyuzitim Wrapperu.
     *  Navrhovy vzor Adapter (univerzalni, funguje vzdy).
     *  @param string $filename Nazev souboru i s cestou.
     *  @return string          Obsah souboru pro vypsani.
     */
    public static function renderWithWrapper($filename)
	{
		// zahajim Output Buffer - odchytava vystup
		ob_start();

		// mohu nacist soubor s sablnou?
		if (file_exists($filename) && !is_dir($filename))
		{
            // nacte soubor - protoze jde o vypis HTML, tak se vystup ulozi do pameti
			require($filename);
		} else {
			// nemohu nacist sablonu
			echo "Chyba: Soubor s šablonou nebyl nalezen.";
		}

        // ukonci OB a vrati vystup z pameti, ktery je i navratovou hodnotou funkce
		return ob_get_clean();
	}	
}

?>