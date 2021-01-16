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
      $mode= $_POST['mode'];
      $demarrer = $_POST['demarrer'];
      
  
      $sql = "UPDATE default_climat SET mode_auto='".$mode."', demarrer='".$demarrer."' " ;
       
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
 