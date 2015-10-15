echo PRIPOJUJI DISK AFS H:
echo toto okno se po dokonceni samo zavre
IF NOT EXIST h: net use h: \\afs\zcu.cz\users\%USERNAME:~0,1%\%USERNAME% /persistent:no
echo on
