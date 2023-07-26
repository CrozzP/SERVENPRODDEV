<?php

use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;

use App\Events\Hello;
use App\Events\PrivateTest;

Route::get('/app/broadcast',function(){

    broadcast(new Hello());
    return "dentro de broadcast";
});

Route::get('/app/broadcastPrivate',function(){
    $user = App\User::find(1);
    broadcast(new PrivateTest($user));
    return "Event has been sent!";
});



//DIOMIO
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::group(['middleware' => ['auth'], 'as' => 'backoffice.'], function(){
/*
	Route::get('admin','AdminController@show')->name('admin.show');
	Route::resource('user','UserController');
	Route::get('user_import','UserController@import')->name('user.import');;
	Route::post('user_make_import','UserController@make_import')->name('user.make_import');
	Route::get('user/{user}/assign_role','UserController@assign_role')->name('user.assign_role');
	Route::post('user/{user}/role_assignment','UserController@role_assignment')->name('user.role_assignment');
	Route::get('user/{user}/assign_permission','UserController@assign_permission')->name('user.assign_permission');
	Route::post('user/{user}/permission_assignment','UserController@permission_assignment')->name('user.permission_assignment');
	Route::resource('role','RoleController');
	Route::resource('permission','PermissionController');

});*/
/*
Route::get('/', function(){
	return view('welcome');
});
*/

Route::get('/test',function(){
	return 'Usuario con permiso';
})->middleware('role:administrador-coordinador');

//Route::get('/register/verify/{code}', 'GuestController@verify');
Route::get('/correoSuministro/confirmar/{code}', 'CorreoSuministroController@confCorreoSuministro');

/*
Route::get('/home',function(){
	return view('home');
})->middleware('auth');*/

Auth::routes();
//Auth::routes(['register' => false]);

  /*  'admin_role' => env('ADMIN_ROLE', 'admin'),
    'coord_role' => env('COORD_ROLE', 'coord'),
    'auxil_role' => env('AUXIL_ROLE', 'auxil'),
    'logis_role' => env('LOGIS_ROLE', 'logis'),
    'modul_role' => env('MODUL_ROLE', 'modul'),
    'jefesupervisor_role' => env('JESUP_ROLE', 'jesup'),
     'supervisor_role' => env('SUPER_ROLE', 'supervisor'),
    */

//Route::prefix('app')->middleware([AdminCheck::class])->group(function(){
//Route::prefix('back/app')->group(function(){
//Route::prefix('back/app')->middleware(['auth','role:'.config('app.admin_role').'-'.config('app.modul_role')])->group(function(){





Route::prefix('back/app')->middleware(['auth','role:'.config('app.admin_role').'-'.config('app.administrar_role').'-'.config('app.serven_role')])->group( function(){

	Route::group(['middleware' => 'role:'.config('app.admin_role')], function(){
        //Route::get('user', 'AuthController@user');
        //Route::post('logout', 'AuthController@logout');
    });
	Route::get('/adminshow', 'AdminController@show')->name('admin.show');

	Route::resource('user','UserController');
	Route::resource('role','RoleController');
	Route::resource('permission','PermissionController');
	Route::resource('persona','PersonaController');

	Route::get('personaBuscar','PersonaController@personaBuscar');

	Route::get('buscarPersonaExtraordinario/{persona}', 'PersonaController@buscarPersonaExtraordinario');
	
	Route::post('user_make_import','UserController@make_import')->name('user.make_import');
	Route::get('user/{user}/assign_role','UserController@assign_role')->name('user.assign_role');
	Route::post('user/{user}/role_assignment','UserController@role_assignment')->name('user.role_assignment');
	Route::get('user/{user}/assign_permission','UserController@assign_permission')->name('user.assign_permission');
	Route::post('user/{user}/permission_assignment','UserController@permission_assignment')->name('user.permission_assignment');
	Route::get("getShowUser", "UserController@getShowUser");
   Route::get('userEst','UserController@userEst');

	Route::get('getDepartamento', 'PersonaController@getDepartamento');
	Route::get('getProvincia', 'PersonaController@getProvincia');
	Route::get('getDistrito', 'PersonaController@getDistrito');


	Route::resource('extraordinario','ExtraordinarioController');
	Route::get('extraordinarioBuscar','ExtraordinarioController@extraordinarioBuscar');
	Route::post('storeEstadoExtraordinario','ExtraordinarioController@storeEstadoExtraordinario');

	Route::resource('atencion','AtencionController');
	Route::resource('tipoatencion','TipoAtencionController');

	Route::get("/estadisticaAtencion", "AtencionController@Chartjs");
	
	

	


	Route::resource('suministro','SuministroController');
	Route::get('suministroBuscar','SuministroController@suministroBuscar');
	


	Route::get('getTipoExtraordinario', 'ExtraordinarioController@getTipoExtraordinario');
	Route::get('getObsTipoExtraordinario', 'ExtraordinarioController@getObsTipoExtraordinario');

	Route::get('getPersonaID', 'PersonaController@getPersonaID');

	Route::get('getExtraordinarioR', 'ExtraordinarioController@getExtraordinarioR');

	Route::get('generate-pdf/{id}','ExtraordinarioController@createPDF');
	Route::post('pdftest','ExtraordinarioController@pdftest');
   Route::post('detalleAtencion','ExtraordinarioController@detalleAtencion');




   Route::get('getMailExtraordinario','ExtraordinarioController@getMailExtraordinario');
   Route::get('getMailReporteExtraordinario','ExtraordinarioController@getMailReporteExtraordinario');
	Route::get('getMailExtraordinarioFiltro','ExtraordinarioController@getMailExtraordinarioFiltro');
	Route::get('getExcelExtraordinario','ExtraordinarioController@getExcelExtraordinario');
   Route::get('getDataSedes','ExtraordinarioController@getDataSedes');

   Route::post('reportePdfAtencionB','ExtraordinarioController@reportePdfAtencionB');
   
   Route::post('confirmarAtencion','ExtraordinarioController@confirmarAtencion');

	//********************************************************************************/


	Route::post('importAtencionExtraordinario','AtencionExtraordinarioController@importAtencionExtraordinario');
	Route::post('subirAtencionExtraordinario','AtencionExtraordinarioController@subirAtencionExtraordinario');


	/*********************************************/

	Route::resource('correo','CorreoController');
	Route::get('correoHabilitar','CorreoController@correoHabilitar');
	
	Route::post('correoSedes/{correo}','CorreoController@correoSedes');
	Route::get('sedesCorreo','CorreoController@sedesCorreo');
	
	Route::resource('sede','SedeController');
	Route::get('getSedeFiltro', 'SedeController@getSedeFiltro');
	Route::get('getSedes', 'SedeController@getSedes');
	Route::get('getSedeEmpresa', 'SedeController@getSedeEmpresa');
	Route::get('sedeHabilitar', 'SedeController@sedeHabilitar');
	Route::get('empresaSede', 'SedeController@empresaSede');
	Route::post('sedeEmpresas/{sede}','SedeController@sedeEmpresas');
	
	Route::resource('provincia','ProvinciaController');
   
   Route::resource('distrito','DistritoController');
   Route::resource('ccpp','CentroPobladoController');



   Route::resource('empresa','EmpresaController');

	Route::get('getSede', 'EmpresaController@getSede');
	Route::get('empresaHabilitar', 'EmpresaController@empresaHabilitar');
	Route::get('sedeEmpresa', 'EmpresaController@sedeEmpresa');
	Route::get('getEmpresaSede', 'EmpresaController@getEmpresaSede');
	Route::post('empresaSedes/{empresa}','EmpresaController@empresaSedes');
	
	

	Route::put('user/change_password/{id}','UserController@change_password');
	Route::get('usuarioFiltrar','UserController@usuarioFiltrar');

	Route::resource('relacion','RelacionController');
	Route::resource('tipodocumento','TipoDocumentoController');

   //Route::resource('correoSuministro','CorreoSuministroController');
   Route::post('regCorreoSuministro','CorreoSuministroController@regCorreoSuministro');
   Route::get('getCorreoSuministro','CorreoSuministroController@getCorreoSuministro');
   Route::get('editCorreoSuministro','CorreoSuministroController@editCorreoSuministro');
   Route::post('formatPdf','CorreoSuministroController@formatPdf');
   Route::post('cargarAutorizacion','CorreoSuministroController@cargarAutorizacion');
   Route::post('getValidarManual','CorreoSuministroController@getValidarManual');
   Route::get('correoSuministroBuscar','CorreoSuministroController@correoSuministroBuscar');
   Route::get('getCorreoSuministroExport','CorreoSuministroController@getCorreoSuministroExport');
   Route::get('getGrafico','CorreoSuministroController@getGrafico');

   Route::resource('evento','EventoController');
   Route::get('getEvento','EventoController@getEvento');
   Route::post('regEvento','EventoController@regEvento');


   Route::get('descargarContenido/{id}','ContenidoEventoController@descargarContenido');
   Route::resource('organo','OrganoController');

   Route::resource('unidadorganica','UnidadOrganicaController');
   Route::get('getUnidadesOrganicas','UnidadOrganicaController@getUnidadesOrganicas');

   Route::resource('oficina','OficinaController');
   Route::get('getOficinas','OficinaController@getOficinas');


   Route::post('cargarArchivoExcel','EstadoExtraordinarioController@cargarArchivoExcel');
   Route::get('getExcelRegistroAtencion','EstadoExtraordinarioController@getExcelRegistroAtencion');
   
   Route::get('getMailRegistroExtraordinarioFiltro','EstadoExtraordinarioController@getMailRegistroExtraordinarioFiltro');




});

//service



Route::prefix('service/app')->middleware(['auth','role:'.config('app.admin_role').'-'.config('app.service_role')])->group( function(){

	//Route::resource('extraordinario','ExtraordinarioController');
	Route::get('serviceExtraordinario','ExtraordinarioController@serviceExtraordinario');
	Route::post('serviceExtraordinarioMasivo','ExtraordinarioController@serviceExtraordinarioMasivo');
	Route::get('serviceExtraordinarioBuscar','ExtraordinarioController@serviceExtraordinarioBuscar');

	Route::resource('empresaColaborador','EmpresaColaboradorController');
	Route::get('empresaColaboradores','EmpresaColaboradorController@empresaColaboradores');


	Route::post('serviceExtraordinarioAsignar','EmpresaColaboradorController@serviceExtraordinarioAsignar');
	Route::put('serviceEditExtraordinarioAsignar','EmpresaColaboradorController@serviceEditExtraordinarioAsignar');

	Route::resource('derivarRegistro','DerivarRegistroController');
	Route::get('tecnicoRegistro','DerivarRegistroController@tecnicoRegistro');
	Route::put('aceptarExtraordinario/{id}','DerivarRegistroController@aceptarExtraordinario');

	Route::get('subirAtencionExtraordinario','DerivarRegistroController@subirAtencionExtraordinario');

	

	Route::post('registrarAtencionDR','AtencionDerivarRegistroController@registrarAtencionDR');


	Route::post('reportePdfAtencion','AtencionDerivarRegistroController@reportePdfAtencion');
	

});



/////////


Route::prefix('front/app')->middleware(['auth','role:'.config('app.administrar_role').'-'.config('app.admin_role')])->group(function(){
	
	//Route::get('/prueba', 'UserController@getPrueba');
	Route::get('profile','UserController@profile')->name('user.profile');
	Route::get('profile/{user}/edit','UserController@edit')->name('user.edit');
	Route::put('profile/{user}/update','UserController@update')->name('user.update');
	
	Route::get('profile/edit_password','UserController@edit_password')->name('user.edit_password');
	Route::put('profile/change_password','UserController@change_password')->name('user.change_password');

	Route::get('getSuministro','SuministroController@getSuministro');

	Route::resource('relacion','RelacionController');

	Route::get('getTipoRegistro','ExtraordinarioController@getTipoRegistro');

	Route::get('getObsTipoExtraordinario','ExtraordinarioController@getObsTipoExtraordinario');

	Route::resource('lugarPago','LugarPagoController');
	

	Route::resource('orientacion','OrientacionController');

	
});


Route::prefix('registro/app')->group(function(){
	
	//Route::get('/prueba', 'UserController@getPrueba');
	//Route::get('profile','UserController@profile')->name('user.profile');

	Route::get('getDepartamento', 'PersonaController@getDepartamento');
	Route::get('getProvincia', 'PersonaController@getProvincia');
	Route::get('getDistrito', 'PersonaController@getDistrito');

	////Route::resource('estudiante','EstudianteController');
	////Route::get('getAula', 'EstudianteController@getAula');
	////Route::get('getColegio', 'EstudianteController@getColegio');
	////Route::get('getArea', 'AulaController@getArea');
	////Route::get('getSede', 'AulaController@getSede');
	////Route::get('getLocal', 'AulaController@getLocal');
	////Route::get('getTurno', 'AulaController@getTurno');
	////Route::get('getTipoPago', 'EstudianteController@getTipoPago');
	////Route::get('getTipoDescuento', 'EstudianteController@getTipoDescuento');
	////Route::get('getTipoApoderado', 'EstudianteController@getTipoApoderado');
	////Route::get('getDescuento', 'EstudianteController@getDescuento');
	////Route::post('postDescuento', 'EstudianteController@postDescuento');
	////Route::get('getEstudianteID', 'EstudianteController@getEstudianteID');
	////Route::post('createPersonaEst', 'EstudianteController@createPersonaEst');
	
	
});




Route::prefix('rer/app')->middleware(['auth','role:'.config('app.admin_role').'-'.config('app.servenrer_role')])->group(function(){

	Route::resource('suministrorer','SuministroRerController');
	Route::resource('suministroreratencion','SuministroRerAtencionController');
	Route::get('suministrorerBuscar','SuministroRerController@suministrorerBuscar');

	Route::get('buscarComprobante', 'ComprobanteController@buscarComprobante');

	Route::get('generate-rerpdf/{id}','ComprobanteController@createPDFRER');

   Route::get('userEst','UserController@userEst');

   Route::post('provincia/getProvincia', 'ProvinciaController@getProvincia');
   Route::post('distrito/getDistrito', 'DistritoController@getDistrito');
   Route::post('ccpp/getCentroPoblado', 'CentroPobladoController@getCentroPoblado');

   Route::post('reporte-rerpdf','ComprobanteController@reportePDFRER');

});


//REPOSITORIO



Route::prefix('repositorio/app')->middleware(['auth','role:'.config('app.admin_role').'-'.config('app.repositorio_role')])->group( function(){

   Route::resource('/files', 'FilesController', [ 'except' => [ 'create', 'edit', 'update' ] ]);

   Route::get('userEst','UserController@userEst');

	Route::resource('tarea','TareaController');
	Route::get('tareasReportesAsignados','TareaController@tareasReportesAsignados');
   Route::get('tareasReportesAsignadosFiltro','TareaController@tareasReportesAsignadosFiltro');
	Route::resource('reporte','ReporteController');

	Route::get('tareasReporte','ReporteController@tareasReporte');
	Route::get('getReporteTarea', 'ReporteController@getReporteTarea');

	Route::post('tareaReportes/{reporte}','ReporteController@tareaReportes');
   Route::get('regReporte','ReporteController@regReporte');
   Route::put('editRegReporte/{id}','ReporteController@editRegReporte');
   Route::delete('deleteReporte/{id}','ReporteController@deleteReporte');

	Route::get('listColaborador','ColaboradorController@listColaborador');

   Route::get('empColaborador','EmpresaColaboradorController@empColaborador');
	Route::get('tareaReporte','TareaController@tareaReporte');
   Route::get('estadoTareas','TareaController@estadoTareas');
   Route::get('getMailNotificacion','TareaController@getMailNotificacion');
   Route::post('getMailReporte','TareaController@getMailReporte');
   Route::get('regTarea','TareaController@regTarea');
   Route::put('editRegTarea/{id}','TareaController@editRegTarea');
   Route::delete('deleteTareas/{id}','TareaController@deleteTareas');

   Route::post('getNotification','TareaController@getNotification');
   Route::post('getSolicitudNotification','TareaController@getSolicitudNotification');
   Route::post('getCancelarSolicitudNotification','TareaController@getCancelarSolicitudNotification');
   Route::post('getDerivarNotification','TareaController@getDerivarNotification');


   Route::post('getMailEjecutado','TareaController@getMailEjecutado');


	Route::resource('tareaReporteColaborador','TareaReporteColaboradorController');
	Route::post('asignarTarRepCol','TareaReporteColaboradorController@asignarTarRepCol');
   Route::post('derivarRegistro','TareaReporteColaboradorController@derivarRegistro');
   Route::post('solicitarAmpliacion','TareaReporteColaboradorController@solicitarAmpliacion');
	Route::get('ResultadoRepAsig','TareaReporteColaboradorController@ResultadoRepAsig');
	Route::delete('EliminarRepAsig/{id}','TareaReporteColaboradorController@EliminarRepAsig');
   Route::post('solicitaCancelarAmpliacion','TareaReporteColaboradorController@solicitaCancelarAmpliacion');


	Route::post('regDocumento','DocumentoController@regDocumento');
	Route::get('documentoReporte','DocumentoController@documentoReporte');
	Route::post('getHabilitar','DocumentoController@getHabilitar');
	//Route::get('descargarArchivo','DocumentoController@descargarArchivo');
	Route::get('descargarArchivo/{id}','DocumentoController@descargarArchivo');
	Route::delete('eliminarArchivo/{id}','DocumentoController@eliminarArchivo');

	Route::get('listaPeriodos','PeriodoController@listaPeriodos');

   Route::get('getsolicitudes','SolicitudController@getsolicitudes');
   Route::get('getsolicitudesFiltro','SolicitudController@getsolicitudesFiltro');

   Route::post('aceptarSolicitud','SolicitudController@aceptarSolicitud');
   Route::post('denegarSolicitud','SolicitudController@denegarSolicitud');

   Route::post('regInformacion','InformacionController@regInformacion');
   Route::get('getInformacionReportes','InformacionController@getInformacionReportes');

   Route::get('getObsDerivado','MotivoController@getObsDerivado');

   Route::get('getTipoInformacion','TipoInformacionController@getTipoInformacion');
   

   Route::post('import','TestImportController@import');
   Route::post('import-insert-update','TestImportController@importInsertUpdate');
   Route::post('cargarArchivoExcel','TestImportController@cargarArchivoExcel');

   //Route::post('/import-insert-update', [MovieController::class, 'importInsertUpdate']); 



   //Route::post('/import',                      [TestImportController::class, 'import']); 
  // Route::get('/export',                       [TestImportController::class, 'export']);
   


});



//'jefesupervisor_role' => env('JESUP_ROLE', 'jesup'),

Route::any('back/{slug}', function(){
	return view('welcome3');
//})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.modul_role'));
})->where('slug', '.*')->middleware('auth','role:'.config('app.admin_role').'-'.config('app.serven_role').'-'.config('app.administrar_role'));


Route::any('service/{slug}', function(){
	return view('service');
//})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.modul_role'));
})->where('slug', '.*')->middleware('auth','role:'.config('app.admin_role').'-'.config('app.service_role'));

//})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.jefesupervisor_role').'-'.config('app.modul_role'));
//})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.coord_role'));
/*
Route::any('front/{slug}', function(){
	return view('frontoffice.frontOffice');
})->where('slug', '.*')->middleware('role:'.config('app.coord_role').'-'.config('app.admin_role'));
*/

Route::any('front/{slug}', function(){
	return view('front');
})->where('slug', '.*')->middleware('auth','role:'.config('app.admin_role').'-'.config('app.administrar_role'));


Route::any('rer/{slug}', function(){
	return view('rer');
//})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.modul_role'));
})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.servenrer_role'));



Route::any('registro/{slug}', function(){
	return view('registro');
})->where('slug', '.*');


Route::any('repositorio/{slug}', function(){
	return view('repositorio');
//})->where('slug', '.*')->middleware('role:'.config('app.admin_role').'-'.config('app.modul_role'));
})->where('slug', '.*')->middleware('auth','role:'.config('app.admin_role').'-'.config('app.repositorio_role'));



//})->where('slug', '.*');
/*
Route::group(['middleware' => 'role:'.config('app.admin_role')], function(){
        //Route::get('user', 'AuthController@user');
        //Route::post('logout', 'AuthController@logout');
		//Route::get('/adminshow', 'AdminController@show')->name('admin.show');
		Route::any('back/{slug}', function(){
			return view('welcome4');
		})->where('slug', '.*');
    });
*/

/*
Route::get('vue/{slug}', function () {
 return view('welcome4');
})->where('slug', '[\/\w\.-]*');
*/

//Route::get('/backs/user/{user}/assign_role','UserController@welcome6');

/*
Route::get('/backs/welcome5/xd', function () {
    return view('welcome5');
});
*/


/*
Route::get('/logout', 'AdminController@logout');
Route::get('/', 'AdminController@index');
Route::any('{slug}', 'AdminController@index');*/

/*
Route::get('/sd', function () {
    return view('welcome');
});*/

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
/*
Route::get('/users','UserController@index');
Route::get('/list','UserController@list');

Route::get('search','PostController@index');
Route::get('res-search','PostController@search');*/
/*
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
*/
 

//Route::get('events','EventController@index');

/*
Route::any('{slug}', function(){
	return view('welcome3');
})->where('slug', '.*');*/

/*
Route::get('{any}', function () {
    return view('welcome3');
})->where('any', '.*');*/
	

