<?php

require_once('./dao.class.php');
require_once('./view.class.php');

// define constants
$vielieb = 1;
$sarah = 2;


$dao = new Dao();
$flash = array();

if (isset($_POST) && !empty($_POST)) {
  $flash[] = $dao->save($_POST);
}


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
  $vieliebTemplate = new View();
  $vieliebTemplate->posts = $res;
  return $vieliebTemplate->render('column.php');
}


$vieliebColumn = buildColumn($dao->getPosts(1));
$sarahColumn = buildColumn($dao->getPosts(2));


// build lauout with content
$layout = new View();
$layout->flash = $flash;
$layout->pcontent = $vieliebColumn;
$layout->scontent = $sarahColumn;

// output of complete site:
echo $layout->render('layout.php');

?>

