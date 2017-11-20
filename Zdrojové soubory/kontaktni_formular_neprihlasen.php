<?php
session_start();
if(!isset($_SESSION['user_is_logged'])){
  require_once('connect.php');
  require_once('function.php');
?>
<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Kontaktní formulář</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <div class="col-sm-12">
      <div class="well well-sm">
        Tento kontaktní formulář můžete použít pro reakci na určitý článek uveřejněný v časopise.<br />
        Dále tento formulář používejte v případě že chcete spolupracovat s týmem časopisu Logos Polytechnikos nebo v případě jakýchkoliv dotazů.<br />
        <b>Redakce se bude snažit na všechny podněty reagovat.</b>
      </div>
    </div>
      <form class="form-horizontal" action="" method="POST">
      <div class="col-sm-10">
      <div class="form-group">
        <label class="control-label col-sm-4">Kontaktní email</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" name="email" required></input>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="pripominky"><b>Zde můžete napsat své připomínky:</b></label>
        <div class="col-sm-6">
        <textarea name="pripominky" cols="89" rows="11" autofocus required></textarea><br /><br /><br />
        </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" class="btn btn-default" name="Odeslat" value="Odeslat"></input>
        </div>
      </div>
      </div>

      <?php
      if(isset($_POST['Odeslat'])){
       $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . $_POST['email'] . '>' . "\r\n";
        $message = "
          <html>
          <head>
            <title>Připomínky k časopisu</title>
          </head>
          <body>
          <p>Dobrý den,</p>
          <p>Zde jsou nějaké připomínky k časopisu Logos Polytechnikos:</p>
          <p>$_POST[pripominky]</p>
          </body>
          </html>
          ";
        mail($mailFrom,'Připomínky k časopisu',$message,$headers);
        $_SESSION['typ'] = "success";
        $_SESSION['zprava'] = "Vaše připomínka byla úspěšně odeslána.";
        header("Location:uvod.php");
        }
       // if(mail){

        //}else{
        //$_SESSION['typ'] = "danger";
        //$_SESSION['zprava'] = "Vaše připomínka nebyla úspěšně odeslána.";
        //}

  ?>
      </form>

    </div>
    </div>
    </div>
  <?php include 'paticka.php'?>


  <?php
}else{
  header("Location:uvod.php");
}
  ?>
