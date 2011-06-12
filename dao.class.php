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
  public $users;

  function __construct() {
    $this->initDatabase();
    include('db_config.php');
    $this->users = $users;
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
  
  // check credentials
  public function login($username, $password) {
    if (key_exists($username, $this->users) && $this->users[$username] == $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        if ($username == 'vielieb') $_SESSION['user_id'] = 1;
        elseif ($username == 'sarah') $_SESSION['user_id'] = 2;
        return "eingeloogt...";
    }
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = '';
    return "ungueltiges passwort oder email oder so..";
  }

  public function logout() {
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = '';
    session_destroy();
  }

  // get vals from POST and save
  public function save($post) {
    $user_id = $_SESSION['user_id'];
    $val = $_POST['value'];
    $comment = $_POST['notes'];
    $val = (str_replace(',', '.', $val));
    
    if( !is_numeric($val) )
      return "He du Oasch, des war jetzt aber ka Zahl!";

    $q = sprintf("INSERT INTO money (user_id, value, comment) VALUES (%s, %s, '%s')", $user_id, $val, $comment);
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
  
  public function calcDiff() {
    $names = array(1=>'vielieb', 2=>'sarah');
    $q = "SELECT user_id, sum(value) as sum FROM money GROUP BY user_id";
    $result = mysql_query($q);
    while ($row = mysql_fetch_assoc($result)) {
      $user_id = $row['user_id'];
      $amount = $row['sum'];
      $res[$user_id] = $amount;
    }
    if ($res[1] > $res[2]) {
      $u = $names[1];
      $a = $res[1] - $res[2];
    } elseif ($res[2] > $res[1]) {
      $u = $names[2];
      $a = $res[2] - $res[1];
    } else {
      $u = "Niemand";
      $a = 0;
    }

    $a = sprintf("%.2f", $a);
    $a = str_replace('.', ',', $a);
   
    return array(
      'diffUsername' => $u,
      'diffAmount' => $a
    );
  }

}


?>
