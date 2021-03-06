<div id="cele">
<div class="row">
  <div class="col-sm-12">
     <nav id="hlavni-menu" class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src='obrazky/logo.png' height="40px" style="margin-top: -10px"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <?php if(!isset($_SESSION['user_is_logged'])) : ?>
              <li><a href="registrace.php">Registrace</a></li>
              <li><a href="kontaktni_formular_neprihlasen.php">Kontaktní formulář</a></li>
              <li><a href="prehled_vydanych_casopisu.php">Přehled vydaných časopisů</a></li>
            <?php endif ?>
            <?php if(isset($_SESSION['user_is_logged'])) : ?>
              <li><a href="casopis_prehled.php">Přehled časopisů</a></li>
              <li><a href="kontaktni_formular.php">Kontaktní formulář</a></li>
              <li><a href="prehled_vydanych_casopisu.php">Přehled vydaných časopisů</a></li>
              <?php if($_SESSION['redaktor'] == true) : ?>
                <li><a href="seznam_uzivatelu.php">Seznam uživatelů</a></li>
              <?php endif ?>
              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Návody <span class="caret"></span></a>
              <ul class="dropdown-menu">
                    <li><a href="datum_firefox.php">Podpora datumu</a></li>
                    <?php if($_SESSION['autor'] == true) : ?>
                    <li><a href="soubory/navod_autor.pdf" target="_blank">Návod na používání IS - autor</a></li>
                    <?php endif ?>
                    <?php if($_SESSION['recenzent'] == true) : ?>
                    <li><a href="soubory/navod_recenzent.pdf" target="_blank">Návod na používání IS - recenzent</a></li>
                    <?php endif ?>
                    <?php if($_SESSION['editor'] == true) : ?>
                    <li><a href="soubory/navod_editor.pdf" target="_blank">Návod na používání IS - editor</a></li>
                    <?php endif ?>
                    <?php if($_SESSION['redaktor'] == true) : ?>
                    <li><a href="soubory/navod_redaktor.pdf" target="_blank">Návod na používání IS - redaktor</a></li>
                    <?php endif ?>
                  </ul></li>
            <?php endif ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['user_is_logged'])) : ?>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Nastavení <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="upravit_udaje.php">Upravit údaje</a></li>
                    <li><a href="zmena_hesla.php">Změna hesla</a></li>
                  </ul>
              </li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Odhlásit</a></li>
            <?php endif ?>
          </ul>
      </div>
      </div>
      </nav>
  </div>
  </div>
