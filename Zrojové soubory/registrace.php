<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Registrace do informačního systému</h2>
      </div>                         
      <form class="form-horizontal" action="registrace_dotaz.php" method="post">
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titpred">Titul před jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="titpred">
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="jmeno">Jméno:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="jmeno" >
        </div>
      </div>
        <div class="form-group">
        <label class="control-label col-sm-4" for="prijmeni">Příjmení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="prijmeni" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="titza">Titul za jménem:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="titza">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="email">Email:</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="email" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="pswd">Heslo:</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="pswd" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="inst">Instituce:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="inst" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="blur">Bližší určení:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="blur">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Registrovat</button>
        </div>
      </div>
      </div> 
      </form>
    </div> 
    </div>
    
    
  <?php include 'paticka.php'?>