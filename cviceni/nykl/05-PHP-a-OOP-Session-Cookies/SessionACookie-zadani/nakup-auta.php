<?php
    // nacteni souboru s funkcemi loginu (prace se session)

    // nacteni souboru pro praci s cookie

?>
<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Nákup automobilu</title>
    </head>
    <body>
        <h1>Nákup automobilu</h1>
<?php
   ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////        
?>
        Na tuto stránku mají přístup pouze přihlášení uživatelé.<br>
        Přihlašte se prosím: <a href="login.php">Přihlášení</a>.
        
<?php
   ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////
        
   ///////////// PRO PRIHLASENE UZIVATELE ///////////////                
?>
        <b>Přihlášený uživatel</b><br>
        Jméno: <br>
        Datum: <br>
        <br>

        Menu: <a href="login.php">Úvodní stránka s přihlášením uživatele</a><br><br>

        <form method="POST">
            <fieldset>
                <legend>Nákup automobilu</legend>
                <table>
                    <tr><td>
                            <label for="kola">Počet kol:</label>
                        </td>
                        <td>
                            <select name="kola" id="kola">
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>
                            <label for="barva">Barva:</label>
                        </td>
                        <td><input type="color" name="barva" id="barva"></td>
                    </tr>
                    <tr><td colspan="2">
                            <button type="submit" name="action" value="ulozit">
                                Uložit data
                            </button>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <br>

        <form method="post">
            <fieldset>
                <legend>Smazat uložené informace</legend>
                <button type="submit" name="action" value="smazat">
                    Smazat data
                </button>
            </fieldset>
        </form>
        
        <br><br>
        Vybraný automobil:<br>
        
<?php
   ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////                
?>
    
    </body>
</html>
             