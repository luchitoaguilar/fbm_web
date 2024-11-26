<?php

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

use App\Models\Banner;
use App\Models\Noticia;
use App\Models\Producto;
use App\Models\Vehiculo;
use App\Models\Video;
use App\Models\Zafra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Error\Notice;

// URL::forceScheme('https');

Auth::routes();

/**
 * para que la tabla salga en espanol
 */
Route::get('traduccion-de-la-tabla', [App\Http\Controllers\ApiController::class, 'getTraduccionTabla'])->name('api.getTraduccionTabla');

/************************************ LOGIN *****************/
Route::get('/', function () {
    if (Auth::check())
        return view('modules.Inicio.view');
    else
        return redirect(route('login'));
})->name('home');

Route::post('cerrar-sesion', [
    'uses'  => 'Auth\LoginController@logout',
    'as'    => 'auth.logout'
]);

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    $banner = Banner::where('estado', 1)
        ->orderBy('id', 'asc')
        ->get();
    $producto = Producto::where('estado', 1)
        ->orderBy('id', 'asc')
        ->get();
    $noticia = Noticia::where('estado', 1)
        ->orderBy('id', 'asc')
        ->get();
    $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');
    return view('home', compact('banner', 'producto', 'noticia', 'zafra'));
})->name('inicio');

/****************************** */
/*     Dashboard                */
/****************************** */
Route::group(['middleware' => []], function () {
    Route::get('/dashboard', function () {
        $banner = Banner::where('estado', 1)
            ->count();
        $producto = Producto::where('estado', 1)
            ->count();
        $video = Video::where('estado', 1)
        ->count();
        $noticia = Noticia::where('estado', 1)
        ->count();
        $vehiculo = Vehiculo::where('estado', 1)
        ->count();
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');
        return view('dashboard', compact('banner', 'producto', 'video', 'noticia', 'vehiculo', 'zafra'));
    })->name('dashboard');
});

/****************************** */
/*     Acerca de                */
/****************************** */
Route::get('mision', [App\Http\Controllers\AcercaController::class, 'mision'])->name('mision');
Route::get('vision', [App\Http\Controllers\AcercaController::class, 'vision'])->name('vision');
Route::get('objetivos', [App\Http\Controllers\AcercaController::class, 'objetivos'])->name('objetivos');

/****************************** */
/*     Contacto                */
/****************************** */
Route::get('contacto', [App\Http\Controllers\ContactoController::class, 'view'])->name('contacto');
Route::post('contacto', [App\Http\Controllers\ContactoController::class, 'store'])->name('guardar_contacto');

/****************************** */
/*     Requisitos                */
/****************************** */
Route::get('requisitos', [App\Http\Controllers\RequisitoController::class, 'view'])->name('requisitos');

/****************************** */
/*     Formularios                */
/****************************** */
Route::get('formularios', [App\Http\Controllers\FormularioController::class, 'view'])->name('formularios');

/****************************** */
/*     Productos                */
/****************************** */
Route::get('municion9', [App\Http\Controllers\ProductoController::class, 'municion9'])->name('municion9');
Route::get('armamento', [App\Http\Controllers\ProductoController::class, 'armamento'])->name('armamento');
Route::get('municion762', [App\Http\Controllers\ProductoController::class, 'municion762'])->name('municion762');
Route::get('primers', [App\Http\Controllers\ProductoController::class, 'primers'])->name('primers');
Route::get('puntas_plomo', [App\Http\Controllers\ProductoController::class, 'puntas_plomo'])->name('puntas_plomo');
Route::get('equipo_militar', [App\Http\Controllers\ProductoController::class, 'equipo_militar'])->name('equipo_militar');
Route::get('replicas', [App\Http\Controllers\ProductoController::class, 'replicas'])->name('replicas');
Route::get('otros', [App\Http\Controllers\ProductoController::class, 'otros'])->name('otros');

