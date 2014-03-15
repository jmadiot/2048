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
    $_SESSION['user'] = $_POST['user'];
    $user = $_SESSION['user'];
    answer("ok, user changed to '$user'");
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
    $user = preg_replace('/^[^:]*:\s*/', '', $line);
    $score = preg_replace('/^([^:]*):\s*.*$/', '\1', $line);
    $board[]=array($score,$user);
  }
  $users=array();
  fclose($f);
  rsort($board);
  $first=json_encode(array('user'=>$board[0][1], 'score'=>$board[0][0]));
  if($command == 'get_highscore') echo $first;
  if($command == 'get_scores') {
    foreach($board as $b) {
      $user = $b[1];
      $score = $b[0];
      if(!in_array($user, $users)) {
        $users[] = $user;
        echo "$b[1] : $b[0]\n";
      }
    }
  };
}

/* writing score */
if($command == 'send_score' && isset($_POST['score'])) {
  $score = 1 * $_POST['score'];
  $user  = $_SESSION['user'];
  $f = fopen($filename, "a") or die("failed to open file for writing");
  fwrite($f, "$score:$user\n");
  fclose($f);
}

?>
