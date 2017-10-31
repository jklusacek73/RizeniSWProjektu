<?php
session_start();
if($_SESSION['user_is_logged']){
?>
<?php include 'hlavicka.php'?>
  <?php include 'menu-uvod.php'?>
<?php include 'hlavni-foto.php'?>
<div class="row" id="hlavni">
  <?php
  echo '<pre>';
  var_dump($_SESSION);
  echo '</pre>';
   ?>
</div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:index.php");
}
?>
