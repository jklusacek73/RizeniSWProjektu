<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'])){
require_once('connect.php');
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <?php include 'function.php'?>

  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
          <h3 class="hlavni-nadpis">Přidat nové číslo časopisu</h3>
      </div>
      <?php include 'zpravy.php' ?>

      <form class="form-horizontal" action="casopis_novy_vydany_dotaz.php" method="POST" enctype="multipart/form-data">
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4" for="rok">Rok:</label>
        <div class="col-sm-6">
          <input type="number" min="2000"  max="2050" class="form-control" id="Rok" name="rok" value="<?php if (isset($_SESSION['rok'])) : echo $_SESSION['rok']; unset($_SESSION['rok']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="cislo">Číslo:</label>
        <div class="col-sm-6">
          <input type="number" min="1" max="4" class="form-control" id="Cislo" name="cislo"  value="<?php if (isset($_SESSION['cislo'])) : echo $_SESSION['cislo']; unset($_SESSION['cislo']); endif; ?>"required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="temata">Témata:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Temata" name="temata" value="<?php if (isset($_SESSION['temata'])) : echo $_SESSION['temata']; unset($_SESSION['temata']); endif; ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="fileToUpload">Soubor:</label>
        <div class="col-sm-6">
         <input type="file" name="fileToUpload" id="fileToUpload" required> (podporovaný formát: <b>pdf pouze do 2MB</b>)
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <input type="submit" class="btn btn-default" name="Pridat" value="Přidat časopis">
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
