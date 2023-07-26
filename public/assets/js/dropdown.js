
$("#typeExtraordinary_id").change(function(event){
	$.get("/extraordinary/create/"+event.target.value+"",function(response,typeExtraordinary_id){
		console.log(response);
		$("#obsTypeExtraordinary_id").empty();
		for(i=0;i<response.length;i++){
			$("#obsTypeExtraordinary_id").append("<option value='"+response[i].id+"'>"+response[i].description+"</option>");
		}

		

	});
});
/*

$("#tipoextraordinario_id").change(function(event){
	$.get("/extraordinario/create/"+event.target.value+"",function(response,tipoextraordinario_id){
		console.log(response);
		$("#obsTipoEx_id").empty();
		for(i=0;i<response.length;i++){
			$("#obsTipoEx_id").append("<option value='"+response[i].id+"'>"+response[i].descripcionobs+"</option>");
		}

		

	});
});

*/