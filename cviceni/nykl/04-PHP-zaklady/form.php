<!doctype html>
<?php 
    // načtení souboru s funkcemi
?>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Formulář</title>
    </head>
    <body>
        <h1>Formulář</h1>
        
        <form action="" method="">
            <fieldset>
                <legend>Registrační formulář</legend>

                <fieldset>
                    <legend>Osobní informace</legend>
                    <br>
                    Jméno:
                    <input type="text" name="jmeno"><br>
                    <br>
                    Příjmení:
                    <input type="text" name="prijmeni" ><br>
                    <br>
                    Email:
                    <input type="email" name="email" ><br>
                    <br>
                   
                    <br>
                    
                    Nahrát soubor:<br>
                    <input type="file" name="soubor[]" multiple><br>
                    
                    Oblíbené zvíře (s CTRL zvolte více možností):<br>
                    <select name="zvire[]" size="5" multiple>
<?php
    // načtení voleb do SELECT
?>
                    </select><br>
                    <br>
                    
                    Pozdrav: 
                    <!-- select pro pozdrav -->
                    
                    
                </fieldset>
                <br>
                <input type="submit" value="Odeslat">                
                <input type="reset" value="Smazat">
            </fieldset>  
            
        </form>

        
    </body>
</html>