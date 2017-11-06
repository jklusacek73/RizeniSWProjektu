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
    <br />
    <div class="col-sm-12">
      <?php include 'zpravy.php' ?>
    </div>
    <div class="col-sm-12">
      <h3 class="hlavni-nadpis">Čísla časopisu</h3>
      <?php
      $offset = 0;
      $page_result = 10;
      if($_GET['page']) {
        $page_value = $_GET['page'];
        if($page_value > 1) {
          $offset = ($page_value - 1) * $page_result;
        }
      }
      @$vysledek2 = $mysqli->query("SELECT COUNT(id_casopisu) AS 'pocet' FROM casopis");
      $vysledekPocet = $vysledek2->fetch_array();
      $pocetVysledku = $vysledekPocet['pocet'];
      $datum = date('Y-m-d');
      @$vysledek = $mysqli->query("SELECT id_casopisu, rok, cislo, kapacita, uzaverka, temata, titul_pred, jmeno, prijmeni, titul_za FROM uzivatel JOIN casopis ON id_uzivatele = odpovida ORDER BY uzaverka DESC LIMIT $offset, $page_result;");
      if (!$vysledek){
        echo ("<h5>Aktuálně nejsou dispozici žádné čísla časopisu.</h5>");
      }else {
      ?>
      <div class="col-sm-12 text-right">
        <a href="casopis_novy.php" class="btn btn-success">Vytvořit nové číslo časopisu</a>
      </div>
      <table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Číslo</th>
            <th>Zb. kapacita článků</th>
            <th>Uzávěrka</th>
            <th>Témata</th>
            <th>Editor</th>
            <th></th>
          </tr>
       </thead>
      <tbody>
      <?php
        while ($casopis = $vysledek->fetch_array()){
          @$vysledek2 = $mysqli->query("SELECT COUNT(casopis) AS 'pocet' FROM clanek WHERE casopis = " . $casopis['id_casopisu'] . ";");
          $clanky = $vysledek2->fetch_array();
          echo('<tr><td>'. $casopis['rok'] . '/' . $casopis['cislo'] .'</td>');
          $zbyvajiciClanky = $casopis['kapacita'] - $clanky['pocet'];
          echo('<td>'. $zbyvajiciClanky .'</td>');
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($casopis['uzaverka'])) .'</td>');
          echo('<td>'. $casopis['temata'] .'</td>');
          echo('<td>'. getCeleJmeno($casopis['titul_pred'], $casopis['jmeno'], $casopis['prijmeni'], $casopis['titul_za']) .'</td><td>');
          if(isset($_SESSION['redaktor']) && $casopis['uzaverka'] >= $datum){
            echo "<a href='casopis_novy.php?id=$casopis[id_casopisu]' class='btn btn-warning btn-sm' title='Upravit časopis'><span class='glyphicon glyphicon-pencil'><span></a>";
          }
          echo('</td></tr>');
        }
      ?>
    </tbody>
      </table>
    <?php
    $num =  $pocetVysledku / $page_result ;
    if($num > 1){
        echo '<div class="col-sm-12" id="pagination"><ul class="pagination">';
        if($_GET['page'] > 1){
          echo "<li><a  href = 'casopis_prehled.php?page=".($_GET['page'] - 1)."'> Předchozí </a></li>";
        }else{
          echo "<li class='disabled'><a href = '#'> Předchozí </a></li>";
        }
        if(($num > 1) && ($_GET['page'] < $num)) {
          echo "<li><a href = 'casopis_prehled.php?page=".($_GET['page'] + 1)."'> Další </a></li>";
        }else{
          echo "<li class='disabled'><a href = '#'> Další </a></li>";
        }
        echo '</ul></div>';
      }
    }
    ?>
    </div>
  </div>
</div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:index.php");
}
?>
