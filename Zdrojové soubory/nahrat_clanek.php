<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <?php session_start() ?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h2 class="hlavni-nadpis">Nahrání článku do časopisu</h2>
      </div>
      <?php include 'zpravy.php'?>
      <form class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4" for="nazevclanku">Název článku:</label>
        <div class="col-sm-8">
          <input type="text" name="nazevClanku"class="form-control" id="nazevclanku" value="<?php if(isset($_SESSION['nazev'])) : echo $_SESSION['nazev']; unset($_SESSION['nazev']); endif ?>" required>
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="fileToUpload">Vybrat soubor:</label>
        <div class="col-sm-8">
         <input type="file" name="fileToUpload" id="fileToUpload" required>  (podporovaný formát: <b>pdf</b>)
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
          <button type="submit" class="btn btn-default">Nahrát článek</button>
        </div>
      </div>
      </div>
      </form>
    </div>
    </div>
  <?php include 'paticka.php'?>
