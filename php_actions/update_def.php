<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();
require_once('../connexion.php');
?> 

<?php
//insert.php
//echo "ahmed";
    //Create connection
 if(isset($_REQUEST))
 {
      $mode="1";
      $dem="0";
      $temp= $_POST['temp'];
      $humd = $_POST['humd'];
      $pouss = $_POST['pouss'];
     
  
      $sql = "UPDATE default_climat SET mode_auto='".$mode."',demarrer='".$dem."' ,def_temp='".$temp."', def_humd='".$humd."' , def_pouss='".$pouss."' " ;
       
     $query = mysqli_query($dbprotect, $sql);

      if($query){
          echo json_encode("Data Updated Successfully");
          }
      else {
          echo json_encode('problem');
          }
      }
    else echo json_encode('problem2222222222222');

?>
 