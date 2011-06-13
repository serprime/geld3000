<?php

require_once('./dao.class.php');
require_once('./view.class.php');
require_once('./helper.php');

$flash_error = array();
$flash_success = array();
$dao = new Dao();
$layout = new View();

// cookie lesen und session starten
session_start();

if (isset($_GET) && key_exists('logout', $_GET)) {
    $dao->logout();
}

if(isset($_GET['post_id']) &&$_GET['post_id'] != '') {
    $post_id = $_GET['post_id'];
    echo $dao->getPost($post_id);
    die;
}

if(isset($_GET['edit_post']) && $_GET['edit_post'] != '') { 
    $post_id = $_GET['edit_post'];
    $value = $_GET['value'];
    $note = $_GET['note'];
    echo $dao->editPost($post_id, $value, $note);
    die;
}

if(isset($_GET['delete_post']) && $_GET['delete_post'] != '') {
    $post_id = $_GET['delete_post'];
    echo $dao->deletePost($post_id);
    die;
}

if(isset($_GET['post_add']) && $_GET['post_add'] != '') {
    $post = array();
    $post['value'] = $_GET['post_val'];
    $post['notes'] = $_GET['post_note'];
    echo $dao->save($post);
    die;
}


if (isset($_POST) && !empty($_POST)) {
    if(isset($_POST['login-submit'])) {
        // login form
        $success = $dao->login($_POST['login-name'], $_POST['login-password']);
        if($success == '1') {
            showSuccessMessage("Du bist eingeloggt");
        } else {
            $flash_error[] = ("Aus irgendeinem unerklärlich komplexen Grund konntest du nicht eingeloggt werden");
        
        }
    } else {
        // form for posting a finance dingelings
        $success = $dao->save($_POST);
        if($success == '-2') {
            showErrorMessage("He du Oasch, des war jetzt aber ka Zahl!");
        } else if($success == '-1') {
              showSuccessMessage("Da hat der Vielieb wohl einen Fehler in der query!");
        }
    }
}

if (key_exists('loggedin', $_SESSION) && $_SESSION['loggedin'] === true) {
    // display seite ganz normal
    $vieliebColumn = buildColumn($dao->getPosts(1), 1);
    $sarahColumn = buildColumn($dao->getPosts(2), 2);
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

$layout->flash_error = $flash_error;

// seite an den browser schicken
echo $layout->render('layout.php');

?>


