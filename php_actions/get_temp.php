<?php
// On d¨¦marre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();
require_once('../connexion.php');
?> 

<?php
 
  if(isset($_REQUEST))
 {
 
	 $sql="SELECT temp FROM climat_table";
	 $result= mysqli_query($dbprotect, $sql);
 	
 	
	if (mysqli_num_rows($result) > 0) { // calcule de premier partie on mettre dans sommme
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) 
						{
  
							$temp=$row["temp"]; 
							 echo $temp;
						}

						}
						else{
							echo'no data';
						}
 
 
 
 }
 
?>
 