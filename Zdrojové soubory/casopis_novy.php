<?php
session_start();
if(isset($_SESSION['user_is_logged'])){
require_once('connect.php');
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <?php include 'function.php'?>
  
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Vytvoření nového čísla časopisu</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <form class="form-horizontal" action="casopis_novy_dotaz.php" method="POST">
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4" for="rok">Rok:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Rok" name="rok" value="<?php if (isset($_SESSION['rok'])) : echo $_SESSION['rok']; unset($_SESSION['rok']); endif; ?>" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="cislo">Číslo:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Cislo" name="cislo" value="<?php if (isset($_SESSION['cislo'])) : echo $_SESSION['cislo']; endif; unset($_SESSION['cislo']); ?>" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="kapacita">Kapacita:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Kapacita" name="kapacita" value="<?php if (isset($_SESSION['kapacita'])) : echo $_SESSION['kapacita']; unset($_SESSION['kapacita']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="uzaverka">Uzávěrka:</label>
        <div class="col-sm-6">
          <input type="date" class="form-control" id="Uzaverka" name="uzaverka" placeholder="Např. 1.1.2018" value="<?php if (isset($_SESSION['uzaverka'])) : echo $_SESSION['uzaverka']; unset($_SESSION['uzaverka']); endif; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="temata">Témata:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Temata" name="temata" value="<?php if (isset($_SESSION['temata'])) : echo $_SESSION['temata']; unset($_SESSION['temata']); endif; ?>" required />
        </div>
      </div>
       
      <div class="form-group">
        <label class="control-label col-sm-4" for="editor">Odpovídající editor:</label>
        <div class="col-sm-6">
        <?php
      @$vysledek = $mysqli->query("SELECT id_uzivatele ,titul_pred, jmeno, prijmeni, titul_za FROM uzivatel NATURAL JOIN opravneni WHERE id_role = 4 ;");
       ?>
          <select class="form-control" id="Editor" name="editor" value="<?php if (isset($_SESSION['editor'])) : echo $_SESSION['editor']; unset($_SESSION['editor']); endif; ?>" required />
                      <?php
                          while ($zaznam = $vysledek->fetch_Array()){
                            echo "<option value=" . $zaznam['id_uzivatele'] . " >". getCeleJmeno($zaznam['titul_pred'], $zaznam['jmeno'], $zaznam['prijmeni'], $zaznam['titul_za']) . "</option>";
                      }
                      ?>
                      </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" class="btn btn-default" name="Vytvorit" value="Vytvořit">
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
