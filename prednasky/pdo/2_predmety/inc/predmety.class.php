<?php

/**
 * Databázová vrstva - ukázka napojení na databázi z PHP.
 * 
 * @author Ing. Martin Dostal a Ing. Martin Zíma, PhD
 *
 */
class predmety {
	
	public $connection; 	// tam si ulozim aktualni spojeni
	private $connection_type = 0;
	
	/**
	 * Konstruktor
	 * 
	 * @param int $connection_type - jedna z variant v konfiguraci. MySql nebo Oracle.
	 */
	function predmety($connection_type = DB_CONNECTION_USE_PDO_MYSQL)
	{
		$this->connection_type = $connection_type;
	}
	
	
	/**
	 * Připojí k vybrané databázi dle konstruktoru.
	 */
	function Connect()
	{
		// připojení k DB provedu dle požadovaného typu
		if ($this->connection_type == DB_CONNECTION_USE_PDO_MYSQL)
		{
			// PDO - MySQL
			try 
			{
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
				$this->connection = new PDO("mysql:host=".MYSQL_DATABASE_SERVER.";dbname=".MYSQL_DATABASE_NAME."",
											 MYSQL_DATABASE_USER, MYSQL_DATABASE_PASSWORD, $options);
				
				// nastavit pripojeni na UTF-8 - pro starsi verze PHP
				//$this->connection->exec("SET NAMES UTF8");
				
			} catch (PDOException $e) 
			{
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
		else
		{
			// DIRECT Oracle
			// $kodovani - 'EE8MSWIN1250' = Windows 1250
			//$kodovani = 'EE8MSWIN1250'; // CP-1250
			$kodovani = 'AL32UTF8'; // UTF-8

			$this->connection = oci_connect(ORACLE_DATABASE_USER, ORACLE_DATABASE_PASSWORD, ORACLE_DATABASE_NAME, $kodovani);
			
			// pomocna chyba
			$chyba = oci_error();
			if ($chyba != null) 
			{
				echo "Chyba při připojení k DB: ";
				printr($chyba);
			}
		}
	}
	
	/**
	 * Odpojí se od vybrané databáze.
	 */
	function Disconnect()
	{
		if ($this->connection_type == DB_CONNECTION_USE_PDO_MYSQL) 
			$this->connection = null;
		else 
			oci_close($this->connection); // Oracle
	}
	
	
	/**
	 *  Načíst všechny předměty. Z důvodu srozumitelnosti kombinuji češtinu a angličtinu.
	 */
	function LoadAllPredmety()
	{
		// načtení předmětů provedu dle požadovaného typu
		if ($this->connection_type == DB_CONNECTION_USE_PDO_MYSQL)
		{
			// PDO - MySQL
			$query = "select * from predmety;";
			
			// Dotaz primo
			//$statement = $this->connection->query($query);
			
			// nebo pres pripraveny statement
			$statement = $this->connection->prepare($query);
			$statement->execute();
			
			// nacist data a vratit
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		else
		{
			
			// DIRECT Oracle
			// Prikaz v SQL, ktery chceme vykonat v databazi.
			$query = "select * from predmety"; // POZOR: tady nesmi byt strednik, jinak to nefunguje
			
			// Navazani pripraveneho SQL prikazu s otevrenym spojenim do databaze.
			$statement = oci_parse($this->connection, $query);
			
			// Provest - execute
			oci_execute($statement, OCI_NO_AUTO_COMMIT);
			
			// nacist data
			oci_fetch_all($statement, $rows, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
			//printr($rows);
			
			// uvolnit statement
			oci_free_statement($statement);
			
			return $rows;
		}
	}
	
	/**
	 * Funkce vlozi predmet do databaze.
	 * 
	 * @param assoc. array $predmet - asociativni pole, klice odpovidaji atributum
	 */
	function CreatePredmet($predmet)
	{
		if ($this->connection_type == DB_CONNECTION_USE_PDO_MYSQL)
		{
			// MySql
			
			// SLOZIT TEXT STATEMENTU s otaznikama
			$insert_columns = "`datum_vlozeni`";
			$insert_values  = "now()";
				
			if ($predmet != null)
			foreach ($predmet as $column => $value)
			{
				// pridat carky
				if ($insert_columns != "") $insert_columns .= ", ";
				if ($insert_columns != "") $insert_values .= ", ";
			
				$insert_columns .= "`$column`";
				$insert_values .= "?";
			}
			
			// slozit query
			// Poznámka: název tabulky by měl být přes PHP konstantu
			$stmt_text = "insert into `predmety` ($insert_columns) values ($insert_values);";
			echo "SQL pro INSERT - statement: ".$stmt_text;
			$stmt = $this->connection->prepare($stmt_text);
			//printr($stmt);
					
			// NAVAZAT HODNOTY k otaznikum dle poradi od 1
			$bind_param_number = 1;
					
			if ($predmet != null)
			foreach ($predmet as $column => $value)
			{
				$stmt->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
				$bind_param_number ++;
			}
						
			// provest dotaz
			$stmt->execute();
			
			// tohle by urcilo ID typu auto increment pro prave vlozeny predmet
			//$item_id = $this->connection->lastInsertId(); 
			$item_id = 999;
			return $item_id;
			// KONEC MySql
		}
		else
		{
			// Oracle
			
			// SLOZIT TEXT STATEMENTU s otaznikama
			$insert_columns = "";
			$insert_values  = "";
			
			
			
			if ($predmet != null)
			foreach ($predmet as $column => $value)
			{
				// pridat carky
				if ($insert_columns != "") $insert_columns .= ", ";
				if ($insert_values != "") $insert_values .= ", ";
						
				$insert_columns .= "$column";
				$insert_values .= ":$column";
				
			}
					
			// slozit query
			// Poznámka: název tabulky by měl být přes PHP konstantu
			$stmt_text = "insert into predmety ($insert_columns) values ($insert_values)";
			echo "SQL pro INSERT - statement: ".$stmt_text;
			$stmt = oci_parse($this->connection, $stmt_text);
			
			// NAVAZAT HODNOTY k otaznikum dle poradi od 1
				
			if ($predmet != null)
			foreach ($predmet as $column => $value)
			{
				// tuto chybu nasel Martin Zíma
				oci_bind_by_name($stmt, ":$column", $predmet[$column]);
				//oci_bind_by_name($stmt, ":$column", $value);  - nefunguje, viz http://www.php.net/manual/en/function.oci-bind-by-name.php
			}
			
			
			// provest dotaz
			$result = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
			//printr($result);
			
			$chyba = oci_error($stmt);
			printr($chyba);
			
			// KONEC Oracle
		}
	}
}


?>