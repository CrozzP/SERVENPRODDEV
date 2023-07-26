$(document).ready(function(){ 

     
$('#copy2').click(
function copy_address(){ 
            //document.getElementById('id').value= document.getElementById('ids').value;
            document.getElementById('dni').value= document.getElementById('dnis').value;
            document.getElementById('name').value= document.getElementById('nombres').value;
			document.getElementById('pat_name').value= document.getElementById('apell_pats').value;
            document.getElementById('mat_name').value= document.getElementById('apell_mats').value;
			document.getElementById('address').value= document.getElementById('direccions').value;
			
        }// Separamos las dos funciones con una coma


  );

$("#button").click(function(){
        $("#div1").load('http://localhost/persona/create');
    });


$("#xdd").click(function(){
        $("#div1").load('http://localhost/persona');
    });



});




/*
$(document).ready(function(){
	Carga();
});

function Carga(){

	var tablaDatos = $("#datos");
	var route = "http://localhost:8000/usuarios";

*/
