# Php - 2. část - úvod do OOP a PDO

## Úkoly

1. Vytvořte si aplikaci "kalkulačka" - s využitím OOP
  * a) Použijete minimálně 2 soubory: index.php a definici třídy v kalkulacka.class.php. Nejprve si vyzkoušejte zadání vstupu 
        např. pro funkci ```secti``` s pomocí proměnných ve skriptu index.php.
  * b) Předchozí variantu rozšiřte o načítání hodnot proměnných ```$a``` a ```$b``` z URL - pomocí ```$_GET```
  * c) Hodnoty ```$a``` a ```$b``` zadávejte do formuláře a zpracovávejte s využitím ```$_POST```. 
        Pokud jste data již dostali, tak zobrazte pouze výsledek.
        
2. PDO - vyzkoušejte si základní napojení na databázi s využitím PDO.

Jako databázi použijte buď školní databázi db1_vyuka ze serveru students.kiv.zcu.cz nebo použijte vlastní databázi na soukromém notebooku.

  * a) V databázi si vytvořte tabulku ```predmety``` a vložte si do ní jeden záznam. 
  * b) K databázi se připojte s využitím PDO, načtěte si všechny záznamy z tabulky predmety a data vypište např. s ```print_r```. 
  * c) Výpis předmětů ostylujte s využitím bootstrapu a vypište do přehledné tabulky s ```class = "table table-striped table-bordered"```.
       K tomuto účelu použijte funkci ```foreach```.