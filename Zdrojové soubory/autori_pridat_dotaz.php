<?php
  session_start();
  if((isset($_SESSION['user_is_logged'])) && ($_SESSION['autor'] == true)){
    require_once('connect.php');
    require_once('function.php');
    $vysledek = $mysqli->query("SELECT max(id_autora) AS 'maximum' FROM autori; ");
    $data = $vysledek->fetch_array();
    $id = $data['maximum'];
    if($id == null){
      $id = 1;
    }else{
      $id++;
    }
    @$vysledek = $mysqli->query("INSERT INTO autori VALUES ($id, '$_POST[titpred]', '$_POST[jmeno]', '$_POST[prijmeni]', '$_POST[titza]', '$_POST[inst]', '$_POST[blur]', $_POST[id_casopisu]);");
    if($vysledek){
      $_SESSION['typ'] = "success";
      $_SESSION['zprava'] = "Autor článku byl úspěšně přidán.<br /><b>Dále můžete přidat dalšího autora.</b>";
      header("Location:clanek_autori.php?id=$_POST[id_casopisu]");
      exit;
    }else{
      $_SESSION['typ'] = "danger";
      $_SESSION['zprava'] = "Autor článku nebyl úspěšně přidán.<br /><b>Opakujte zadání autora.</b>";
      $_SESSION['autor_titpred'] = $_POST['titpred'];
      $_SESSION['autor_jmeno'] = $_POST['jmeno'];
      $_SESSION['autor_prijmeni'] = $_POST['prijmeni'];
      $_SESSION['autor_titza'] = $_POST['titza'];
      $_SESSION['autor_inst'] = $_POST['inst'];
      $_SESSION['autor_blur'] = $_POST['blur'];
      header("Location:clanek_autori.php?id=$_POST[id_casopisu]");
      exit;
    }
  }else{
    header("Location:index.php");
  }
  ?>
