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
        <h3 class="hlavni-nadpis">Přihlášení do informačního systému</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <form class="form-horizontal" action="login.php" method="post">
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="Email" name="email" required />
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Heslo:</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="Pwd" name="pwd" required />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input class="btn btn-default" type="submit" value="Přihlásit" name="prihlasit" />
        </div>
      </div>
      </div>
      </form>
    </div>
    </div>
  <?php include 'paticka.php'?>
<?php
} else {
  header('Location:uvod.php');
}
?>
