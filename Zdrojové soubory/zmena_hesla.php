<?php
  session_start();
  if(isset($_SESSION['user_is_logged'])){
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
            <h3 class="hlavni-nadpis">Změna hesla do informačního systému</h2>
          </div>
          <?php include 'zpravy.php' ?>
          <form class="form-horizontal" action="zmena_hesla_dotaz.php" method="POST">
            <div class="col-sm-offset-2 col-sm-8">
            <div class="form-group">
              <label class="control-label col-sm-4" for="pswd1">Nové heslo:</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" id="Pswd1" name="pswd1" required />
              </div>
              <a href="#" data-toggle="tooltip" title="Minimálně 10 znaků."><span class=" glyphicon glyphicon-question-sign napoveda"></span></a>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="pswd2">Opakujte nové heslo:</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" id="Pswd2" name="pswd2" required />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <input type="submit" class="btn btn-default" name="Změnit" value="Změnit heslo"></input>
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
