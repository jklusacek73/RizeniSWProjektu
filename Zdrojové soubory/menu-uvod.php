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
            <?php endif ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['user_is_logged'])) : ?>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Odhlásit</a></li>
            <?php endif ?>
          </ul>
      </div>
      </div>
      </nav>
  </div>
  </div>
