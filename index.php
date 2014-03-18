<?php
session_start();
if(isset($_SESSION['user'])){$user=$_SESSION['user'];} else {$user=NULL;}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>65536D</title>

  <link href="main.css" rel="stylesheet" type="text/css">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no">

  <meta property="og:title" content="2048 game"/>
  <meta property="og:site_name" content="2048 game"/>
  <meta property="og:description" content="Join the numbers and get to the 2048 tile! Careful: this game is extremely addictive!"/>
</head>

<body>
  <div id="debug">
    <form onsubmit="javascript:return debug();">
      <input type="submit" value="○">
    </form>
    <pre id="debugpre"></pre>
  </div>
  <pre id="scoreboard"></pre>
  <div class="container">
    <div class="heading">
      <!--<h1 class="title">65536D</h1>-->
      <div class="scores-container">
        <div class="score-container">0</div>
        <div class="best-container">0</div>
        <div class="server-best-container" id="sbc"
          onclick="javascript:get_scores()">
          <div>
            <span id='serverscore'>-</span>
            <span id='serveruser'>-</span>
          </div>
        </div>
        <div class="stop_replay" id="stop_replay_div" onclick="javascript:stop_replay();">
        <span id="stop_replay">stop</span>
        </div>
      </div>

    </div>
    <!--<p class="game-intro">Join the numbers and get to the <strong>65536 tile!</strong></p>-->
    <p>
      Your username:
      <a href="#" onclick="javascript:set_user()">
      <span id="user">
        <?php
          if($user!=NULL) {
            echo $user;
          } else { ?>
            set it up! You'll keep your game.
          <?php }
        ?>
        </span>
      </a>
    </p>

    <div class="game-container">
      <div class="game-message">
        <p></p>
        <div class="lower">
          <a class="retry-button">Try again</a>

          <div class="score-sharing"></div>
        </div>
      </div>

      <div class="grid-container">
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>

          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">

          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>

          <div class="grid-cell"></div>
        </div>
      </div>

      <div class="tile-container">

      </div>
    </div>
<!--
    <p class="game-explanation">

      <strong class="important">How to play:</strong> Use your <strong>arrow keys</strong> to move the tiles. When two tiles with the same number touch, they <strong>merge into one!</strong>
    </p>
    <hr>
    <p>
    Created by <a href="http://gabrielecirulli.com" target="_blank">Gabriele Cirulli.</a> Based on <a href="https://itunes.apple.com/us/app/1024!/id823499224" target="_blank">1024 by Veewo Studio</a> and conceptually similar to <a href="http://asherv.com/threes/" target="_blank">Threes by Asher Vollmer.</a>

    </p>
  </div>
-->
  <script src="script.js"></script>

</body>
</html>
