<?php

// zaumbaun der posts nach monat
function buildColumn($posts, $id) {
  $res = array();
  foreach ($posts as $post) {
    $month = date("F Y", strtotime ($post['date']));

    if (!key_exists($month, $res))
      $res[$month] = array();
    $res[$month][] = $post;
  }
  // calculate sums
  $sums = array();
  foreach($res as $m => $vals) {
    $sums[$m] = 0;
    foreach($vals as $val) {
      $sums[$m] += $val['value'];
    }
    $sums[$m] = sprintf("%.2f", $sums[$m]);
  }
  // build view
  $columnTemplate = new View();
  $columnTemplate->id = $id;
  $columnTemplate->posts = $res;
  $columnTemplate->sums = $sums;
  return $columnTemplate->render('column.php');
}

?>
