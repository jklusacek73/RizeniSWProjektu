<?php
session_start();
if(isset($_SESSION['user_is_logged'])){
  require_once('connect.php');
  require_once('function.php');
  if(isset($_GET['id'])){
    @$vysledek = $mysqli->query("SELECT * FROM clanek JOIN uzivatel ON odpovedny_uzivatel = id_uzivatele WHERE id_clanku = $_GET[id]");
    if($vysledek){
      $zaznam = $vysledek->fetch_array();
      @$vysledek2 = $mysqli->query("SELECT * FROM uzivatel JOIN casopis ON id_uzivatele = odpovida WHERE id_casopisu = $zaznam[casopis]");
      $zaznam2 = $vysledek2->fetch_array();
    }else {
      header("Location:uvod.php");
      exit;
    }
  } else {
    header("Location:uvod.php");
    exit;
  }
if(($_SESSION['redaktor'] == true) || ($_SESSION['id_uzivatele'] == $zaznam['id_uzivatele']) || ($_SESSION['id_uzivatele'] == $zaznam2['id_uzivatele'])) {
?>
<?php include 'hlavicka.php'?>
  <?php include 'menu-uvod.php'?>
<?php include 'hlavni-foto.php'?>
<div class="row" id="hlavni">
  <div class="col-sm-offset-1 col-sm-10 col-xs-12">
    <div class="col-sm-12">
      <h3 class="hlavni-nadpis">Podrobnosti o článku</h3>
      <?php include 'zpravy.php' ?>
      <div class="col-sm-12">
      <table class="font table table-striped table-hover">
        <tbody>
          <tr>
            <th>Název článku:<th>
            <td  colspan="2"><b><?php echo $zaznam['nazev_clanku'] ?></b> &nbsp; <?php echo "<a href='" . $zaznam['nazev_souboru'] . "' download class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-download-alt'></span> Stáhnout článek</a>&nbsp;&nbsp;<a href='" . $zaznam['nazev_souboru'] . "' target='_blank' class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-search'></span> Otevřít článek</a>" ?></td>
          </tr>
          <tr>
            <th>Autor - odpovědný uživatel:<th>
            <td colspan="2"><?php echo "<a href='mailto:$zaznam[e_mail]' title='Kontakt na odpovědnou osobu'>" . getCeleJmeno($zaznam['titul_pred'], $zaznam['jmeno'], $zaznam['prijmeni'], $zaznam['titul_za'])  . "</a>" . " ($zaznam[instituce]";
            if(($zaznam['instituce_blizsi_urceni'] !== null) && ($zaznam['instituce_blizsi_urceni'] !== "")){
              echo " - " . $zaznam['instituce_blizsi_urceni'];
            }
            echo ") </td>" ?>
          </tr>
          <?php
            @$vysledek =  $mysqli->query("SELECT * FROM autori WHERE id_clanku = $zaznam[id_clanku];");
            while ($autori = $vysledek->fetch_array()){
            echo "<tr><th>Autor:<th>";
          ?>
            <td><?php echo getCeleJmeno($autori['titul_pred'], $autori['jmeno'], $autori['prijmeni'], $autori['titul_za']) . " ($autori[instituce]";
            if(($autori['instituce_blizsi_urceni'] !== null) && ($autori['instituce_blizsi_urceni'] !== "")){
              echo " - " . $autori['instituce_blizsi_urceni'];
            }
            echo ") </td>" ?>
            <?php if(($_SESSION['id_uzivatele'] == $zaznam['id_uzivatele']) && ((strtotime($zaznam['datum_recenzniho_rizeni']) > strtotime(date('Y-m-d'))) || ($zaznam['datum_recenzniho_rizeni'] == null) || ($zaznam['datum_recenzniho_rizeni'] == ""))) { ?>
            <td><a href="<?php echo "clanek_autori.php?autor=" . $autori['id_autora'] ?>" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
            <a href="<?php echo "autori_smazat_dotaz.php?id=" . $autori['id_autora'] ?>" class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-remove"></span></a></td>
          <?php } ?>
          <?php
          echo "</tr>";
          }
          ?>
          <tr>
            <th>Časopis:<th>
            <td colspan="2"><?php echo $zaznam2['rok'] . "/" . $zaznam2['cislo'] . " - " . $zaznam2['temata'] ?> </td>
          </tr>
          <tr>
            <th>Datum vložení článku:<th>
            <td  colspan="2"> <?php echo strftime("%e.%m. %Y" ,strtotime($zaznam['datum_vlozeni'])) ?> </td>
          </tr>
          <tr>
            <th>Stav:<th>
            <td colspan="2"><b><?php echo $zaznam['stav'] ?></b></td>
          </tr>
          <?php if(($zaznam['datum_recenzniho_rizeni'] !== null) &&  ($zaznam['datum_recenzniho_rizeni'] !== ""))  { ?>
          <tr>
            <th>Datum zahájení recenzního řízení:<th>
            <td colspan="2"><?php echo strftime("%e.%m. %Y" ,strtotime($zaznam['datum_recenzniho_rizeni'])) ?> </td>
          </tr>
        <?php } ?>
        <?php if($zaznam['datum_aktualizace'] !== null) { ?>
        <tr>
          <th>Datum aktualizace článku:<th>
          <td colspan="2"><?php echo strftime("%e.%m. %Y" ,strtotime($zaznam['datum_aktualizace'])) ?> </td>
        </tr>
      <?php } ?>
      <?php
      $cislo == 0;
      @$vysledek = $mysqli->query("SELECT * FROM recenze NATURAL JOIN uzivatel WHERE id_clanku = $zaznam[id_clanku];");
      while ($recenze = $vysledek->fetch_array()) {
        $cislo++;
        ?>
        <tr>
          <th><?php echo $cislo . ". recenze" ?><th>
          <td colspan="2"><?php echo  "<a href='mailto:$recenze[e_mail]' title='Kontakt na recenzenta'>" . getCeleJmeno($recenze['titul_pred'], $recenze['jmeno'], $recenze['prijmeni'], $recenze['titul_za']) . "</a>" . " ($recenze[instituce]";
          if(($recenze['instituce_blizsi_urceni'] !== null) && ($recenze['instituce_blizsi_urceni'] !== "")){
            echo " - " . $recenze['instituce_blizsi_urceni'];
          }
          echo ")<br />";
          echo "Datum nahrání recenze: " . strftime("%e.%m. %Y" ,strtotime($recenze['datum'])) . " &nbsp;&nbsp;<a href='" . $recenze['nazev_souboru'] . "' download class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-download-alt'></span> Stáhnout recenzi</a>&nbsp;&nbsp;<a href='" . $recenze['nazev_souboru'] . "' target='_blank' class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-search'></span> Otevřít recenzi</a>"; ?>
        </tr>
      <?php } ?>
        </tbody>
      </table>
      <div class="col-sm-12">
        <?php if($_SESSION['id_uzivatele'] == $zaznam['id_uzivatele'] && ((strtotime($zaznam['datum_recenzniho_rizeni']) > strtotime(date('Y-m-d'))) || ($zaznam['datum_recenzniho_rizeni'] == null) || ($zaznam['datum_recenzniho_rizeni'] == ""))) { ?>
          &nbsp;<a href="<?php echo "clanek_autori.php?id=" . $zaznam['id_clanku'] ?>" class="btn btn-success">Přidat dalšího autora článku</a>
        <?php } ?>
        <?php if(($_SESSION['id_uzivatele'] == $zaznam2['id_uzivatele'] && ((strtotime($zaznam['datum_recenzniho_rizeni']) > strtotime(date('Y-m-d'))) || ($zaznam['datum_recenzniho_rizeni'] == null) || ($zaznam['datum_recenzniho_rizeni'] == ""))) || $cislo == 2) { ?>
          &nbsp;<a href="<?php echo "clanek_smazat.php?id=" . $zaznam['id_clanku'] ?>" class="btn btn-danger">Smazat článek</a>
        <?php } ?>
        <?php if($_SESSION['recenzent'] && ((strtotime($zaznam['datum_recenzniho_rizeni']) < strtotime(date('Y-m-d')))) && ($cislo < 2) && (($zaznam['datum_recenzniho_rizeni'] !== null) || ($zaznam['datum_recenzniho_rizeni'] !== ""))) { ?>
          &nbsp;<a href="<?php echo "recenze_nahrat.php?id=" . $zaznam['id_clanku'] ?>" class="btn btn-primary">Nahrát recenzi</a>
        <?php } ?>
        <?php if(($_SESSION['id_uzivatele'] == $zaznam['id_uzivatele']) && ($cislo == 2)) { ?>
          &nbsp;<a href="<?php echo "clanek_aktualizovat.php?id=" . $zaznam['id_clanku'] ?>" class="btn btn-success">Aktualizovat článek</a>
        <?php } ?>
        <?php if(($_SESSION['id_uzivatele'] == $zaznam2['id_uzivatele']) && ($cislo == 2)) { ?>
          &nbsp;<a href="<?php echo "clanek_vydat.php?id=" . $zaznam['id_clanku'] ?>" class="btn btn-success">Poslat článek k vydání</a>
        <?php } ?>
        <?php if($_SESSION['id_uzivatele'] == $zaznam2['id_uzivatele']) { ?>
          <br /><br /><form class="form-inline" method="post" action="datum_recenzniho_rizeni.php">
            <div class="form-group">
              <label for="email"><?php if(($zaznam['datum_recenzniho_rizeni'] == null) || ($zaznam['datum_recenzniho_rizeni'] == "")) : echo "Vložit "; else: echo "Upravit "; endif ?>datum zahájení recenzního řízení:</label>
                <input type="date" class="form-control" id="datum" name="datum" required/>
              </div>
              <input type="hidden" name="clanek" value="<?php echo $zaznam['id_clanku'] ?>" />
              <input type="submit" class="btn btn-default" name="Odeslat" value="Odeslat" />
          </form>
        <?php } ?>
      </div>
    </div>
    </div>
  </div>
</div>
<?php include 'paticka.php'?>
<?php
  }else{
    header("Location:index.php");
  }
} else{
  header("Location:index.php");
}
?>
