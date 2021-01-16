<?php
session_start ();
    if(!isset($_SESSION['login']))
    {
        echo 'Vous n\'êtes pas connecté au site.  Vous ne pouvez donc pas venir sur cette page.';
        header ('location: index.php');
    }
?>
<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
 require_once('connexion.php');
?> 

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APPLICATION WEB - BRUMISATION</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">



 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<script src="js/script.js"></script>




    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/brumisation.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">CLIMA-CAP</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-secondary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

               <label class="TEMP">TEMPERATURE: </label><label style="color:red;" id="temp" class="TEMP"></label><label class="TEMP">°C</label>
   <label class="sep"></label>
        <label class="HUM">humidity: </label><label style="color:#66b3ff;" id="hum" class="HUM"></label><label class="HUM">%</label>

            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"></a>
            </li>
 
  

            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Configuration</a>
            </li>


 <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#historique">Historique</a>
            </li>
 
          </ul>
  
         </div>
      </div>

      <a id="dc" href="logout.php">Déconnecté</a>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" style="width:50%;"src="img/profile.png" alt="">
        <h1 class="text-uppercase mb-0">Système de brumisation </h1>
          
      </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
       <label class="systemManager" ><B>Configuration système</B></label>
         <div class="row">
      <h3>MODE AUTOMATIQUE</h3>&nbsp;&nbsp;&nbsp;<label class="switch"><input  type="checkbox"  id="1stauto" onchange="changemode(this)"  ><span class="slider round"></span></label>&nbsp;&nbsp;&nbsp;<h3>MODE MANUELLE</h3> 
        </div>
                        <script>
                            // change function mode
                 var x = document.getElementById("mandata");

                            function changemode(checkboxElem) {

 
                            if (checkboxElem.checked) {
                              //alert ("mode manuelle");



                              document.getElementById("mandata").style.visibility="visible";

                              $('#mandata').fadeIn('slow');
                        // disable button save setting 
                         document.getElementById('savesetting').disabled = true;

                          // update 
                            $.ajax({
                                data:{mode:0,demarrer:0},
                                 type: "POST",
                                 url: "./php_actions/update_mode.php",
                                 success: function(data){
                                   // alert("Data Save: " + data);  
                                  }
                                
                                  }); 


document.getElementById('infotitle').innerHTML = 'Mode manuelle activer : vous pouvez demarrerle système manuellement';
                                // desactiver le input
                                var color="#21303f";
                                document.getElementById('dftemp').disabled = true;
                                document.getElementById('dftemp').style.backgroundColor =color;
                                document.getElementById('dfhum').disabled = true;
                                document.getElementById('dfhum').style.backgroundColor =color;
                                document.getElementById('dfpouss').disabled = true;
                                document.getElementById('dfpouss').style.backgroundColor =color;
                                document.getElementById('dfnbr').disabled = true;
                                document.getElementById('dfnbr').style.backgroundColor =color;

 
                            } else {
                              //unchecked 2nd checkbox 

                              document.getElementById("mandata").style.visibility="hidden";
        document.getElementById("2ndcheckbox").checked = false;



                              // 
                              $.ajax({
                                data:{mode:1,demarrer:0},
                                 type: "POST",
                                 url: "./php_actions/update_mode.php",
                                 success: function(data){
                                   // alert("Data Save: " + data);  
                                  }
                                
                                  }); 


                        //**************************

                               document.getElementById('savesetting').disabled = false;

                              //alert ("mode automatique");
                              //show more info
                             $('#mandata').fadeOut('slow');
document.getElementById('infotitle').innerHTML = 'Mode automatique activer : vous pouvez modifier le parametre ci dessous';
                                  
                                  color="white";
                                document.getElementById('dftemp').disabled = false;
                                document.getElementById('dftemp').style.backgroundColor =color;
                                document.getElementById('dfhum').disabled = false;
                                document.getElementById('dfhum').style.backgroundColor =color;
                                document.getElementById('dfpouss').disabled = false;
                                document.getElementById('dfpouss').style.backgroundColor =color;
                             } 

                          }

                        </script>
                                    
  </div>
        

    </section>

              <div>
                <div id="infotitle" class="infotitle">Mode automatique activer : vous pouvez modifier le parametre ci dessous</div>
                   <div class="mainC">

 <div class="row">
    <div class="col-xs-9 col-md-7" style="background-color:;">
      
                 <form class="form-horizontal">
                      <div class="form-inline">
                        <label id="labtemp"  class="col-sm-6 control-label defaultinput">Température par defaut : (c°) </label>
                        <div class="col-sm-2">
                          <input type="number" class="form-control" id="dftemp" value="" placeholder="">

                        </div>
                      </div>
                      <br>
                      <div class="form-inline">
                        <label id="labhum"  class="col-sm-6 control-label defaultinput">Humidité par defaut : (%) </label>

                        <div class="col-sm-2">
                                                    <input type="number" class="form-control" value="" id="dfhum" placeholder="">

                        </div>
                      </div>
                      <br>
                     <div class="form-inline">
                                             <label  id="labpouss" class="col-sm-6 control-label defaultinput">Concentration de poussière par défaut :</label>

                        <div class="col-sm-2">
                          <input type="number" class="form-control" id="dfpouss" value="" placeholder="">

                        </div>
                      </div>
                      <br>
  

                      <div class="form-group">
                        
                      </div>

                    </form>

    </div>

    <div  id="mandata" class="col-xs-3 col-md-5 form-inline" style="background-color:;visibility:hidden ;">
                        
          <label class="maninputmode">Arreter</label>&nbsp;&nbsp;&nbsp;<label class="switch"><input id="2ndcheckbox" type="checkbox"  onchange="changeplay(this)" ><span class="sliderplay round"></span></label>&nbsp;&nbsp;&nbsp;<label class="maninputmode">Demarrer</label> 


     </div>





  </div>


                <br>
                <div > </div>

                <input class="savebutton" onClick="pushdata();" id="savesetting" type="submit" value="Sauvgarder"></input> 
                    <input class="savebutton" id="defaultsetting" type="submit" value="Paramètres par defaut" onClick="resetDefault();" ></input>




</div>


              </div>

<hr>
    <!-- hisotique Grid Section -->
    <section class="portfolio" id="historique">
      <div class="container">
       <label class="systemManager" ><B>Historique de système</B></label>
      
                      
       </div>
        

    </section>


              <div>
                <div id="infotitle" class="infotitle">Historique de système de brumisation: DATE DE FONCTIONNEMENT</div>
                   <div class="mainC2">

                             <div class="container" style="background-color:;">

                                  <table class="table table-light">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date debut de fonctionnement</th>
                                        <th scope="col">Date arret de fonctionnement</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <!-- fetch historique from database-->
                                       <?php
                                      $sql = "SELECT * FROM historique order by id DESC";
                                      $result = mysqli_query($dbprotect, $sql);
                                       if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while($row = mysqli_fetch_assoc($result)) {
                                          echo "
                                          <tr id='".$row["id"]."'>
                                          <td>" . $row["id"]. "</td> 
                                            <td>" . $row["date_deb"]. "</td> 
                                            <td>" . $row["date_fin"]. "</td>                                             
                                          ";  
                                      
                                        }
                                      } else {
                                        echo "0 results";
                                      }
                                      ?>


                                      </tr>
                                    </tbody>
                                  </table>
                       

                          </div>
                      </div>
                    </div>




    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/brumisation.min.js"></script>

  </body>

</html>
