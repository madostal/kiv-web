<?php 

	// KONFIGURACNI UDAJE PRO PRIPOJENI K DB

		// Pro vyber pripojeni - bude se to volat pri Connect
		define("DB_CONNECTION_USE_PDO_MYSQL", 1);
		define("DB_CONNECTION_USE_DIRECT_ORACLE", 2);

    // konfigurace pro pripojeni k MySql - PDO
        define("MYSQL_DATABASE_SERVER", "localhost");
        define("MYSQL_DATABASE_NAME", "db1_vyuka");
        define("MYSQL_DATABASE_USER", "db1_vyuka");
        define("MYSQL_DATABASE_PASSWORD", "db1_vyuka");


    // konfigurace pro pripojeni k Oracle - direct
			define("ORACLE_DATABASE_SERVER", "localhost");
			define("ORACLE_DATABASE_NAME", "");
			define("ORACLE_DATABASE_USER", "");
			define("ORACLE_DATABASE_PASSWORD", "");
		
	// KONEC KONFIGURACNI UDAJE PRO PRIPOJENI K DB
?>