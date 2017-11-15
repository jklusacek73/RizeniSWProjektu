<?php
session_start();
if(isset($_SESSION['user_is_logged'])){
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
      <form class="form-horizontal" action="" method="POST">
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">
        <label class="control-label col-sm-4 nepovinne" for="pripominky"><b>Zde můžete napsat své připomínky:</b></label>
        <div class="col-sm-6">
        <textarea name="pripominky" cols="90" rows="11" autofocus required></textarea><br /><br /><br />
        </div>
                  
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" class="btn btn-default" name="Odeslat" value="Odeslat"></input>
        </div>
      </div>
      </div>
      <?php 
       $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . $_SESSION['e-mail'] . '>' . "\r\n";
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
        mail($mailfrom,'Připomínky k časopisu',$message,$headers);
       // if(mail){
        //$_SESSION['typ'] = "success";
        //$_SESSION['zprava'] = "Vaše připomínka byla úspěšně odeslána.";
        //}else{
        //$_SESSION['typ'] = "danger";
        //$_SESSION['zprava'] = "Vaše připomínka nebyla úspěšně odeslána.";
        //}
        //header("Location:kontaktni_formular.php");
  ?>
      </form>
      
    </div>
    </div>
  <?php include 'paticka.php'?>
  
  
  <?php
}else{
  header("Location:uvod.php");
}
  ?>