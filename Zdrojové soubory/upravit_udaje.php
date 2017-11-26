<?php
session_start();
require_once('connect.php');
if(isset($_SESSION['user_is_logged'])){
    @$vysledek = $mysqli->query("SELECT * FROM uzivatel WHERE id_uzivatele = " . $_SESSION['id_uzivatele'] . ";");
    $uzivatel = $vysledek->fetch_array();
    if($uzivatel['e_mail'] !== null){
      $_SESSION['user_titpred'] = $uzivatel['titul_pred'];
      $_SESSION['user_jmeno'] = $uzivatel['jmeno'];
      $_SESSION['user_prijmeni'] = $uzivatel['prijmeni'];
      $_SESSION['user_titza'] = $uzivatel['titul_za'];
      $_SESSION['user_email'] = $uzivatel['e_mail'];
      $_SESSION['user_inst'] = $uzivatel['instituce'];
      $_SESSION['user_blur'] = $uzivatel['instituce_blizsi_urceni'];
  }else{
    header("Location:uvod.php");
  }
?>

<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
      <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Změna základních informací</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <form class="form-horizontal" action="upravit_udaje_dotaz.php" method="POST">
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
        <a href="#" data-toggle="tooltip" title="Např. Katedra technických studií."><span class=" glyphicon glyphicon-question-sign napoveda"></span></a>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" class="btn btn-default" name="Upravit" value="Upravit údaje"></input>
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
