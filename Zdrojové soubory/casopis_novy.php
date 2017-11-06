<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'])){
require_once('connect.php');
if(isset($_GET['id'])){
  @$vysledek = $mysqli->query("SELECT * FROM casopis WHERE id_casopisu = $_GET[id];");
  $zaznam = $vysledek->fetch_array();
  if($zaznam['id_casopisu'] == null){
    header("Location:casopis_prehled.php");
  }else{
    $_SESSION['rok'] = $zaznam['rok'];
    $_SESSION['kapacita'] = $zaznam['kapacita'];
    $_SESSION['uzaverka'] = $zaznam['uzaverka'];
    $_SESSION['temata'] = $zaznam['temata'];
    $_SESSION['editor'] = $zaznam['odpovida'];
  }
}
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <?php include 'function.php'?>

  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <?php if(isset($_GET['id'])){ ?>
          <h3 class="hlavni-nadpis">Úprava čísla časopisu</h2>
        <?php } else { ?>
          <h3 class="hlavni-nadpis">Vytvoření nového čísla časopisu</h2>
        <?php } ?>
      </div>
      <?php include 'zpravy.php' ?>
      <?php if(isset($_GET['id'])){ ?>
          <form class="form-horizontal" action="casopis_upravit_dotaz.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
      <?php  } else { ?>
          <form class="form-horizontal" action="casopis_novy_dotaz.php" method="POST">
      <?php } ?>
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4" for="rok">Ročník:</label>
        <div class="col-sm-6">
          <input type="number" min="<?php echo date("Y") ?>"  max="2050" class="form-control" id="Rok" name="rok" value="<?php if (isset($_SESSION['rok'])) : echo $_SESSION['rok']; unset($_SESSION['rok']); endif; ?>" <?php if (isset($_GET['id'])) : echo "disabled"; endif; ?> required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="kapacita">Kapacita:</label>
        <div class="col-sm-6">
          <input type="number" min="1" max="30" class="form-control" id="Kapacita" name="kapacita" value="<?php if (isset($_SESSION['kapacita'])) : echo $_SESSION['kapacita']; unset($_SESSION['kapacita']); endif; ?>" required />
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
          <select class="form-control" id="Editor" name="editor" required />
          <?php
              while ($zaznam = $vysledek->fetch_Array()){
                echo "<option value=" . $zaznam['id_uzivatele'];
                if((isset($_SESSION['editor'])) && ($zaznam['id_uzivatele'] == $_SESSION['editor'])){
                  echo ' selected ';
                }
                echo " >". getCeleJmeno($zaznam['titul_pred'], $zaznam['jmeno'], $zaznam['prijmeni'], $zaznam['titul_za']) . "</option>";
              }
          ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <?php if(isset($_GET['id'])){ ?>
            <input type="submit" class="btn btn-default" name="Upravit" value="Upravit">
          <?php  } else { ?>
            <input type="submit" class="btn btn-default" name="Vytvorit" value="Vytvořit">
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
