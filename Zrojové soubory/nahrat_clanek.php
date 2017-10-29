<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Nahrání článku</h2>
      </div>           
      <form class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">  
      <div class="col-sm-offset-2 col-sm-8">
      <div class="form-group">             
        <label class="control-label col-sm-4" for="nazevclanku">Název článku:</label>
        <div class="col-sm-6">
          <input type="text" name="nazevClanku"class="form-control" id="nazevclanku" required>
        </div>                                              
      </div>                     
        <div class="form-group">      
        <label class="control-label col-sm-4" for="fileToUpload">Vybrat soubor:</label>
        <div class="col-sm-6">
         <input type="file" name="fileToUpload" id="fileToUpload" required>  (podporované formáty: <b>pdf, txt, doc, docx)</b>
        </div>    
      </div>         
        <div class="form-group">
        <label class="control-label col-sm-4" for="cislocasopisu">Číslo časopisu</label>
        <div class="col-sm-6">
          <input type="text" name="cisloCasopisu" class="form-control" id="cislocasopisu" required>
        </div>
      </div>   
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Nahrát článek</button>
        </div>
      </div>
      </div>
      </form>
    </div> 
    </div>
  <?php include 'paticka.php'?>