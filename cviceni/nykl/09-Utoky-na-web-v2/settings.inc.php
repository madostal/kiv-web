<?php
//// pripojeni k DB

// verze pro students.kiv.zcu.cz
/*define("DB_HOST", "localhost");
define("DB_NAME", "db1_vyuka");
define("DB_USER", "db1_vyuka");
define("DB_PASSORD", "db1_vyuka");
*/

// verze pro vlastni PC
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_USER", "root");
define("DB_PASSWORD", "");


//// nazvy tabulek
$username = "username";
define("TABLE_UZIVATELE", $username."_uzivatele");
define("TABLE_PRAVA", $username."_prava");
define("TABLE_KNIHA", $username."_kniha");


?>