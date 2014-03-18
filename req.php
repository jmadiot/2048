<?php
session_start();
$filename="leaderboard";

/* which command is it? */
if(!isset($_GET['command'])) {die("no command specified, aborting."); }
$command = $_GET['command'];

/* debug */
if($command == 'debug') {
  die(phpversion());
}

/* set user name in SESSION */
if($command == 'setuser') {
  if(isset($_POST['user'])) {
    $_SESSION['user'] = trim(trim($_POST['user']), ':');
    $user = $_SESSION['user'];
    die("ok, user changed to '$user'");
  } else {
    die("error, username unreadable");
  }
}

/* read score file */
if($command == 'get_highscore' || $command == 'get_scores') {
  $f=fopen($filename, "r") or die("failed to open file for reading");
  $board=array();
  while ($line = fgets($f)) {
    $line=rtrim($line);
    $v = explode(':', $line);
    $score = $v[0];
    $user = $v[1]; if(!$user) $user="anon";
    $moves = $v[2]; if(!$moves) $moves="";
    //$score = preg_replace('/^([^:]*):\s*.*$/', '\1', $line);
    //$remaining = preg_replace('/^[^:]*:\s*/', '', $line);
    //$user = preg_replace('/^([^:]*):\s*.*$/', '\1', $remaining);
    //$moves = preg_replace('/^[^:]*:\s*/', '', $remaining);
    $board[]=array($score,$user,$moves);
  }
  $users=array();
  fclose($f);
  rsort($board);
  $first=json_encode(array('user'=>$board[0][1], 'score'=>$board[0][0], 'moves'=>$board[0][2]));
  if($command == 'get_highscore') echo $first;
  if($command == 'get_scores') {
    foreach($board as $b) {
      $user = $b[1];
      $score = $b[0];
      if(!in_array($user, $users)) {
        $users[] = $user;
        echo "<a href='#' onclick=\"javascript:replay('$b[2]');\">$b[1] : $b[0]</a>\n";
      }
    }
  };
}

/* writing score */
if($command == 'send_score' && isset($_POST['score'])) {
  $score = 1 * $_POST['score'];
  $user  = $_SESSION['user'];
  $moves  = $_POST['moves'];
  $f = fopen($filename, "a") or die("failed to open file for writing");
  fwrite($f, "$score:$user:$moves\n");
  fclose($f);
  var_dump($_POST);
  die("added score $score for $user with moves $moves");
}

?>
