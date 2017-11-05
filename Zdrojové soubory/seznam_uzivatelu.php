<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
  require_once('connect.php');
  require_once('function.php');
?>
<?php include 'hlavicka.php'?>
<?php include 'menu-uvod.php'?>
<?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
    <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Seznam uživatelů</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <div class="col-sm-12">
        <form action="seznam_uzivatelu.php" method="POST" class="form-inline">
          <div class="col-sm-4 text-right">
            <label id="popisek" class="control-label" for="select">Vyberte jakou roli uživatelů chcete vybrat:</label>
          </div>
          <div class="col-sm-3">
            <select class="form-control" name="select" style="width: 100%">
              <option value=""></option>
              <?php
                @$vysledek = $mysqli->query("SELECT * FROM role;");
                while($zaznam = $vysledek->fetch_array()){
                  echo ("<option value=" . $zaznam['nazev'] . ">" . $zaznam['nazev'] . "</option>");
                }
               ?>
            </select>
          </div>
          <div class="col-sm-1 text-right">
            <input type="submit" class="btn btn-default" value="Filtrovat">
          </div>
          <div class="col-sm-3 text-right">
            <a href="registrace_ostatni" class="btn btn-success" title="Přidat nového uživatele"><span class="glyphicon glyphicon-plus"></span> Nový uživatel</a>
          </div>
        </form>
        <br /><br />
        <?php
          if($_POST['select'] == ""){
            @$vysledek = $mysqli->query("SELECT * FROM uzivatel ORDER BY prijmeni, jmeno;");
          }else{
            @$vysledek = $mysqli->query("SELECT * FROM uzivatel NATURAL JOIN opravneni NATURAL JOIN role WHERE nazev = '" . $_POST['select'] . "' ORDER BY prijmeni, jmeno;");
          }
          if(!$vysledek){
            echo("<h5>Aktuálně nejsou k dispozici žádní uživatelé.</h5>");
          } else {
        ?>
        <table class="font table table-striped table-hover">
          <thead>
            <tr>
              <th>Jméno uživatele</th>
              <th>E-mail</th>
              <th>Instituce</th>
              <th>Role uživatele</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              while ($uzivatel = $vysledek->fetch_array()){
                @$vysledek2 = $mysqli->query("SELECT nazev FROM role NATURAL JOIN opravneni NATURAL JOIN uzivatel WHERE id_uzivatele = $uzivatel[id_uzivatele];");
                echo ("<tr><td>" . getCeleJmeno($uzivatel['titul_pred'], $uzivatel['jmeno'], $uzivatel['prijmeni'], $uzivatel['titul_za']) . "</td>");
                echo ("<td>" . $uzivatel['e_mail'] . "</td>");
                echo ("<td>" . $uzivatel['instituce'] . "</td><td>");
                $j = 0;
                while ($role = $vysledek2->fetch_array()){
                  if($j !== 0){
                    echo (", ");
                  }
                  echo ($role['nazev']);
                  $j++;
                }
                echo ("</td><td nowrap><a class='btn btn-warning btn-sm' href='registrace_ostatni.php?id=" . $uzivatel['id_uzivatele'] . "' title='Upravit'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;</td></tr>");
              }
            ?>
          </tbody>
        </table>
      <?php
      }
      ?>
      </div>
    </div>
  </div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:uvod.php");
}
?>
