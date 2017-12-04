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
      Ve druhém vidíte vaše nejnovější nahrané články do časopisu. A pomocí šipečky přejdeme na podrobnosti o čísle časopisu. 
      Ve druhém přehledu po kliknutí na šipečku můžeme přejít na podrobnosti o námi nahraném článku.
      <br /><br />
       <img src="obrazky/uvod_autor.PNG" id="hlavni-menu">
       <br /><br />
      </p>
      <p>V podrobnostech o čísle časopisu můžeme vidět všechny informace o tomto čísle. 
      Jestliže je zbývající kapacita článků větší než 0 zobrazí se tlačítko pro vložení článku.
      <br /><br />
      <img src="obrazky/prehledcasopis.PNG" id="hlavni-menu"></p> 
      <br /> <br />
      <p>
       Po kliknutí na tlačítko pro vložení článku se zobrazí tento formulář. Zde zadáte jméno vašeho článku.<b>Toto jméno již nejde následně měnit.</b>
       A vyberete soubor, který chcete vložit.
       <br /><br />
       <img src="obrazky/nahrani.PNG" id="hlavni-menu">
      </p>
      <br /><br />
      <p>
       Po kliknutí na tlačítko <i>Nahrát článek</i> se zobrazí formulář, kde můžete přidat spoluautora k vámi nahranému článku nebo tento krok můžete přeskočit.
       <br /><br />
       <img src="obrazky/pridatautora.PNG" id="hlavni-menu">
       <br /> <br />
      </p>
      <p>
      V podrobnostech o článku, který jsme nahráli sledujeme informace o něm. Můžeme zde vidět aktuální stav článku, zda bylo zahájeno recenzní řízení a jeho datum. 
      Dále zde můžeme vidět recenze nahrané k našemu článku. Maximální počet recenzí jsou dvě. Tyto recenze si můžeme stáhnout na počítač nebo si je zobrazit přímo na webu.
      Také zde můžeme vidět tlačítko na aktualizování našeho článku. Toto tlačítko je vidět, je-li k článku napsán komentář od editora a zároveň editor povolí aktualizaci článku.
      Po této aktualizaci můžeme znovu sledovat stav článku.  
      <br /><br />
       <img src="obrazky/clanekakt.png" id="hlavni-menu">
      </p>
      <br />        <br />
      <p> V tomto menu si můžete změnit své osobní údaje. V první volbě <b>Upravit údaje</b> si můžete upravit vaše osobní údaje. Ve druhé volbě <b>Změna hesla</b> si můžete můžete změnit své heslo do systému. K tomuto kroku mohou být dva důvody. Jeden z nich je nedůvěra ve své stávající heslo. Druhý důvod je ten, když vás do systému zaregistruje přímo redaktor a vám na e-mail přijde vygenerované heslo tak je vhodné toto heslo změnit. <br /> <br />
       <img src="obrazky/osobnastaveni.png" id="hlavni-menu">
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
