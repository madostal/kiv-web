<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro spravu uzivatelu ////////////////
///////////////////////////////////////////////////////////////////

    // nacteni souboru s funkcemi


    // nacteni hlavicky stranky
    require_once("ZakladHTML.class.php");
    ZakladHTML::createHeader("Správa uživatelů");


    ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////

?>
        <div>
            <b>Tato strána je dostupná pouze přihlášeným uživatelům.</b>
        </div>
<?php
    ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////

    ///////////// PRO PRIHLASENE UZIVATELE BEZ PRAVA ADMIN ///////////////
?>
        <div>
            <b>Správu uživatelů mohou provádět pouze uživatelé s právem Administrátor.</b>
        </div>
<?php
    ///////////// KONEC: PRO PRIHLASENE UZIVATELE BEZ PRAVA ADMIN ///////////////

    ///////////// PRO PRIHLASENE UZIVATELE S PRAVEM ADMIN ///////////////

        // zpracovani odeslanych formularu

?>
        <h2>Seznam uživatelů</h2>
        <table border="1">
            <tr><th>ID</th><th>Login</th><th>Jméno</th><th>E-mail</th><th>Právo</th><th>Akce</th></tr>
            <?php

            ?>
        </table>
<?php
    /* // akce by mela obsahovat formular s tlacitkem:
        <form action='' method='POST'>
            <input type='hidden' name='id_uzivatel' value='....'>
            <input type='submit' name='potvrzeni' value='Smazat'>
        </form>
    */
    ///////////// KONEC: PRO PRIHLASENE UZIVATELE S PRAVEM ADMIN ///////////////


    // paticka
    ZakladHTML::createFooter();
?>
             