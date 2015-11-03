<?php

require_once 'Smarty_jstein.php';

$smarty = new Smarty_Jstein;
$name = array_key_exists('name', $_COOKIE) ? $_COOKIE['name'] : 'cizince';
$smarty->assign('name', $name);
$smarty->display('hello.tpl');

?>
