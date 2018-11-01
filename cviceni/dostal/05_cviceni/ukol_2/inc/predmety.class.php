<?php

class predmety extends db_pdo
{
    /**
     * Nacte vsechny predmety
     */
    public function LoadAllPredmety()
    {
        $table_name = "madostal_predmety";
        $columns = "*";
        $where = array();
        //$where[] = array("column" => "zkratka", "value" => "KIV/DB1", "symbol" => "=");

        $predmety = $this->DBSelectAll($table_name, $columns, $where);
        return $predmety;
    }


    public function InsertPredmet($predmet) {
        $table_name = "madostal_predmety";
        $ok = $this->DBInsert($table_name, $predmet);
        return $ok;
    }
}