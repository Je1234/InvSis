<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('ini')->middleware('auth');
//Redireccionamiento a vista index categorias
Route::get('/Compras', 'CompraController@index')->name('compras');
//Recursos para CRUD productos
Route::resource('compra','CompraController');

//Redireccionamiento a vista index categorias
Route::get('/Categorias', 'CategoriaController@index')->name('categorias');
//Recursos para CRUD productos
Route::resource('categoria','CategoriaController');

//Redireccionamiento a vista index productos
Route::get('/Productos', 'ProductoController@index')->name('productos');
//Recursos para CRUD productos
Route::resource('producto','ProductoController');

//Redireccionamiento a vista index productos
Route::get('/Clientes', 'ClienteController@index')->name('clientes');
//Recursos para CRUD productos
Route::resource('cliente','ClienteController');

//Redireccionamiento a vista index proveedores
Route::get('/Proveedores', 'ProveedorController@index')->name('proveedor');


//Recursos para CRUD productos
Route::resource('proveedor','ProveedorController');

//Redireccionamiento a vista index ventas
Route::get('/Ventas','VentaController@index')->name('venta');
//Recursos para CRUD ventas
Route::resource('venta','VentaController');

Route::post('/AgregarCliente','VentaController@storeCliente')->name('clienteD');

Route::post('/AgregarProveedor','CompraController@storeProveedor')->name('ProveedorC');

Route::post('/AgregarProducto','CompraController@storeProducto')->name('ProductoC');

Route::get('/descargarPDFcompra/{id}','CompraController@descargaPDF')->name('PdfCompra');

Route::get('/descargarPDFventa/{id}','VentaController@descargaPDF')->name('PdfVenta');

Route::get('/descargarExcelventa','VentaController@descargaExcel')->name('ExcelVenta');

Route::get('/descargarExcelcompra','CompraController@descargaExcel')->name('ExcelCompra');

Route::get('/NuevoUsuario','HomeController@ReUsuario')->name('ReUsuario')->middleware('role:admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Permisos', 'HomeController@RolesYperm')->name('Permisos')->middleware('role:admin');

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
