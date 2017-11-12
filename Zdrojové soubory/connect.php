<?php
  $mailFrom = 'klusacek@student.vspj.cz';

  $mysqli = new mysqli("localhost", "", "", "");
  $mysqli->set_charset("utf8");
  if ($mysqli->connect_errno) {
    printf("Připojení selhalo: %s\n", $mysqli->connect_error);
    exit();
  }
?>
