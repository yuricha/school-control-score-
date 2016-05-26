<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//----------------------------//
//Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('nosotros/bienvenida', 'HomeController@bienvenida');
Route::get('nosotros/historia', 'HomeController@historia');
Route::get('nosotros/organigrama', 'HomeController@organigrama');
Route::get('nosotros/misionvision', 'HomeController@misionvision');
Route::get('nosotros/infraestructura', 'HomeController@infraestructura');
Route::get('nosotros/servicios', 'HomeController@servicios');

Route::get('niveles/inicial/bienvenida', 'HomeController@nivelinicialbienvenida');
Route::get('niveles/inicial/objetivos', 'HomeController@nivelinicialobjetivos');
Route::get('niveles/inicial/academica', 'HomeController@nivelinicialacademica');
Route::get('niveles/inicial/horario', 'HomeController@nivelinicialhorario');
Route::get('niveles/inicial/actividades', 'HomeController@nivelinicialactividades');

Route::get('niveles/primaria/bienvenida', 'HomeController@nivelprimariabienvenida');
Route::get('niveles/primaria/objetivos', 'HomeController@nivelprimariaobjetivos');
Route::get('niveles/primaria/academica', 'HomeController@nivelprimariaacademica');
Route::get('niveles/primaria/horario', 'HomeController@nivelprimariahorario');
Route::get('niveles/primaria/actividades', 'HomeController@nivelprimariaactividades');

Route::get('niveles/secundaria/bienvenida', 'HomeController@nivelisecundariabienvenida');
Route::get('niveles/secundaria/objetivos', 'HomeController@nivelsecundariaobjetivos');
Route::get('niveles/secundaria/academica', 'HomeController@nivelsecundariaacademica');
Route::get('niveles/secundaria/horario', 'HomeController@nivelisecundariahorario');
Route::get('niveles/secundaria/actividades', 'HomeController@nivelsecundariaactividades');

Route::get('admision/admisiondetail', 'HomeController@admisiondetail');
Route::get('admision/opcion', 'HomeController@opcion');

Route::get('multimedia/organizacion/municipio', 'HomeController@multimediamunicipio');
Route::get('multimedia/organizacion/policia', 'HomeController@multimediapolicia');
Route::get('multimedia/organizacion/ambiental', 'HomeController@multimediaambiental');
Route::get('multimedia/organizacion/comite', 'HomeController@multimediacomite');
Route::get('multimedia/organizacion/cruz', 'HomeController@multimediacruz');
Route::get('contacto', 'HomeController@contacto');
//---------------------------//
Route::any('/', 'HomeController@index');
Route::any('login', 'LoginController@index');
Route::any('styles', function(){ return View::make('ci.test_style'); });

Route::controller('users','UserController');

//------------------------------------------------------------------------------- Admin

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{

	Route::get('/', 'AdminProfileController@index');
    Route::controller('profile', 'AdminProfileController');

    Route::controller('rating', 'AdminRatingController');
    Route::get('ratings', 'AdminRatingController@index');

    Route::get('adminusers', 'AdminUserController@adminuser');
    Route::get('admincomments', 'AdminCommentController@index');
    Route::get('adminweb', 'AdminWebController@index');
    Route::controller('users', 'AdminUserController');
    Route::controller('comments', 'ApiCommentController');
    Route::controller('web', 'AdminWebController');
//----
    Route::controller('files', 'ApiFileController');

    /**/
});
Route::group(array('prefix' => 'user', 'before' => 'auth.user'), function()
{
    //Route::get('profile', 'AdminUserController@profile');
    Route::get('/', 'AdminProfileController@index');
    Route::controller('profile', 'AdminProfileController');
    Route::get('ratings', 'AdminRatingController@index');
    Route::controller('rating', 'AdminRatingController');
    Route::controller('users', 'AdminUserController');

    /*

    /**/
});
Route::group(array('prefix' => 'publisher', 'before' => 'auth.publisher'), function()
{
    Route::get('/', 'AdminProfileController@index');
    Route::controller('profile', 'AdminProfileController');
    Route::get('ratings', 'AdminRatingController@index');
    Route::controller('users', 'AdminUserController');
    Route::controller('rating', 'AdminRatingController');

    /**/
});

//------------------------------------------------------------------------------- API

Route::group(array('prefix' => 'api/v1','before' => 'auth.admin'), function() //con autenticación
{
    //Route::controller('comments', 'ApiCommentController');
    //Route::controller('files', 'ApiFileController');
    //Route::post('client/new', 'ApiClientController@newclient');

});
















