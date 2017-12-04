<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <?php include 'connect.php'?>
    
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Přehled již vydaných časopisů</h2>
      </div>
      <div class="col-sm-12">
      <div class="container">
  <p>Zde si můžete stáhnout již vydané časopisy.</p>   
  
   <?php $sql = "SELECT * FROM casopis_vydany"; 
   $vysledek = mysqli_query($mysqli, $sql);
   $rocnik = 2;
   ?> 
           
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Časopis</th>
        <th>Témata časopisu</th>
        <th>Stáhnout</th>       
      </tr>
    </thead>
 <!---------------------------------------------------------------->   
    <tbody>
      <tr>
        <th colspan="3" class = "info">2010 / Ročník 1</th>       
      </tr>                  
      
      <?php    ?>
      <?php while( $row = mysqli_fetch_array($vysledek, MYSQLI_ASSOC) ) : ?>  
     
    
      <tr>
        <td><?php echo $row['rok'].' / Číslo '.$row['cislo']; ?></td>   
        <td><?php echo $row["temata"]; ?></td>
        <td><a href='<?php echo $row["odkaz_k_souboru"];?>' download class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-download-alt'></span> Stáhnout časopis</a> </td>
      </tr>
      
       <?php if ($row['id_casopisu'] % 4 == 0) {?>
          <tr>
        <th colspan="3" class = "info"><?php echo $row['rok']+1 ?> / <?php echo 'Ročník '.$rocnik; $rocnik++;?> </th>       
      </tr>
           <?php } ?>
      
          <?php  endwhile ?>
    </tbody>
  </table>
</div>

      <br /><br /><br />
      
      <hr />
      <br /><br /><br />asdad
      
  </div>    
  </div>
  
   <?php include 'paticka.php'?>


  <?php

  ?>