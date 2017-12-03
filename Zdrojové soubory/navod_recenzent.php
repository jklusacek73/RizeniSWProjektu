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
        <h3 class="hlavni-nadpis">Návod na používání IS Logos Polytechnikos</h2>
      </div>
      <?php include 'zpravy.php' ?>
      <div class="col-sm-10">
      <p>Po přihlášení do systému se vám zobrazí tento přehled. V prvním přehledu můžete vidět čísla časopisu, která ještě nebyla vydána. 
      Ve druhém vidíte vaše nejnovější nahrané recenze k článkům. A pomocí šipečky přejdeme na podrobnosti o čísle časopisu.
      <br /><br />
       <img src="obrazky/" id="hlavni-menu">
       <br /><br />
      </p>
      
      <p>V tomto přehledu vidíme podrobnosti o čísle. Pod podrobnostmi můžeme vidět články nahrané k tomuto číslu. 
      Zde pomocí šipečky přejdeme na podrobnosti o článku ke kterému chceme vložit recenzi.
      <br /><br />
       <img src="obrazky/clanek_recenzent.png" id="hlavni-menu">
       <br /><br />
       </p>  
       <p>
       Pokud u námi vybraného článku ještě nebylo ukončené recenzní řízení nebo jestli již nejsou nahrané dvě recenze vidíme tlačítko pro nahrání recenze.
         <br /><br />
       <img src="obrazky/clan_recenzent.png" id="hlavni-menu">
       <br /><br />
       </p> 
       <p>
       Po kliknutí na tlačítko pro vložení recenze se zobrazí tento formulář. 
       Zde vyberete soubor, který chcete vložit.
         <br /><br />
       <img src="obrazky/nahr_recen.PNG" id="hlavni-menu">
       <br /><br />
       </p>
       <p>
       Po kliknutí na tlačítko <i>Nahrát recenzi</i> se recenze nahraje k námi vybranému článku. 
       V podrobnostech o tomto článku můžeme vidět recenzi, kterou jsme nahráli.
       </p>  
      
    </div>
    </div>
    </div>
  <?php include 'paticka.php'?>


  <?php
}else{
  header("Location:uvod.php");
}
  ?>
