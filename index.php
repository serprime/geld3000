<?php

require_once('./model/dao.class.php');
require_once('./view.class.php');
require_once('./helper.php');

$flash_error = array();
$flash_success = array();

$dao = new Dao();
$layout = new View();

// cookie lesen und session starten
session_start();

// logout handler
if (isset($_GET) && key_exists('logout', $_GET)) {
    $dao->logout();
}

//
// ajax zeug
//
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

  // update post per GET
  if(isset($_GET['edit_post']) && $_GET['edit_post'] != '') { 
    $post_id = $_GET['edit_post'];
    $value = $_POST['value'];
    $note = $_POST['note'];
    $both = $_POST['both'];
    if ($dao->editPost($post_id, $value, $note, $both)) {
      $obj = $dao->calcDiff();
      if (!$both) {
        if ($_SESSION['user_id'] == 1) {
          $obj['other'] = "Sarah";
        } else {
          $obj['other'] = "Vielieb";
        }
      } else {
        $obj['other'] = "beide";
      }
      echo json_encode($obj);
    } else {
      echo "-1";
    }
    die;
  }

  // fetch single entry
  if(isset($_GET['post_id']) && $_GET['post_id'] != '') {
      // VALIDATE
      $post_id = $_GET['post_id'];
      if (!is_numeric($post_id)) die("-1");
      $post = $dao->getPost($post_id);
      echo $post_json = json_encode($post);
      die;
  }

  if(isset($_GET['ajax_add'])) {
    echo $dao->save($_POST);
    die;
  }

  if(isset($_GET['ajax_delete'])) {
    $post_id = $_GET['delete_id'];
    if ($dao->deletePost($post_id))
      echo json_encode($dao->calcDiff());
    else
      echo "-1";
    die;
  }
  
  die("YOU SHALL NOT SEE THIS MESSAGE!");
}







// delete handler



//
// MAIN
//

// login und post form handler
if (isset($_POST) && !empty($_POST)) {
    if(isset($_POST['login-submit'])) {
        // login form
        $success = $dao->login($_POST['login-name'], $_POST['login-password']);
        if($success == '1') {
            $flash_success[] = "Du bist eingeloggt";
        } else {
            $flash_error[] = "Aus irgendeinem unfassbar komplexen Grund konntest du nicht eingeloggt werden";
        }
    } else {
        // form for posting a finance dingelings
        $success = $dao->save($_POST);
        if($success == '-2') {
            $flash_success[] = "He du Oasch, des war jetzt aber ka Zahl!";
        } else if($success == '-1') {
            $flash_error[] = "Da hat der Vielieb wohl einen Fehler in der query!";
        }
    }
}

// main page
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
    $mainTemplate->flash_error = $flash_error;
    $mainTemplate->flash_success = $flash_success;
    $layout->content = $mainTemplate->render('templates/main.php');
} else {
    $login = new View();
    $layout->content = $login->render('templates/login.php');
}


// seite an den browser schicken
echo $layout->render('templates/layout.php');

?>


