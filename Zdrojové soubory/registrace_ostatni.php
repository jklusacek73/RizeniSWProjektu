<?php
session_start();
require_once('connect.php');
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
  if(isset($_GET['id'])){
    @$vysledek = $mysqli->query("SELECT * FROM uzivatel WHERE id_uzivatele = " . $_GET['id'] . ";");
    $uzivatel = $vysledek->fetch_array();
    if($uzivatel['e_mail'] !== null){
      $_SESSION['user_titpred'] = $uzivatel['titul_pred'];
      $_SESSION['user_jmeno'] = $uzivatel['jmeno'];
      $_SESSION['user_prijmeni'] = $uzivatel['prijmeni'];
      $_SESSION['user_titza'] = $uzivatel['titul_za'];
      $_SESSION['user_email'] = $uzivatel['e_mail'];
      $_SESSION['user_inst'] = $uzivatel['instituce'];
      $_SESSION['user_blur'] = $uzivatel['instituce_blizsi_urceni'];
      @$vysledek2 = $mysqli->query("SELECT id_role, nazev FROM role NATURAL JOIN opravneni WHERE id_uzivatele = " . $_GET['id'] . " ORDER BY id_role;");
      while ($role = $vysledek2->fetch_array()) {
          switch($role['id_role']){
            case 1:
              $_SESSION['user_autor'] = true;
              break;
            case 2:
              $_SESSION['user_redaktor'] = true;
              break;
            case 3:
              $_SESSION['user_recenzent'] = true;
              break;
            case 4:
              $_SESSION['user_editor'] = true;
              break;
          }
      }
    }else{
      header("Location:uvod.php");
    }
  }
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Registrace členů redakce do informačního systému</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <?php if(isset($_GET['id'])) {?>
        <form class="form-horizontal" action="upravit_uzivatel_dotaz.php" method="POST">
      <?php } else {?>
        <form class="form-horizontal" action="novy_uzivatel_dotaz.php" method="POST">
      <?php } ?>
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titpred">Titul před jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Titpred" name="titpred" value="<?php if (isset($_SESSION['user_titpred'])) : echo $_SESSION['user_titpred']; unset($_SESSION['user_titpred']); endif; ?>" >
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="jmeno">Jméno:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Jmeno" name="jmeno" value="<?php if (isset($_SESSION['user_jmeno'])) : echo $_SESSION['user_jmeno']; endif; unset($_SESSION['user_jmeno']); ?>" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="prijmeni">Příjmení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Prijmeni" name="prijmeni" value="<?php if (isset($_SESSION['user_prijmeni'])) : echo $_SESSION['user_prijmeni']; unset($_SESSION['user_prijmeni']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titza">Titul za jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Titza" name="titza" value="<?php if (isset($_SESSION['user_titza'])) : echo $_SESSION['user_titza']; unset($_SESSION['user_titza']); endif; ?>" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="email">Email:</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="Email" name="email" value="<?php if (isset($_SESSION['user_email'])) : echo $_SESSION['user_email']; unset($_SESSION['user_email']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="inst">Instituce:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Inst" name="inst" value="<?php if (isset($_SESSION['user_inst'])) : echo $_SESSION['user_inst']; unset($_SESSION['user_inst']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="blur">Bližší určení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Blur" name="blur" value="<?php if (isset($_SESSION['user_blur'])) : echo $_SESSION['user_blur']; unset($_SESSION['user_blur']); endif; ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4">Role uživatele:</label>
        <div class="col-sm-6">
          <label class="checkbox-inline"><input type="checkbox" value="true" name="autor" <?php if (isset($_SESSION['user_autor'])) : echo "checked"; unset($_SESSION['user_autor']); endif; ?>>Autor</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label class="checkbox-inline"><input type="checkbox" value="true" name="recenzent" <?php if (isset($_SESSION['user_recenzent'])) : echo "checked"; unset($_SESSION['user_recenzent']); endif; ?>>Recenzent</label><br />
          <label class="checkbox-inline"><input type="checkbox" value="true" name="editor" <?php if (isset($_SESSION['user_editor'])) : echo "checked"; unset($_SESSION['user_editor']); endif; ?>>Editor</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label class="checkbox-inline"><input type="checkbox" value="true" name="redaktor" <?php if (isset($_SESSION['user_redaktor'])) : echo "checked"; unset($_SESSION['user_redaktor']); endif; ?>>Redaktor</label>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <?php if(isset($_GET['id'])) {?>
            <input type="submit" class="btn btn-default" name="Upravit" value="Upravit"></input>
          <?php } else { ?>
            <input type="submit" class="btn btn-default" name="Přidat" value="Přidat"></input>
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
  header("Location:index.php");
}
  ?>
