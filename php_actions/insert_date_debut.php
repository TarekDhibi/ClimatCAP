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
      //$date_deb = $_POST['date_deb'];
      $date_deb = date("D M j G:i:s T Y"); 
        
      $sql = "INSERT INTO historique (date_deb,date_fin) VALUES ('".$date_deb."','".''."')";

      $query = mysqli_query($dbprotect, $sql);

      if($query){
          echo json_encode("Data Inserted Successfully");
          }
      else {
          echo json_encode('problem');
          }
      }
	  else echo json_encode('problem2222222222222');

?>