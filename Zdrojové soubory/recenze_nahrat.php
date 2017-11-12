  <?php session_start();
  if(isset($_SESSION['user_is_logged']) && ($_SESSION['recenzent'] == true)){
    require_once('connect.php');
    if(isset($_GET['id'])){
      @$vysledek = $mysqli->query("SELECT * FROM clanek WHERE id_clanku = $_GET[id];");
      $zaznam = $vysledek->fetch_array();
      if($zaznam['id_clanku'] == null){
        header("Location:uvod.php");
      }
    }else{
      header("Location:uvod.php");
    }
    ?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h2 class="hlavni-nadpis">Nahrání recenze k článku <?php echo $zaznam['nazev_clanku']?> </h2>
      </div>
      <?php include 'zpravy.php'?>
      <form class="form-horizontal" action="upload_recenze.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $zaznam['id_clanku'] ?>" />
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
        <label class="control-label col-sm-4" for="fileToUpload">Vybrat soubor:</label>
        <div class="col-sm-8">
         <input type="file" name="fileToUpload" id="fileToUpload" required>  (podporovaný formát: <b>pdf</b>)
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
          <button type="submit" class="btn btn-default">Nahrát recenzi</button>
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
