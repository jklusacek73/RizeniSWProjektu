<?php session_start() ?>
  <?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
    <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Přihlášení do informačního systému</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <form class="form-horizontal">
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="email">
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Heslo:</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="pwd">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Přihlásit</button>
        </div>
      </div>
      </div>
      </form>
    </div>
    </div>
  <?php include 'paticka.php'?>