/****************************** */
/*     Banner                   */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('banner/listar', [App\Http\Controllers\BannerController::class, 'listar'])->name('listar_banner');
    Route::get('banner/create', [App\Http\Controllers\BannerController::class, 'create'])->name('crear_banner');
    Route::post('banner', [App\Http\Controllers\BannerController::class, 'storeBanner'])->name('guardar_banner');
    Route::get('banner/{id}/edit', [App\Http\Controllers\BannerController::class, 'edit'])->name('editar_banner');
    Route::put('banner/{id}', [App\Http\Controllers\BannerController::class, 'update'])->name('actualizar_banner');
    Route::delete('banner/{id}', [App\Http\Controllers\BannerController::class, 'destroy'])->name('eliminar_banner');
    Route::get('banner/{banner_id}', [App\Http\Controllers\BannerController::class, 'getBanner'])->name('buscar_banner');
});

/****************************** */
/*     Producto                   */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('producto/listar', [App\Http\Controllers\ProductoController::class, 'listar'])->name('listar_producto');
    Route::get('producto/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('crear_producto');
    Route::post('producto', [App\Http\Controllers\ProductoController::class, 'storeProducto'])->name('guardar_producto');
    Route::get('producto/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('editar_producto');
    Route::put('producto/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('actualizar_producto');
    Route::delete('producto/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('eliminar_producto');
    Route::get('producto/{producto_id}', [App\Http\Controllers\ProductoController::class, 'getProducto'])->name('buscar_producto');
});

/****************************** */
/*     Video                   */
/****************************** */

Route::get('videos/{id}', [App\Http\Controllers\VideoController::class, 'show'])->name('video_ver');
Route::get('videos', [App\Http\Controllers\VideoController::class, 'index'])->name('video');

Route::group(['middleware' => ['administrador']], function () {
    Route::get('video/listar', [App\Http\Controllers\VideoController::class, 'listar'])->name('listar_video');
    Route::get('video/create', [App\Http\Controllers\VideoController::class, 'create'])->name('crear_video');
    Route::post('video', [App\Http\Controllers\VideoController::class, 'storeVideo'])->name('guardar_video');
    Route::get('video/{id}/edit', [App\Http\Controllers\VideoController::class, 'edit'])->name('editar_video');
    Route::put('video/{id}', [App\Http\Controllers\VideoController::class, 'update'])->name('actualizar_video');
    Route::delete('video/{id}', [App\Http\Controllers\VideoController::class, 'destroy'])->name('eliminar_video');
    Route::get('video/{video_id}', [App\Http\Controllers\VideoController::class, 'getVideo'])->name('buscar_video');
    Route::get('video/{id}', [App\Http\Controllers\VideoController::class, 'mostrar'])->name('mostrar_video');
});

/****************************** */
/*     Noticia                   */
/****************************** */

Route::get('noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show'])->name('noticia_ver');
Route::get('noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticia');

Route::group(['middleware' => ['administrador']], function () {
    Route::get('noticia/listar', [App\Http\Controllers\NoticiaController::class, 'listar'])->name('listar_noticia');
    Route::get('noticia/create', [App\Http\Controllers\NoticiaController::class, 'create'])->name('crear_noticia');
    Route::post('noticia', [App\Http\Controllers\NoticiaController::class, 'storeNoticia'])->name('guardar_noticia');
    Route::get('noticia/{id}/edit', [App\Http\Controllers\NoticiaController::class, 'edit'])->name('editar_noticia');
    Route::put('noticia/{id}', [App\Http\Controllers\NoticiaController::class, 'update'])->name('actualizar_noticia');
    Route::delete('noticia/{id}', [App\Http\Controllers\NoticiaController::class, 'destroy'])->name('eliminar_noticia');
    Route::get('noticia/{noticia_id}', [App\Http\Controllers\NoticiaController::class, 'getNoticia'])->name('buscar_noticia');
    Route::get('noticia/{id}', [App\Http\Controllers\NoticiaController::class, 'mostrar'])->name('mostrar_noticia');
});


/****************************** */
/*     Zafra                   */
/****************************** */

Route::get('zafras/{id}', [App\Http\Controllers\ZafraController::class, 'show'])->name('zafra_ver');
Route::get('zafras', [App\Http\Controllers\ZafraController::class, 'index'])->name('zafra');

Route::group(['middleware' => ['administrador']], function () {
    Route::get('zafra/listar', [App\Http\Controllers\ZafraController::class, 'listar'])->name('listar_zafra');
    Route::get('zafra/getTotal', [App\Http\Controllers\ZafraController::class, 'getTotalZafra'])->name('get_total');
    Route::get('zafra/create', [App\Http\Controllers\ZafraController::class, 'create'])->name('crear_zafra');
    Route::post('zafra', [App\Http\Controllers\ZafraController::class, 'storeZafra'])->name('guardar_zafra');
    Route::get('zafra/{id}/edit', [App\Http\Controllers\ZafraController::class, 'edit'])->name('editar_zafra');
    Route::put('zafra/{id}', [App\Http\Controllers\ZafraController::class, 'update'])->name('actualizar_zafra');
    Route::post('personal-zafra', [App\Http\Controllers\ZafraController::class, 'personalZafra'])->name('personal_zafra');
    Route::delete('zafra/{id}', [App\Http\Controllers\ZafraController::class, 'destroy'])->name('eliminar_zafra');
    Route::get('zafra/{zafra_id}', [App\Http\Controllers\ZafraController::class, 'getZafra'])->name('buscar_zafra');
    Route::get('zafra/{id}', [App\Http\Controllers\ZafraController::class, 'mostrar'])->name('mostrar_zafra');
});


/************************************ Tipo Producto *****************/
Route::group(['prefix' => 'Busquedas'], function () {
    Route::get('/listar', [App\Http\Controllers\TipoProductoController::class, 'listar'])->name('lista_tipoProducto');
    Route::get('/ciudad', [App\Http\Controllers\CiudadController::class, 'listar'])->name('lista_ciudadVenta');
});


/****************************** */
/*     Persona                  */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('persona/listar', [App\Http\Controllers\PersonaController::class, 'personas'])->name('listar_persona');
    Route::get('personas', [App\Http\Controllers\PersonaController::class, 'listar'])->name('personas');
    Route::get('persona/create', [App\Http\Controllers\PersonaController::class, 'create'])->name('crear_persona');
    Route::post('persona', [App\Http\Controllers\PersonaController::class, 'storePersona'])->name('guardar_persona');
    Route::get('persona/{id}/edit', [App\Http\Controllers\PersonaController::class, 'edit'])->name('editar_persona');
    Route::put('persona/{id}', [App\Http\Controllers\PersonaController::class, 'update'])->name('actualizar_persona');
    Route::delete('persona/{id}', [App\Http\Controllers\PersonaController::class, 'destroy'])->name('eliminar_persona');
    Route::post('persona/activar/{id}', [App\Http\Controllers\PersonaController::class, 'activate'])->name('activar_persona');
    Route::get('persona/{persona_id}', [App\Http\Controllers\PersonaController::class, 'getPersona'])->name('buscar_persona');
});

