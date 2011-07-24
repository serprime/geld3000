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
        return "1";
    }
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = '';
    return "-1";
  }

  public function logout() {
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = '';
    session_destroy();
  }

  // get vals from POST and save
  public function save($post) {
    $user_id = $_SESSION['user_id'];
    $val = $post['value'];
    $comment = addslashes(htmlentities($post['notes'], ENT_QUOTES, 'utf-8'));
    $val = (str_replace(',', '.', $val));
    
    if( !is_numeric($val) )
      return '-2';

    if(isset($post['both']) && $post['both']=="on") $both = 1;
    else $both = 0;
    
    $q = sprintf("INSERT INTO money (user_id, `both`, value, comment) 
                  VALUES (%s, %s, %s, '%s')", $user_id, $both, $val, $comment);
   
    if (mysql_query($q)) {
        $new_id = mysql_insert_id();
        $fancyStuff = $this->calcDiff();
        $fancyStuff['money_id'] = "".$new_id."";
     return json_encode($fancyStuff);
    } else {
      //return sprintf("uijee, fehler in da query: <pre>%s</pre>", $q);
        echo $q;
        return '-1';
    }
  }
  
  // get posts for a user -- vielieb oba die liebe sarah :D
  public function getPosts($id = null) {
    if ($id == null) die ("he, userid muss ma schon angeben!");
    $q = sprintf("SELECT * FROM money WHERE user_id='%s' ORDER by date desc", $id);
    $result = mysql_query($q);
    $ret = array();
    while ($row = mysql_fetch_assoc($result)) {
      if($row['user_id'] != $_SESSION['user_id']) {
        $row['user_id'] = '';
      }
      $ret[] = $row;
    }
   

    return $ret;
  }

  public function getPost($post_id) {
      $q = sprintf("SELECT * FROM money WHERE money_id = %s", $post_id);
      $result = mysql_query($q);
      $row = mysql_fetch_assoc($result);
      $post_array = array();
      $post_array['value'] = $row['value'];
      $post_array['both'] = $row['both'];
      $post_array['note'] = html_entity_decode($row['comment'], ENT_QUOTES, 'utf-8');
      $post_json = json_encode($post_array);
      
      return $post_json;
  }

  public function editPost($id, $val, $note) {
      $note = addslashes(htmlentities($note, ENT_QUOTES, 'utf-8'));
      $q = sprintf("UPDATE money SET value='%s', comment='%s' WHERE money_id='%s'", $val, $note, $id);

      if(mysql_query($q)) {
          return json_encode($this->calcDiff());
      } else {
          return '-1';
      }
  }

  public function deletePost($id) {
      $q = sprintf("DELETE FROM money WHERE money_id = %s", $id);
      if(mysql_query($q)) {
         return json_encode($this->calcDiff());
      } else {
          return '-1';
      }
  }

  public function calcDiff() {
    $names = array(1=>'vielieb', 2=>'sarah');
    // query for sum of values for both
    $q = "SELECT user_id, sum(`value`/2) as sum FROM money WHERE `both` = true GROUP BY user_id
          UNION SELECT user_id, sum(`value`) as sum FROM money WHERE `both` = false GROUP BY user_id";
    $result = mysql_query($q);
    $res = array(1=>0, 2=>0);
    while ($row = mysql_fetch_assoc($result)) {
      $user_id = $row['user_id'];
      $amount = $row['sum'];
      if (!key_exists($user_id, $res)) $res[$user_id] = 0;
      $res[$user_id] += $amount;
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
