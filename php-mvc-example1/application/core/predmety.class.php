<?php 

// diky extends mohu pouzivat metody db - jako DBSelect ...
class predmety extends db
{
	// konstruktor
	public function predmety($connection)
	{
		// timto si nastavim pripojeni k DB, ktere jsem dostal od app()
		$this->connection = $connection;	
	}
	
	
	public function InsertPredmet($predmet)
	{
		
	}
	
	
	public function DeletePredmetByID($predmet_id)
	{
		
	}
	
	
	public function GetPredmetByID($predmet_id)
	{
		
	}
	
	
	public function LoadAllPredmety()
	{
		$table_name = TABLE_PREDMETY;
		$select_columns_string = "*"; 
		$where_array = array();
		$limit_string = "";
		$order_by_array = array();
	
		// vrati pole zaznamu v podobe asociativniho pole: sloupec = hodnota
		$predmety = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
		//printr($predmety);
		
		// tady jeste neco pripadne dochroupat - docist vsechna potrebna data
		
		// vratit data
		return $predmety;
	}
}


?>