<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro upravu osobnich udaju uzivatele ////////////////
///////////////////////////////////////////////////////////////////

    // nacteni souboru s funkcemi


    // nacteni hlavicky stranky
    require_once("ZakladHTML.class.php");
    ZakladHTML::createHeader("Úprava osobních údajů uživatele");


    ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////

?>
        <div>
            <b>Osobní údaje mohou měnit pouze přihlášení uživatelé.</b>
        </div>
<?php
    ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////

    ///////////// PRO PRIHLASENE UZIVATELE ///////////////

        // zpracovani odeslanych formularu

?>
        <h2>Osobní údaje</h2>
        <form action="" method="POST" oninput="x.value=(pas1.value==pas2.value)?'OK':'Nestejná hesla'"
              autocomplete="off"
        >
            <input type="hidden" name="id_uzivatel" value="<?php  ?>">
            <table>
                <tr><td>Login:</td><td><?php  ?></td></tr>
                <tr><td>Heslo 1:</td><td><input type="password" name="heslo" id="pas1"></td></tr>
                <tr><td>Heslo 2:</td><td><input type="password" name="heslo2" id="pas2"></td></tr>
                <tr><td>Ověření hesla:</td><td><output name="x" for="pas1 pas2"></output></td></tr>
                <tr><td>Jméno:</td><td><input type="text" name="jmeno" value="<?php  ?>" required></td></tr>
                <tr><td>E-mail:</td><td><input type="email" name="email" value="<?php  ?>" required></td></tr>
                <tr><td>Právo:</td>
                    <td>
                        <select name="pravo">
                            <option value=''></option>
                            <?php
                            // ziskam vsechna prava

                            ?>
                        </select>
                    </td>
                </tr>
                <tr><td>Současné heslo:</td><td><input type="password" name="heslo_puvodni" required></td></tr>
            </table>

            <input type="submit" name="potvrzeni" value="Upravit osobní údaje">
        </form>
<?php

    ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////

    // paticka
    ZakladHTML::createFooter();
?>
