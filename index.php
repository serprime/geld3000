<?php

require_once('./dao.class.php');
require_once('./view.class.php');

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
        $flash[] = $dao->login($_POST['login-email'], $_POST['login-password']);
    } else {
        // form for posting a finance dingelings
        $flash[] = $dao->save($_POST);
    }
}

if ($_SESSION['loggedin'] !== true) {
    $login = new View();
    $layout->content = $login->render('login.php');
} else {
    // display seite ganz normal
    $vieliebColumn = buildColumn($dao->getPosts(1));
    $sarahColumn = buildColumn($dao->getPosts(2));
    $layout->content = $vieliebColumn . $sarahColumn;
}

$layout->flash = $flash;

// seite an den browser schicken
echo $layout->render('layout.php');




// zaumbaun der posts nach monat
function buildColumn($posts) {
  $res = array();
  foreach ($posts as $post) {
    $month = date("F", strtotime ($post['date']));

    if (!key_exists($month, $res))
      $res[$month] = array();
    $res[$month][] = $post;
  }
  // build view
  $columnTemplate = new View();
  $columnTemplate->posts = $res;
  return $columnTemplate->render('column.php');
}

?>


