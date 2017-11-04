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

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
