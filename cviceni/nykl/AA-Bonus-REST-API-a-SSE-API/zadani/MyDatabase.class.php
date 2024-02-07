<?php

/**
 * Trida pro praci s databazi.
 */
class MyDatabase{

    /** @var PDO $pdo  Instance PDO s pripojenim k databazi. */
    public $pdo;

    /**
     * Inicializuju PDO dle konfigurace.
     */
    public function __construct(){
        // prejmu konfiguraci
        $dbst = DATABASE_SETTINGS;
        // inicializuju PDO
        $this->pdo = new PDO(
            "mysql:host={$dbst['host']};dbname={$dbst['database']};charset=utf8",
            $dbst['username'],
            $dbst['password']
        );
        // chyby jako vyjimky
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // volitelne hlidani DBMS prepared statement behavior (nebudou vypisovany notice a warning)
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * Upravi zaznamy v databazi.
     * @param string $tableName     Jmeno tabulky.
     * @param array $whereParams    Omezujici podminka.
     * @param array $data           Pole dat jednoho zaznamu.
     * @return bool
     */
    public function update(string $tableName, array $whereParams, array $data){
        // zkusim ulozit vsechno, co prislo
        // binding pro WHERE - omezeni uprav
        $whereBindingStr = [];
        foreach (array_keys($whereParams) as $key) {
            $whereBindingStr[] = "$key = :wh_$key";
        }
        // binding pro SET - data uprav
        $setBindingStr = [];
        foreach (array_keys($data) as $key) {
            $setBindingStr[] = "$key = :s_$key";
        }

        // dotaz
        $stmt = $this->pdo->prepare(
            'UPDATE ' . $tableName
            . ' SET ' . join(",", $setBindingStr)
            // upravuju pouze konkretni jeden zaznam dle parametru
            . " WHERE ". join(" AND ", $whereBindingStr)
        );

        // binding SET hodnot pro upravu
        foreach ($data as $k => $v) {
            $stmt->bindValue(":s_" . $k, $v);
        }
        // binding WHERE hodnot pro upravu
        foreach ($whereParams as $k => $v) {
            $stmt->bindValue(":wh_" . $k, $v);
        }

        // vykonam a primo overim, jestli dotaz probehl
        return $stmt->execute();
    }

    /**
     * Vytvori zaznam v databazi.
     * Pozn.: Nasledne lze pouzit getLastInsertId() pro ziskani hodnoty nove vytvoreneho PK.
     * @param string $tableName   Jmeno tabulky.
     * @param array $data         Pole dat pro vlozeni.
     * @return bool
     */
    public function insert(string $tableName, array $data){
        // binding pro SQL
        $tmpColumns = "(". join(",", array_keys($data)) .")";
        $tmpValues = "(:". join(",:", array_keys($data)) .")";

        // dotaz
        $stmt = $this->pdo->prepare('INSERT INTO '. $tableName . $tmpColumns .' VALUES '. $tmpValues);

        // vykonam s daty a vratim vysledek
        return $stmt->execute($data);
    }

    /**
     * Dle parametru vyhleda zaznamy v databazi.
     * @param string $tableName     Jmeno tabulky.
     * @param array $whereParams    Pole [sloupec=>hodnota]. (def.=[])
     * @return array|false
     */
     public function select(string $tableName, array $whereParams = []){
        // nactu odpovidajici zaznamy z DB
        $sql = 'SELECT * FROM '. $tableName;

        // jsou parametry?
        if(!empty($whereParams)) {
            // pripojim where
            $sql .= " WHERE ";
            // pripravim binding
            foreach (array_keys($whereParams) as $key) {
                $sql .= @$c. "$key = :$key";
                $c = " AND ";
            }
        }

        // vykonam dotaz
        $stmt = $this->pdo->prepare($sql);
        // hodnoty pro binding predam primo pres pole where
        $stmt->execute($whereParams);
        // vratim vysledek
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Dle parametru smaze zaznamy v databazi.
     * @param string $tableName     Jmeno tabulky.
     * @param array $whereParams    Pole [sloupec=>hodnota]. Musi byt zadano.
     * @return bool
     */
    public function delete(string $tableName, array $whereParams){
        // jsou parametry?
        if(!empty($whereParams)) {
            $sql = 'DELETE FROM ' . $tableName;
            // pripojim where
            $sql .= " WHERE ";
            // pripravim binding
            foreach (array_keys($whereParams) as $key) {
                $sql .= @$c. "$key = :$key";
                $c = " AND ";
            }
            // dotaz
            $stmt = $this->pdo->prepare($sql);
            // vykonam a primo overim, jestli dotaz probehl
            return $stmt->execute($whereParams);
        }
        // musi byt pamaretry, jinak nemazu
        return false;
    }

    /**
     * Vrati posledni vytvorene ID/PK v databazi.
     * Naplneno po operaci insert.
     * @return string
     */
    public function getLastInsertId(){
        return $this->pdo->lastInsertId();
    }

}
