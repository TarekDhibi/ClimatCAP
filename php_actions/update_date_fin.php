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
      $date_fin = date("D M j G:i:s T Y"); 
        
      $sql = "UPDATE historique set date_fin='".$date_fin."' where date_fin='' ";

      $query = mysqli_query($dbprotect, $sql);

      if($query){
          echo json_encode("Data updated Successfully");
          }
      else {
          echo json_encode('problem');
          }
      }
	  else echo json_encode('problem2222222222222');

?>