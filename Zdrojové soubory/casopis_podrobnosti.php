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

      <?php include 'zpravy.php'?>


<table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Číslo</th>
            <th>Zb. kapacita článků</th>
            <th>Uzávěrka</th>
            <th>Témata</th>
            <th>Editor</th>
          </tr>
       </thead>
      <tbody>
      <?php
      @$vysledek = $mysqli->query("SELECT id_casopisu, rok, cislo, kapacita, uzaverka, odpovida, temata, titul_pred, jmeno, prijmeni, titul_za FROM uzivatel JOIN casopis ON id_uzivatele = odpovida WHERE id_casopisu = $_GET[id];");
        $casopis = $vysledek->fetch_array();
          @$vysledek2 = $mysqli->query("SELECT COUNT(casopis) AS 'pocet' FROM clanek WHERE casopis = " . $casopis['id_casopisu'] . ";");
          $clanky = $vysledek2->fetch_array();
          echo('<tr><td>' . $casopis['rok'] . '/' . $casopis['cislo'] .'</td>');
          $zbyvajiciClanky = $casopis['kapacita'] - $clanky['pocet'];
          echo('<td>'. $zbyvajiciClanky .'</td>');
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($casopis['uzaverka'])) .'</td>');
          echo('<td>'. $casopis['temata'] .'</td>');
          echo('<td>'. getCeleJmeno($casopis['titul_pred'], $casopis['jmeno'], $casopis['prijmeni'], $casopis['titul_za']) .'</td><td class="text-center"></tr>');

      $datum = time('Y-m-d');
      ?>
    </tbody>
      </table>
      <?php if (($zbyvajiciClanky > 0) && (strtotime($casopis['uzaverka']) >= $datum) && ($_SESSION['autor'])) {
       echo "<div class='col-sm-12 text-right'><a href='nahrat_clanek.php?id=$zaznam[id_casopisu]&rok=$zaznam[rok]&cislo=$zaznam[cislo]' class='btn btn-success btn-md'>Nahrát článek</a></div>";
     } ?>
      <h4>Nahrané články v tomto čísle časopisu</h4>

      <table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Název článku</th>
            <th>Datum vložení</th>
            <th>Stav</th>
            <!--<th>Datum recenzního řízení</th> -->
            <th>Odpovědný uživatel</th>
            <th></th>
          </tr>
       </thead>
      <tbody>
      <?php @$vysledek2 = $mysqli->query("SELECT id_clanku, nazev_clanku, datum_vlozeni, stav, datum_recenzniho_rizeni, odpovedny_uzivatel, titul_pred, jmeno, prijmeni, titul_za FROM uzivatel JOIN clanek ON id_uzivatele = odpovedny_uzivatel WHERE casopis = $_GET[id];");
      if (!$vysledek2){
        echo ("<h5>Aktuálně nejsou k dispozici žádné članky u tohoto čísla.</h5>");
      }else {

        while ($clanek = $vysledek2->fetch_array()){
          echo("<tr><td><a href='clanek_podrobnosti.php?id=$clanek[id_clanku]' title='Podrobnosti o článku'>" . $clanek['nazev_clanku'] ."</td>");
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($clanek['datum_vlozeni'])) .'</td>');
          echo('<td>'. $clanek['stav'] .'</td>');
          //echo('<td>'. strftime("%e.%m. %Y" ,strtotime($clanek['datum_recenzniho_rizeni'])) .'</td>');
          echo('<td>'. getCeleJmeno($clanek['titul_pred'], $clanek['jmeno'], $clanek['prijmeni'], $clanek['titul_za']) .'</td><td class="text-center">');
          if(isset($_SESSION['editor']) && ($zaznam['odpovida'] == $_SESSION['id_uzivatele']) && ($clanek['stav'] !== "Článek bude vydán")){
            echo "<a href='clanek_smazat.php?id=$clanek[id_clanku]' class='btn btn-danger btn-sm' title='Smazat článek'><span class='glyphicon glyphicon-remove'></span></a>&nbsp;";
          }
          echo "<a href='clanek_podrobnosti.php?id=$clanek[id_clanku]' class='btn btn-primary btn-sm' title='Podrobnosti o článku'><span class='glyphicon glyphicon-menu-right'></span></a>";
          echo('</td></tr>');
        }
      }
      ?>
    </tbody>
      </table>
 </div>
 </div>
</div>
</div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:index.php");
}
?>
