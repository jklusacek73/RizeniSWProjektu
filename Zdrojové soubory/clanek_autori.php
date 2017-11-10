<?php
session_start();
if(isset($_SESSION['user_is_logged']) && ($_SESSION['autor'] == true)){
  require_once('connect.php');
  if(isset($_GET['id'])){
    @$vysledek = $mysqli->query("SELECT * FROM clanek WHERE id_clanku = $_GET[id]");
    $zaznam = $vysledek->fetch_array();
    if($zaznam['id_clanku'] == null){
      header("Location:casopis_prehled.php");
    }
  }
  if(isset($_GET['autor'])){
    @$vysledek = $mysqli->query("SELECT * FROM autori WHERE id_autora = $_GET[autor]");
    $zaznam2 = $vysledek->fetch_array();
    if ($zaznam2['id_autora'] !== null){
      $_SESSION['autor_titpred'] = $zaznam2['titul_pred'];
      $_SESSION['autor_jmeno'] = $zaznam2['jmeno'];
      $_SESSION['autor_prijmeni'] = $zaznam2['prijmeni'];
      $_SESSION['autor_titza'] = $zaznam2['titul_za'];
      $_SESSION['autor_inst'] = $zaznam2['instituce'];
      $_SESSION['autor_blur'] = $zaznam2['instituce_blizsi_urceni'];
    }else{
      header("Location:clanek_podrobnosti.php?id=$zaznam[id_clanku]");
    }
  }
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <?php if(isset($_GET['autor'])){ ?>
          <h3 class="hlavni-nadpis">Zde můžete upravit autora článku</h3>
        <?php } else { ?>
          <h3 class="hlavni-nadpis">Zde můžete přidat další autory článku</h3>
        <?php } ?>
      </div>
      <?php include 'zpravy.php' ?>
      <?php if(isset($_GET['autor'])){ ?>
        <form class="form-horizontal" action="autori_upravit_dotaz.php" method="POST">
          <input type="hidden" name="id_autora" value="<?php echo $_GET['autor'] ?>" />
      <?php } else { ?>
        <form class="form-horizontal" action="autori_pridat_dotaz.php" method="POST">
          <input type="hidden" name="id_casopisu" value="<?php echo $_GET['id']?>">
      <?php } ?>
      <div class="col-sm-offset-2 col-sm-8">
      <?php if(!isset($_GET['autor'])){
        echo ("<div class='col-sm-offset-4 col-sm-6'>");
        echo ("<a href='clanek_podrobnosti.php?id=$zaznam[id_clanku]' class='btn btn-success'>Přeskočit tento krok</a>");
        echo ("<br /><br /></div>");
       } ?>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titpred">Titul před jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Titpred" name="titpred" value="<?php if (isset($_SESSION['autor_titpred'])) : echo $_SESSION['autor_titpred']; unset($_SESSION['autor_titpred']); endif; ?>" >
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="jmeno">Jméno:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Jmeno" name="jmeno" value="<?php if (isset($_SESSION['autor_jmeno'])) : echo $_SESSION['autor_jmeno']; endif; unset($_SESSION['autor_jmeno']); ?>" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="prijmeni">Příjmení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Prijmeni" name="prijmeni" value="<?php if (isset($_SESSION['autor_prijmeni'])) : echo $_SESSION['autor_prijmeni']; unset($_SESSION['autor_prijmeni']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titza">Titul za jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Titza" name="titza" value="<?php if (isset($_SESSION['autor_titza'])) : echo $_SESSION['autor_titza']; unset($_SESSION['autor_titza']); endif; ?>" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="inst">Instituce:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Inst" name="inst" value="<?php if (isset($_SESSION['autor_inst'])) : echo $_SESSION['autor_inst']; unset($_SESSION['autor_inst']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="blur">Bližší určení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Blur" name="blur" value="<?php if (isset($_SESSION['autor_blur'])) : echo $_SESSION['autor_blur']; unset($_SESSION['autor_blur']); endif; ?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <?php if(isset($_GET['autor'])){ ?>
            <input type="submit" class="btn btn-default" name="Upravit" value="Upravit tohoto autora"></input>
          <?php } else { ?>
            <input type="submit" class="btn btn-default" name="Pridat" value="Přidat autora článku"></input>
          <?php } ?>
        </div>
      </div>
      </div>
      </form>
    </div>
    </div>
  <?php include 'paticka.php'?>
  <?php
}else{
  header("Location:uvod.php");
}
  ?>
