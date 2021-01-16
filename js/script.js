loadTime();

function loadTime()
{
get_temp();
get_hum();

var delayInMilliseconds = 5000; //5 second
setTimeout(function() {
  //your code to be executed after 1 second
loadTime();

 
}, delayInMilliseconds);

}

 

loadTimeHist();
function loadTimeHist()
{

var delayInMilliseconds = 3000; //3 second
setTimeout(function() {
  //your code to be executed after 1 second
loadTimeHist();
  get_mode_auto();
  get_arreter();
  hist();

 
}, delayInMilliseconds);

}
var yp=1; //automatique
var ym=1; // manuelle
// gestion d'historique
var du ;
var o ;
var m ; //mode _get_mode_auto
var d ; //demarrer _get_arrete
function hist()
{
  var dt = du; 
  var t = o;
      console.log("default temperature" + dt);
      console.log("temperature actuel "+t);
      console.log("mode historiue "+m);
      console.log("demarrer historique "+d);
    // test 

 
if(m==1) // test mode automatique // faire ca if mode automatique ==1
{
            if(t>dt && yp==1)
            {
              console.log("temp > def temp");
              //insert 
             // var date_deb= new Date();
              //console.log(date_deb);
              console.log("insertion");
              $.ajax({
                          //data:{date_deb:date_deb},
                           type: "POST",
                           url: "./php_actions/insert_date_debut.php",
                           success: function(data){
                             console.log("Data Save: " + data);  
                            }
                          
                            }); 
                
        yp=0;
             }
             else if(t<dt && yp==0) 
             { 
              //update
               console.log("modification");
              console.log("temp < def temp"); 
              //var date_fin= new Date();
              //console.log(date_fin);
              $.ajax({
                         // data:{date_fin:date_fin},
                           type: "POST",
                           url: "./php_actions/update_date_fin.php",
                           success: function(data){
                             console.log("Data Save: " + data);  
                            }
                          
                            }); 
        yp=1;
               }
 }// end test mode 
 else //mode manuelle
 {
      if(d==1 && ym==1)//conidtion sur button demarrer - insertion
      {
      console.log("insertion mode manuelle");
              $.ajax({
                          //data:{date_deb:date_deb},
                           type: "POST",
                           url: "./php_actions/insert_date_debut.php",
                           success: function(data){
                             console.log("Data Save: " + data);  
                            }
                          
                            }); 
                
        ym=0;
      }
      else if(d!=1 && ym==0)//modification
      {
          console.log("modification mode manuelle");
               //var date_fin= new Date();
              //console.log(date_fin);
              $.ajax({
                         // data:{date_fin:date_fin},
                           type: "POST",
                           url: "./php_actions/update_date_fin.php",
                           success: function(data){
                             console.log("Data Save: " + data);  
                            }
                          
                            }); 
        ym=1;
      }
 }          
  
 
}

 
// fnction to get humidite from database

function get_temp()
{

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_temp.php",             
        dataType: "html",   //expect html to be returned                
        success: function(datax){                    
             //console.log("temperature : "+data);
               document.getElementById('temp').innerHTML = datax;
                o=datax;
        }
 
});
}
function get_hum()
{

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_hum.php",             
        dataType: "html",   //expect html to be returned                
        success: function(datas){                    
            // console.log("humidite : "+data);
                           document.getElementById('hum').innerHTML = datas;

        }
 
});
}
function get_pouss()
{

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_pouss.php",             
        dataType: "html",   //expect html to be returned                
        success: function(data){                    
           //  console.log("poussiere : "+data);
        }
 
});
}
get_def_temp();
get_def_hum();
get_def_pouss();

//*-----------------------------------------
function get_def_temp()
{

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_def_temp.php",             
        dataType: "html",   //expect html to be returned                
        success: function(dataa){                    
         console.log("default temperature : "+dataa);
        document.getElementById('dftemp').value=Number(dataa) ;
        du=dataa;
                         
        }
 
});
}
function get_def_hum()
{

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_def_hum.php",             
        dataType: "html",   //expect html to be returned                
        success: function(dataaa){                    
              console.log("def hum : "+dataaa);
             document.getElementById('dfhum').value =Number(dataaa);

        }
 
});
}
function get_def_pouss()
{

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_def_pouss.php",             
        dataType: "html",   //expect html to be returned                
        success: function(dataaaa){                    
              console.log("def pouss : "+dataaaa);
            document.getElementById('dfpouss').value =Number(dataaaa);
                              
        }
 
});
}



