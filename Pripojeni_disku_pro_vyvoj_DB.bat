echo PRIPOJUJI DISK AFS J:
echo toto okno se po dokonceni samo zavre
IF NOT EXIST j: net use j: \\afs\kiv.zcu.cz\kiv\home\student\%USERNAME%\public-kiv\public_html /persistent:no
echo on
