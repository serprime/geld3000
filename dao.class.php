<?php

/*
  dao - data access object
  
  - zum öffnen der db-verbindung
  - zum holen und schreiben der daten in die datenbank
*/

class Dao {

  // constants
  public $vielieb = 1;
  public $sarah = 2;
  public $con;

  function __construct() {
    $this->initDatabase();
  }

  // open db connection and select db
  public function initDatabase() {
    include('db_config.php');
    $this->con = mysql_connect($DatabaseHost, $DatabaseUser, $DatabasePassword);
    if (!$this->con) {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($Database) or die(mysql_error());
  }
  
  
  // get vals from POST and save
  public function save($post) {
    $user = ($_POST['vielieb']) ? $this->vielieb : $this->sarah;
    $val = ($_POST['vielieb']) ? $_POST['vielieb'] : $_POST['sarah'];
    $comment = ($_POST['v_text']) ? $_POST['v_text'] : $_POST['s_text'];
    $val = (str_replace(',', '.', $val));
    
    if( !is_numeric($val) )
      return "He du Oasch, des war jetzt aber ka Zahl!";

    $q = sprintf("INSERT INTO money (user_id, value, comment) VALUES (%s, %s, '%s')", $user, $val, $comment);
    if (mysql_query($q)) {
      return "ok, eintrag sollte in der db sein.";
    } else {
      return sprintf("uijee, fehler in da query: <pre>%s</pre>", $q);
    }
  }
  
  // get posts for a user -- vielieb oba die liebe sarah :D
  public function getPosts($id = null) {
    if ($id == null) die ("he, userid muss ma schon angeben!");
    $q = sprintf("SELECT * FROM money WHERE user_id='%s' ORDER by date desc", $id);
    $result = mysql_query($q);
    $ret = array();
    while ($row = mysql_fetch_assoc($result)) {
      $ret[] = $row;
    }
    return $ret;
  }

}


?>
