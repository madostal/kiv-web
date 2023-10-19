REM zvetsim velikost pameti na maximum a spusteni composeru
php -d memory_limit=-1 composer.phar install

REM pokud je soubor composer.phar v jinem adresari
php -d memory_limit=-1 ../../../composer-ukazka/composer.phar install
