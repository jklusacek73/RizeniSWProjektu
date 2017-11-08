<?php
session_start();
if(isset($_SESSION['user_is_logged'])){
  require_once('connect.php');
  require_once('function.php');
  if(isset($_GET['id'])){
    @$vysledek = $mysqli->query("SELECT * FROM casopis WHERE id_casopisu = $_GET[id];");
    $zaznam = $vysledek->fetch_array();
    if($zaznam['id_casopisu'] == null){
      header("Location:casopis_prehled.php");
    }
  }
?>
<?php include 'hlavicka.php'?>
  <?php include 'menu-uvod.php'?>
<?php include 'hlavni-foto.php'?>
<div class="row" id="hlavni">
  <div class="col-sm-offset-1 col-sm-10 col-xs-12">
    <div class="col-sm-12">
      <div class="col-sm-12">
          <h3 class="hlavni-nadpis">Podrobnosti o časopise <?php echo "$zaznam[rok]/$zaznam[cislo]" ?></h3>
      </div>
      <?php include 'zpravy.php' ?>
      <?php echo "<a href='nahrat_clanek.php?id=$zaznam[id_casopisu]&rok=$zaznam[rok]&cislo=$zaznam[cislo]'>Nahrát článek</a>" ?>
  </div>
</div>
</div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:index.php");
}
?>
