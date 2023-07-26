 var urlg = $(this).attr('origin');
 $("#registro").click(function(){
 	var dato=$("#dni").val();
 	var dato1=$("#id").val();
 	
 	var dato2=$("#name").val();
 	var dato3=$("#pat_name").val();
 	var dato4=$("#mat_name").val();
 	var dato5=$("#dob").val();
 	var dato6=$("#address").val();
 	var dato7=$("#sex").val();
 	var dato8=$("#phone").val();
 	  /*protected $fillable = 
  ['dni','id','nombre','apell_pat','apell_mat','edad','domicilio','sexo','celular',];*/
  //esto funciona cuando se loguea con la ip
 	//var route="http://192.168.236.216:8000/person";
  
  //  var route="http://localhost:8000/person";
  //  var route='http://'+window.location.hostname+':'+window.location.port+'/supply/extraordinary/person/create';
   var route= urlg+'/supply/extraordinary/person/create';
  // console.log(dato);
  // console.log(dato1);
  // console.log(dato2);
  // console.log(dato3);
  // console.log(dato4);
  // console.log(dato5);
  // console.log(dato6);
  // console.log(dato7);
  // console.log(dato8);

   //console.log(window.location.hostname);
   //console.log(route);
   //console.log(urlg);
  // console.log(window.location.port);
 	var token=$("#token").val();
 	//var token=$("input[token=_token]").val();
 	/*var dataSting=("dni="+dni,
 	//"id="+id,
 	"nombre="+nombre,
 	"apell_pat="+apell_pat,
 	"apell_mat="+apell_mat,
 	"edad="+edad,
 	"domicilio="+domicilio,
 	"sexo="+sexo,
 	"celular="+celular);*/



 	$.ajax({
 		url: route,
 		headers: {'X-CSRF-TOKEN': token},
 		type: 'post',
 		dataType: 'json',
 		data:
 		{
 			dni: dato,
 			id: dato1,
 			name: dato2,
 			pat_name: dato3,
 			mat_name: dato4,
 			dob: dato5,
 			address: dato6,
 			sex: dato7,
 			phone: dato8
 		},
 		success:function(){

 			$("#msj-success").fadeIn();
 		},

 		/*success:function(data){
 			if(data.succsess=='true'){
 				alert('inserto');
 			}
 		},*/
 		/*error:function(msj){
 			console.log(msj);
 			//console.log(msj.responseJSON.dni);

 		//	$("#msj").html(msj.responseJSON.dni);
 			//$("#msj-error").fadeIn();

 		error:function(data){
 			var errors = data.responseJSON;
 			console.log(errors);*/

 error: function(data)
            {
                var errors = '';
                console.log(data);
                for(datos in data.responseJSON.errors){
                    errors += data.responseJSON.errors[datos] + '<br>';
                }
                $('#msj-error').show().html(errors); //this is my div with messages
            


 			
			
				//console.log(data.responseJSON.nombre);
 			///$("#msj").html(data.responseJSON.dni);
 			//$("#msj").html(data.responseJSON.nombre);
 			///$("#msj-error").fadeIn();

 			
 		}
 	});
 });

//antrior
/*
	 $("#registro").click(function(){
 	var dato=$("#dni").val();
 	
 	var dato2=$("#nombre").val();
 	var dato3=$("#apell_pat").val();
 	var dato4=$("#apell_mat").val();
 	var dato5=$("#edad").val();
 	var dato6=$("#domicilio").val();
 	var dato7=$("#sexo").val();
 	var dato8=$("#celular").val();
 	  
 	var route="http://localhost:8000/person";
 	var token=$("#token").val();

 	$.ajax({
 		url: route,
 		headers: {'X-CSRF-TOKEN': token},
 		type: 'POST',
 		dataType: 'json',
 		data:{
 			dni: dato,
 			id: dato,
 			nombre: dato2,
 			apell_pat: dato3,
 			apell_mat: dato4,
 			edad: dato5,
 			domicilio: dato6,
 			sexo: dato7,
 			celular: dato8
 		},
 		success:function(){
 			$("#msj-success").fadeIn();
 		},
 		error:function(msj){
 			console.log(msj);

 			//$("#msj").html(msj.responseJSON.dni);
 			//$("#msj-error").fadeIn();

 				
 		}
 	});
 });
*/