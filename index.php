<?php

require_once('./dao.class.php');
require_once('./view.class.php');
require_once('./helper.php');

$flash = array();
$dao = new Dao();
$layout = new View();

// cookie lesen und session starten
session_start();

if (isset($_GET) && key_exists('logout', $_GET)) {
    $dao->logout();
}

if (isset($_POST) && !empty($_POST)) {
    if(isset($_POST['login-submit'])) {
        // login form
        $flash[] = $dao->login($_POST['login-name'], $_POST['login-password']);
    } else {
        // form for posting a finance dingelings
        $flash[] = $dao->save($_POST);
    }
}

if (key_exists('loggedin', $_SESSION) && $_SESSION['loggedin'] === true) {
    // display seite ganz normal
    $vieliebColumn = buildColumn($dao->getPosts(1));
    $sarahColumn = buildColumn($dao->getPosts(2));
    $mainTemplate = new View();
    $mainTemplate->pcol = $vieliebColumn;
    $mainTemplate->scol = $sarahColumn;
    // diff username and amount
    $diff = $dao->calcDiff();
    $mainTemplate->diffUsername = $diff['diffUsername'];
    $mainTemplate->diffAmount = $diff['diffAmount'];
    $layout->content = $mainTemplate->render('main.php');
} else {
    $login = new View();
    $layout->content = $login->render('login.php');
}

$layout->flash = $flash;

// seite an den browser schicken
echo $layout->render('layout.php');

?>


