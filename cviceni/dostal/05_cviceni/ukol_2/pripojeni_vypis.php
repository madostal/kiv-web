<?php
    session_start();

    // nacteni souboru
    include_once("inc/db_pdo.class.php");
    include_once("inc/predmety.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");


    // prihlaseni uzivatele
    $key_my_user = "predmety_user";
    if (isset($_SESSION[$key_my_user]))
    {
        // muzu provest
    }
    else $_SESSION[$key_my_user] = array();

    $prihlasen = false;
    if (isset($_SESSION[$key_my_user]["login"]))
        $prihlasen = true;

    //printr($_POST);
    $action = @$_POST["action"]."";
    $user = @$_POST["user"];
    if ($action == "login_go")
    {
        echo "uzivatel: ";
        printr($user);

        if (trim($user["login"]) == "admin" && trim($user["heslo"]) == "admin")
        {
            $_SESSION[$key_my_user]["login"] = $user["login"];
            $prihlasen = true;
        }
    }
    // konec prihlasovani

    if ($prihlasen)
    {
        echo "<h1>Přihlášený uživatel</h1>";
    }
    else
    {
        echo "<h1>Nepřihlášený uživatel</h1>";

        echo "<form method=\"post\">
                    <input type='hidden' name='action' value='login_go'/>
                    Login: <input type='text' name='user[login]'/>
                    Heslo: <input type='text' name='user[heslo]'/>
                    <input type='submit' value='Přihlásit'>
                </form>";
    }



    // vytvoreni objektu
    $predmety = new predmety();
    $predmety->Connect();

    $seznam_predmetu = $predmety->LoadAllPredmety();
    // printr($seznam_predmetu);

    if ($seznam_predmetu != null)
        foreach ($seznam_predmetu as $predmet)
        {
            echo "zkratka: $predmet[zkratka], nazev: $predmet[nazev] <br/>";
        }



