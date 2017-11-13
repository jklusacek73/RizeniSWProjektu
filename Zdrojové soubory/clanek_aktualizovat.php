  <?php
  session_start();
  require_once('connect.php');
  if(isset($_SESSION['user_is_logged']) && ($_SESSION['autor'] == true)){
  if(isset($_GET['id'])){
    include 'hlavicka.php';
    include 'menu-uvod.php';
    include 'hlavni-foto.php';
    @$vysledek = $mysqli->query("SELECT * FROM clanek WHERE id_clanku = $_GET[id]");
    $zaznam = $vysledek->fetch_array();
    if($zaznam['id_clanku'] !== null && $zaznam['odpovedny_uzivatel'] == $_SESSION['id_uzivatele']){
      ?>
      <div class="row" id="hlavni">
          <div class="col-sm-offset-1 col-sm-10 col-xs-12">
          <div class="col-sm-12">
            <h2 class="hlavni-nadpis">Aktualizace článku <?php echo $zaznam['nazev_clanku'] ?></h2>
          </div>
          <?php include 'zpravy.php'?>
          <form class="form-horizontal" action="upload_aktualizace.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $zaznam['id_clanku'] ?>" />
            <input type="hidden" name="nazev" value="<?php echo $zaznam['nazev_clanku'] ?>" />
          <div class="col-sm-offset-2 col-sm-8">
            <div class="form-group">
            <label class="control-label col-sm-4" for="fileToUpload">Vybrat soubor:</label>
            <div class="col-sm-8">
             <input type="file" name="fileToUpload" id="fileToUpload" required>  (podporovaný formát: <b>pdf</b>)
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-10">
              <button type="submit" class="btn btn-default">Aktualizovat článek</button>
            </div>
          </div>
          </div>
          </form>
        </div>
        </div>
      <?php include 'paticka.php';
    }else{
      header("Location:uvod.php");
      exit;
    }
  }else{
    header("Location:uvod.php");
    exit;
  }
}else {
  header("Location:uvod.php");
  exit;
}
  ?>