/****************************** */
/*     Zafrero                  */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('zafrero/listar', [App\Http\Controllers\ZafreroController::class, 'zafreros'])->name('listar_zafrero');
    Route::get('zafreros', [App\Http\Controllers\ZafreroController::class, 'listar'])->name('zafreros');
    Route::get('zafrero/create', [App\Http\Controllers\ZafreroController::class, 'create'])->name('crear_zafrero');
    Route::post('zafrero', [App\Http\Controllers\ZafreroController::class, 'storeZafrero'])->name('guardar_zafrero');
    Route::get('zafrero/{id}/edit', [App\Http\Controllers\ZafreroController::class, 'edit'])->name('editar_zafrero');
    Route::put('zafrero/{id}', [App\Http\Controllers\ZafreroController::class, 'update'])->name('actualizar_zafrero');
    Route::delete('zafrero/{id}', [App\Http\Controllers\ZafreroController::class, 'destroy'])->name('eliminar_zafrero');
    Route::post('zafrero/activar/{id}', [App\Http\Controllers\ZafreroController::class, 'activate'])->name('activar_zafrero');
    Route::get('zafrero/{zafrero_id}', [App\Http\Controllers\ZafreroController::class, 'getZafrero'])->name('buscar_zafrero');
});

/****************************** */
/*     Vehiculo                  */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('vehiculo/get', [App\Http\Controllers\VehiculoController::class, 'getVehiculos'])->name('get_vehiculo');
    Route::get('vehiculo/listar', [App\Http\Controllers\VehiculoController::class, 'listar'])->name('listar_vehiculo');
    Route::get('vehiculo/create', [App\Http\Controllers\VehiculoController::class, 'create'])->name('crear_vehiculo');
    Route::post('vehiculo', [App\Http\Controllers\VehiculoController::class, 'storevehiculo'])->name('guardar_vehiculo');
    Route::get('vehiculo/{id}/edit', [App\Http\Controllers\VehiculoController::class, 'edit'])->name('editar_vehiculo');
    Route::put('vehiculo/{id}', [App\Http\Controllers\VehiculoController::class, 'update'])->name('actualizar_vehiculo');
    Route::delete('vehiculo/{id}', [App\Http\Controllers\VehiculoController::class, 'destroy'])->name('eliminar_vehiculo');
    Route::get('vehiculo/{vehiculo_id}', [App\Http\Controllers\VehiculoController::class, 'getvehiculo'])->name('buscar_vehiculo');
});


