<?php 
    // nacteni hlavicky stranky
    include("zaklad.php");
    head("Přihlášení a odhlášení uživatele");
?>

<?php 
    // načtení souboru s funkcemi

?>

<?php
   // zpracovani odeslanych formularu
        
    
   ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////        
?>
        <b>Přihlášení uživatele</b>
        <form action="" method="POST">
            <table>
                <tr><td>Login:</td><td><input type="text" name="login"></td></tr>
                <tr><td>Heslo:</td><td><input type="password" name="heslo"></td></tr>
            </table>
            <input type="hidden" name="action" value="login">
            <input type="submit" name="potvrzeni" value="Přihlásit">
        </form>

<?php
   ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////
        
   ///////////// PRO PRIHLASENE UZIVATELE ///////////////                
?>
        <b>Přihlášený uživatel</b><br>
        Jméno: <br>
        Login: <br>
        E-mail: <br>
        Právo: <br>
        <br>
        
        Odhlášení uživatele:
        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <input type="submit" name="potvrzeni" value="Odhlásit">
        </form>
        
        
        
<?php
   ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////                
?>

<?php
    // paticka
    foot();
?>
             