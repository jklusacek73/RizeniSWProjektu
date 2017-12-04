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
          <h3 class="hlavni-nadpis">Přidat nové číslo časopisu</h2>      
      </div>
      <?php include 'zpravy.php' ?>
      
          <form class="form-horizontal" action="casopis_novy_vydany_dotaz.php" method="POST">     
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4" for="rok">Ročník:</label>
        <div class="col-sm-6">
          <input type="number" min="2010"  max="2050" class="form-control" id="Rok" name="rok" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="cislo">Číslo:</label>
        <div class="col-sm-6">
          <input type="number" min="1" max="4" class="form-control" id="Cislo" name="cislo" required />
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-4" for="temata">Témata:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Temata" name="temata" required />
        </div>
      </div>

 <div class="form-group">
        <label class="control-label col-sm-4" for="fileToUpload">Odkaz k souboru:</label>
        <div class="col-sm-6">
         <input type="text" class = "form-control" name="fileToUpload" id="fileToUpload" required> <!-- (podporovaný formát: <b>pdf</b>) -->
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
