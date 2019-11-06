@ECHO Programova dokumentace PHP aplikace.
php phpDocumentor(new_php7.2).phar -v -d ../src/ -t ./my_documentation/ --template="clean"