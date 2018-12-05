<?php

class userModel extends baseModel {

    public function LoadAllUsers(){

        //$table_name = TABLE_KNIHA; // idealne z konstanty z konfigurace
        $table_name = "uzivatele";

        // ukazka podminky
        $where_array = array();
        //$where_array[] = array("column" => "jmeno", "symbol" => "=", "value" => "Admin");

        $uzivatele = $this->DBSelectAll($table_name, "*", $where_array);
        //printr($uzivatele);

        return $uzivatele;
    }
}
