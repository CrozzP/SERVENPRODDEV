$(document).ready(function(){ 

     
$('#copy').click(
function copy_address(){ 
            //document.getElementById('id').value= document.getElementById('ids').value;
            document.getElementById('persons_dni_id').value= document.getElementById('dni').value;
            document.getElementById('supply_id').value= document.getElementById('codigoSupply').value;
			document.getElementById('addresss').value= document.getElementById('direccions').value;
			document.getElementById('route').value= document.getElementById('codeRutaSupply').value;
			//document.getElementById('nombre').value= document.getElementById('nombres').value;
			
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
