<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro prihlaseni/odhlaseni uzivatele ////////////////
///////////////////////////////////////////////////////////////////

    // nacteni souboru s funkcemi


    // nacteni hlavicky stranky
    require_once("ZakladHTML.class.php");
    ZakladHTML::createHeader("Přihlášení a odhlášení uživatele");


    // zpracovani odeslanych formularu


    ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////

?>
        <h2>Přihlášení uživatele</h2>

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


    ///////////// PRO PRIHLASENE UZIVATELE /////////////

?>
        <h2>Přihlášený uživatel</h2>

        Login: <?php  ?><br>
        Jméno: <?php  ?><br>
        E-mail: <?php  ?><br>
        Právo: <?php  ?><br>
        <br>

        Odhlášení uživatele:
        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <input type="submit" name="potvrzeni" value="Odhlásit">
        </form>
<?php

    ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////

    // paticka
    ZakladHTML::createFooter();
?>
