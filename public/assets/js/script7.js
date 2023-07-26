/*$(document).ready(function(){
	//var campo = $('#pru').val();
//var url = "http://localhost:8000/personas"; 

	//if(campo === ''){
 //alert("El campo esta vacío");
 listmark();
//return false;
//}else{
	//$(location).attr('href',url);
 //Las validaciones que necesitas hacer
//}

       
    });*/

function listmark()
//var listmark = function()
  {
  	//var nombre = $(this).attr('href').split('nombre=')[1];
   // var pathname = window.location.pathname;
                //alert(pathname);
              //  alert(window.location);

      $.ajax({
          type:'get',
         // url:"http://192.168.236.216:8000/personas",
            //url:'http://'+window.location.hostname+':'+window.location.port+'/personas',
  
         // url:"http://localhost:8000/personas",
          url : $(this).attr("href"),
          

       //   url:pathname,
          //url : $(this).attr("href");
          success: function(data){
              $('#list-mark').empty().html(data);
          }
      });
  }

  $(document).on("click",".pagination li a",function(e) {
        e.preventDefault();

        var url = $(this).attr("href");

        $.ajax({
            type:'get',
            url:url,
            //url:"{{route('backoffice.person.edit')}}",
            success: function(data){
                $('#list-mark').empty().html(data);
            }
        });


    });
  urlg = $(this).attr("origin");
function Mostrar(id){
	//url=jQuery(location).attr('origin');
	//url = $(this).attr('origin');

	//var route = "http://localhost:8000/usuario/"+btn.value+"/edit";
	//var ui={{url('persona')}}/+id+"/edit";
	
	//var route = "http://localhost:8000/persona/"+id+"/edit";
	//var route = "http://electroseot.com.pe/person/"+id+"/edit";
	var route =urlg+"/person/"+id+"/edit";
	//var sd= +{{route('backoffice.person.edit')}};
	
	//var route = "http://192.168.236.216:8000/persona/"+id+"/edit";
	$.get(route, function(res){
		
		$("#id").val(res.id);
		$("#dni").val(res.dni);
		$("#name").val(res.name);
		$("#pat_name").val(res.pat_name);
		$("#mat_name").val(res.mat_name);
		$("#dob").val(res.dob);
		$("#address").val(res.address);
		$("#sex").val(res.sex);
		$("#phone").val(res.phone);
		//alert(id);
	});
	
}


$("#actualizar").click(function(){
alert(urlg);
	var value = $("#id").val();
	
	var dato1 = $("#dni").val();
	var dato2 = $("#name").val();
	var dato3 = $("#pat_name").val();
	var dato4 = $("#mat_name").val();
	var dato5 = $("#dob").val();
	var dato6 = $("#address").val();
	var dato7 = $("#sex").val();
	var dato8 = $("#phone").val();
	//var route = "http://electroseot.com.pe/person/"+value+"";
	var route = urlg+"/person/"+value+""
	//var route = "http://192.168.236.216:8000/persona/"+value+"";
	var token = $("#token").val();

	$.ajax({
		url: route,
		
		headers: {'X-CSRF-TOKEN': token},
		type: 'PATCH',
		dataType: 'json',
		data: {
			id: value,
			dni: dato1,
			name: dato2,
			pat_name: dato3,
			mat_name: dato4,
			dob: dato5,
			address: dato6,
			sex: dato7,
			phone: dato8

		},
		success: function(data){
			listmark();

			$("#myModal").modal('toggle');
			$("#msj-success").fadeIn();
		},


    
     error: function(data)
            {
                var errors = '';
                for(datos in data.responseJSON){
                    errors += data.responseJSON[datos] + '<br>';
                }
                $('#message-error').show().html(errors); //this is my div with messages
            if (data.status == 422) {
           console.clear();
        }


 			///console.log(data);
				//console.log(data.responseJSON.dni);
				//console.log(data.responseJSON.nombre);
 			///$("#msj").html(data.responseJSON.dni);
 			//$("#msj").html(data.responseJSON.nombre);
 			///$("#msj-error").fadeIn();

 			
 		}

	});
}


);
