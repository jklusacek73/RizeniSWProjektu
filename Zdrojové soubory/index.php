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
    <div class="col-sm-offset-2 col-sm-8">
      <br />
      <form class="form-horizontal" action="login.php" method="post">
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
      </form>
      <br />
      </div>
      <div class="col-sm-12">
        <div class="well well-sm">
        </p>Toto je první verze informačního systému pro časopis Logos Polytechnikos.</p>
      </p>Do tohoto informačního systému se můžete přihlásit těmito účty (samozřejmě nebudou fungovat notifikace pomocí e-mailu): </p>
          <ul>
            <li><b>jirik.73@seznam.cz</b> jako redaktor a recenzent</li>
            <li><b>klusacek@student.vspj.cz</b> jako editor čísla časopisu</li>
            <li><b>jklusacek73@gmail.com</b> jako autor článku</li>
            <li><b>rspklusacek@gmail.com</b> jako recenzent</li>
          </ul>
            <p>Všechny účty mají heslo: <b>0123456789</b> - toto heslo samozřejmě nejde použít pro vstup do emailových schránek. :-)</p>
            <p>Samozřejmě si můžete vytvořit své účty jako autor přímo zde bez přihlášení nebo se přihlásit jako redaktor a založit všechny ostatní role</p>
        </div>
      </div>
    </div>
    </div>
  <?php include 'paticka.php'?>
<?php
} else {
  header('Location:uvod.php');
}
?>