//*-----------------------------------------


function resetDefault()
{


	var txt;
		var r = confirm("Press ok to reset!");
		if (r == true) 
		{
			    console.log("You pressed ok!");

				 var t = 40;
				 var h = 60;
 				 var p = 500;

				//alert("reset setting");
				console.log("reset setting");

				document.getElementById('dftemp').value = t;
				document.getElementById('dfpouss').value = p;
				document.getElementById('dfhum').value = h;
     
				 $.ajax({
        data:{temp:t,humd:h,pouss:p},
         type: "POST",
         url: "./php_actions/update_def.php",
         success: function(data){
           // alert("Data Save: " + data);  
            }
        
          }); 


		} else 
		{
    	console.log("You pressed Cancel!");
		}	

 
 }


function pushdata()
{
	console.log("save setting");

	var temp = document.getElementById('dftemp').value ;
	var humd = document.getElementById('dfhum').value;
	var pouss = document.getElementById('dfpouss').value; 
 	//alert(temp+"" + humd + ""+pouss);

	 
	 	var txt;
		var r = confirm("Cliquez sur ok pour sauvgarder les paramétres!");
		if (r == true) 
		{
	 			 $.ajax({
				data:{temp:temp,humd:humd,pouss:pouss},
				 type: "POST",
				 url: "./php_actions/update_def.php",
				 success: function(data){
					 // alert("Data Save: " + data);	
  					}
				
				  }); 
				 
		} else 
		{
    	console.log("Cancel!");
		}	


}




      // change function mode
 function changeplay(checkboxElem) {
                            if (checkboxElem.checked) {
                              //alert ("play");
                              console.log("demarrer");
                                
                              var mode = 0 ; // mode manuelle
                              var demarrer=1; // demarrer le moteur	

					 			$.ajax({
									data:{mode:mode,demarrer:demarrer},
									 type: "POST",
									 url: "./php_actions/update_mode.php",
									 success: function(data){
										 // alert("Data Save: " + data);	
 					 					}
									
									  }); 

                            } else {
                              //alert ("stop");
                            console.log("stop");

                            $.ajax({
                          data:{mode:0,demarrer:0},
                           type: "POST",
                           url: "./php_actions/update_mode.php",
                           success: function(data){
                             // alert("Data Save: " + data);  
                            }
                          
                            }); 


                            }
                          }


//********************

 
get_mode_auto();
get_arreter();


 function get_mode_auto()
{
	 $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_mode_auto.php",             
        dataType: "html",   //expect html to be returned                
        success: function(datap){                    
         console.log("mode : "+datap);
         m=datap;
         if(datap==1)
          {
            console.log("mode auto");
            document.getElementById("1stauto").checked=false;
           }
          else 
          {
               // desactiver le input
                                var color="#21303f";
                                document.getElementById('dftemp').disabled = true;
                                document.getElementById('dftemp').style.backgroundColor =color;
                                document.getElementById('dfhum').disabled = true;
                                document.getElementById('dfhum').style.backgroundColor =color;
                                document.getElementById('dfpouss').disabled = true;
                                document.getElementById('dfpouss').style.backgroundColor =color;

 document.getElementById('savesetting').disabled = true;

            console.log("mode man");

              document.getElementById("mandata").style.visibility="visible";
             document.getElementById("1stauto").checked=true;
          }

        }
 });
}
  function get_arreter()
{
	 $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "./php_actions/get_demarrer.php",             
        dataType: "html",   //expect html to be returned                
        success: function(dataf){                    
           console.log("play : "+dataf);
      d=dataf;
      if(dataf==1)
          {
            console.log("marcher");
          
           document.getElementById("2ndcheckbox").checked=true;

          }
          else 
          {
            console.log("arreter");
              document.getElementById("2ndcheckbox").checked=false;
          }




          }
  });
}