# Php - 3. část - procvičení PDO, šablony, MVC

Tutorial: php-mvc-cviceni

## Úkoly

1) Navrhněte si databázi pro Vaší semestrální práci. Můžete využít např. MySql workbench. Po instalaci nástroje si vždy nejdříve zkuste uložit prázdný 
 model jako ověření, že Vám aplikace "nespadne". Pokud budete databázi vkládat do sdílené databáze db1_vyuka, nezapomeňte na prefix všech tabulek v 
 podobě ```orion_login_jmeno_tabulky```.
 
   * a) vyexportujte SQL pro vytvoření databáze, včetně: 
      Generate DROP Statements … (smazání tabulek)
      Omit SCHEMA … (bez návzu databáze)
      Generate INSERT … (vložení dat)
   * b) vložte do lokální nebo sdílené databáze

2) PDO - vyzkoušejte si základní napojení na databázi s využitím PDO - buď z lokálního počítače nebo ze serveru students.kiv.zcu.cz.

   * a) Realizujte všechny typy přístupů nad jednou tabulkou - CRUD. Můžete využít třídu pro generování PDO dotazů zde na githubu:
        ```prednasky/pdo/pdo_generovani_dotazu/db_pdo.class.php```
        
3) Vyzkoušejte si nějaký šablonovací systém, který následně použijete v rámci Vaší semestrální práce. Např. Twig. 
   Ukázku najdete na githubu: ```kiv-web/dalsi-priklady/twig_example/```