/****************************** */
/*     Ciudad                  */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('ciudad/listar', [App\Http\Controllers\CiudadController::class, 'listar'])->name('listar_ciudad');
});

/****************************** */
/*     Expedido                  */
/****************************** */

Route::group(['middleware' => ['administrador']], function () {
    Route::get('expedido/listar', [App\Http\Controllers\ExpedidoController::class, 'listar'])->name('listar_expedido');
});

/****************************** */
/*     Reportes                  */
/****************************** */
Route::group(['prefix' => 'reportes', 'middleware' => 'administrador'], function () {
    Route::get('reportes', [App\Http\Controllers\ReporteController::class, 'index'])->name('reportes');
    Route::get('reportes-zafrero', [App\Http\Controllers\ReporteController::class, 'indexZafrero'])->name('reportes_zafrero');
    /**
     * para imprimir reporte diario
     */
    Route::post('imprimir-reporteDiario', [App\Http\Controllers\ReporteController::class, 'reporteDiario'])->name('imprimir_reporte_diario');
/**
     * para imprimir reporte diario zafrero
     */
    Route::post('imprimir-reporteDiarioZafrero', [App\Http\Controllers\ReporteController::class, 'reporteDiarioZafrero'])->name('imprimir_reporte_diario_zafrero');
});

/****************************** */
/*     Variables                  */
/****************************** */
Route::group(['prefix' => 'variables', 'middleware' => 'administrador'], function () {
    Route::get('variables', [App\Http\Controllers\VariablesController::class, 'index'])->name('variables');
    Route::get('variables/listar', [App\Http\Controllers\VariablesController::class, 'getZafra'])->name('listar_variables');
    Route::post('variables', [App\Http\Controllers\VariablesController::class, 'store'])->name('guardar_variables');
});
/****************************************** DASHBOARD *********************************/
Route::group(['prefix' => 'Dashboard'], function () {

    Route::get('lista-usuarios', [
        'uses' => 'DashboardController@getListDataTableUsuario',
        'as' => 'dashboard.getListDataTableUsuario'
    ]);

    Route::get('listar-tipo-contrato', [
        'uses' => 'DashboardController@getListTipoContrato',
        'as' => 'dashboard.getListTipoContrato'
    ]);
});
