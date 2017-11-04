<?php
session_start();
if(!isset($_SESSION['user_is_logged'])){
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Registrace do informačního systému</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <form class="form-horizontal" action="registrace_dotaz.php" method="POST">
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titpred">Titul před jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Titpred" name="titpred" value="<?php if (isset($_SESSION['titpred'])) : echo $_SESSION['titpred']; unset($_SESSION['titpred']); endif; ?>" >
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="jmeno">Jméno:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Jmeno" name="jmeno" value="<?php if (isset($_SESSION['jmeno'])) : echo $_SESSION['jmeno']; endif; unset($_SESSION['jmeno']); ?>" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="prijmeni">Příjmení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Prijmeni" name="prijmeni" value="<?php if (isset($_SESSION['prijmeni'])) : echo $_SESSION['prijmeni']; unset($_SESSION['prijmeni']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titza">Titul za jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Titza" name="titza" value="<?php if (isset($_SESSION['titza'])) : echo $_SESSION['titza']; unset($_SESSION['titza']); endif; ?>" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="email">Email:</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="Email" name="email" value="<?php if (isset($_SESSION['email'])) : echo $_SESSION['email']; unset($_SESSION['email']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="pswd1">Heslo:</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="Pswd1" name="pswd1" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="pswd2">Opakujte heslo:</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="Pswd2" name="pswd2" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="inst">Instituce:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Inst" name="inst" value="<?php if (isset($_SESSION['inst'])) : echo $_SESSION['inst']; unset($_SESSION['inst']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="blur">Bližší určení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Blur" name="blur" value="<?php if (isset($_SESSION['blur'])) : echo $_SESSION['blur']; unset($_SESSION['blur']); endif; ?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" class="btn btn-default" name="Registrovat" value="Registrovat"></input>
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
