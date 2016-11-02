<?php 
    // nacteni hlavicky stranky
    include("zaklad.php");
    head("Správa uživatelů");
?>


<?php 
    // načtení souboru s funkcemi

?>

<?php
    
   ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////        
?>
        <b>Tato strána je dostupná pouze přihlášeným uživatelům.</b>
<?php
   ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////
        
   ///////////// PRO PRIHLASENE UZIVATELE - NENI ADMIN ///////////////                
?>
        <b>Správu uživatelů mohou provádět pouze uživatelé s právem Administrátor.</b>
<?php
   ///////////// KONEC: PRO PRIHLASENE UZIVATELE - NENI ADMIN ///////////////                
        
   ///////////// PRO PRIHLASENE UZIVATELE - JE ADMIN ///////////////                

        // zpracovani odeslanych formularu

?>
        <b>Seznam uživatelů</b>
        <table border="1">
            <tr><th>ID</th><th>Login</th><th>Jméno</th><th>E-mail</th><th>Právo</th><th>Akce</th></tr>
        </table>        
<?php
    /* // akce by mela obsahovat formular s tlacitkem:
        <form action="" method="POST">
            <input type="hidden" name="user-id" value="....">
            <input type="submit" name="potvrzeni" value="Smazat">
        </form>
    
    */
   ///////////// KONEC: PRO PRIHLASENE UZIVATELE - JE ADMIN ///////////////                
?>

<?php
    // paticka
    foot();
?>
             