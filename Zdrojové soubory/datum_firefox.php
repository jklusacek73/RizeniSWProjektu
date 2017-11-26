<?php
session_start();
if(isset($_SESSION['user_is_logged'])){
  require_once('connect.php');
  require_once('function.php');
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Zapnutí podpory datumu v prohlížeči Mozilla Firefox</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <div class="col-sm-10">
       Pro správné uložení a následné zobrazení formátu datumu je nutno udělat následující kroky a tím zapnout podporu ve datumu ve vašem prohlížeči. <br />
       Nejdříve je zapotřebí do adresního řádku zadat <b>about:config</b>.  <br /> <br />
       <img src="obrazky/adres_radek.PNG" id="hlavni-menu">     <br /> <br />
       Po zadání této hodnoty do adresního řádku se nám zobrazí seznam voleb. Z tohoto seznamu vybereme tyto tři volby a nastvíme u nich hodnotu na true.<br /><br />
       <img src="obrazky/comenit.png" id="hlavni-menu">                      <br /> <br />
       Po těchto pár jednoduchých krocích by mělo datum ve vašem prohlížeči pracovat tak jak má.
      
    </div>
    </div>
    </div>
  <?php include 'paticka.php'?>


  <?php
}else{
  header("Location:uvod.php");
}
  ?>
