PHP-MVC example 1
===============


# Základní struktura aplikace

* M = model - manipulace s databází
  soubor: db.class.php - připojení k DB a pomocné metody pro práci s DB
  soubor: predmety.class.php - manipulace s konkretnimi tabulkami = CRUD operace
* V = view - šablona a zobrazení výstupu uživateli
  soubor: v teto verzi aplikace chybi, vystup se sklada primo v index.php, což není správně. Správně by to mělo být buď aspoň v odděleném souboru
	v adresáři templates, nebo ještě lépe s využitím šablonovacího systému.
* C = controller - kontrola běhu aplikace, 
  soubor: app.class.php