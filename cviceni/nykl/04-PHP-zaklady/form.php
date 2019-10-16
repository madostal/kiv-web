<?php
    // pripojeni souboru s funkcemi

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulář s ukázkou PHP</title>
    </head>
    <body>
        <h1>Formulář s ukázkou PHP</h1>

        <!-- pri odesilani souboru musi byt doplnen atribut enctype="multipart/form-data" -->
        <form autocomplete="off">
            <fieldset>
                <legend>Registrační formulář</legend>
                <br>

                <table>
                    <tr>
                        <td>
                            <label for="jm">Jméno:</label>
                        </td>
                        <td>
                            <input type="text" name="jmeno" id="jm">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="pr">Příjmení:</label>
                        </td>
                        <td>
                            <input type="text" name="prijmeni" id="pr">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="em">E-mail:</label>
                        </td>
                        <td>
                            <input type="email" name="email" id="em">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="sou">Soubory:</label>
                        </td>
                        <td>
                            <input type="file" name="soubory[]" id="sou" multiple>
                        </td>
                    </tr>
                </table>
                <br>

                <label for="zv">Oblíbené zvíře (s CTRL zvolte více zvířat):</label>
                <br>
                <select name="zvire[]" size="5" id="zv" multiple>
                    <?php
                        // doplnte funkci, ktera jako volby nacte zvirata ze souboru zvirata.txt

                    ?>
                </select>
                <br><br>

                <label for="po">Pozdrav:</label>
                <select name="pozdrav" id="po">
                    <option value="alfa">Alfa</option>
                    <option value="beta">Beta</option>
                    <option value="gama">Gama</option>
                </select>
                <br><br>

                <input type="submit" value="Odeslat formulář">
                <input type="reset" value="Smazat formulář">
            </fieldset>
        </form>
    </body>
</html>