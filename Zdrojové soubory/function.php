<?php
function getCeleJmeno($titul_pred, $jmeno, $prijmeni, $titul_za){
  $celeJmeno = '';
  if($titul_pred !== '' ) :
   $celeJmeno .= $titul_pred . ' ';
  endif;
  $celeJmeno .=  $jmeno . ' ' . $prijmeni;
  if($titul_za !== '' ) :
   $celeJmeno .= ', ' . $titul_za;
  endif;
  return $celeJmeno;
}
?>
