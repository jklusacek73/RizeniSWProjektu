<?php
session_start();

  require_once('connect.php');
  require_once('function.php');
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>

     <?php $sql = "SELECT * FROM casopis_vydany";
   $vysledek = mysqli_query($mysqli, $sql);
   $rocnik = 1;
   ?>


  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Přehled již vydaných časopisů</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <div class="col-sm-12">
        <div class="well well-sm">
          <b>Zde si můžete stáhnout již vydané časopisy.</b>
        </div>
  <table class="font tabulka table table-striped table-hover">
    <thead>
      <tr>
        <th>Časopis</th>
        <th>Témata časopisu</th>
        <th class="text-center">
        <?php if(isset($_SESSION['redaktor'])) {?>
          <a href="casopis_novy_vydany.php" class="btn btn-success">Přidat číslo časopisu</a>
        <?php }?>
        </th>
      </tr>
    </thead>
 <!---------------------------------------------------------------->
    <tbody>
      <?php while( $row = mysqli_fetch_array($vysledek, MYSQLI_ASSOC) ) : ?>
        <?php if ($row['id_casopisu'] % 4 == 1) {?>
           <tr>
             <th colspan="4" class = "info"><?php echo $row['rok'] ?> / <?php echo 'Ročník '.$rocnik; $rocnik++;?> </th>
           </tr>
        <?php } ?>

      <tr>
        <td><?php echo 'Ročník ' . $row['rok'] .' | Číslo '.$row['cislo']; ?></td>
        <td><?php echo $row["temata"]; ?></td>
        <td class="text-center">
          <a href='<?php echo $row["odkaz_k_souboru"];?>' download class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-download-alt'></span> Stáhnout časopis</a>
          <a href='<?php echo $row["odkaz_k_souboru"];?>' class='btn btn-sm btn-primary' target="_blank"><span class='glyphicon glyphicon-search'></span> Otevřít časopis</a>
        </td>
      </tr>



          <?php  endwhile ?>
    </tbody>
  </table>

  </div>
  </div>
</div>
   <?php include 'paticka.php'?>


  <?php

  ?>
