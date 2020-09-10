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
Route::get('/Categorias', 'CategoriaController@index')->name('categorias');
//Recursos para CRUD compras
Route::resource('categoria','CategoriaController');
//Redireccionamiento a vista index categorias
Route::get('/Compras', 'CompraController@index')->name('compras');
//Recursos para CRUD compras
Route::resource('compra','CompraController');

Route::get('/Compras', 'CompraController@index')->name('compras');
//Recursos para CRUD roles
Route::resource('compra','CompraController');

//Redireccionamiento a vista index categorias
Route::get('/RolesADMIN', 'RolesYUsersController@index')->name('roles');
//Recursos para CRUD productos
Route::resource('roles','RolesYUsersController');

//Redireccionamiento a vista index productos
Route::get('/Productos', 'ProductoController@index')->name('productos');
//Recursos para CRUD productos
Route::resource('producto','ProductoController');

//Redireccionamiento a vista index clientes
Route::get('/Clientes', 'ClienteController@index')->name('clientes');
//Recursos para CRUD clientes
Route::resource('cliente','ClienteController');

//Redireccionamiento a vista index proveedores
Route::get('/Proveedores', 'ProveedorController@index')->name('proveedor');

//Recursos para CRUD proveedores
Route::resource('proveedor','ProveedorController');

//Redireccionamiento a vista index ventas
Route::get('/Ventas','VentaController@index')->name('venta');
//Recursos para CRUD ventas
Route::resource('venta','VentaController');


//Ruta Agregar cliente en vista ventas
Route::post('/AgregarCliente','VentaController@storeCliente')->name('clienteD');

//Ruta Agregar proveedor en vista compras
Route::post('/AgregarProveedor','CompraController@storeProveedor')->name('ProveedorC');

//Ruta Agregar producto en vista compras
Route::post('/AgregarProducto','CompraController@storeProducto')->name('ProductoC');

//Ruta descargar PDF de compras
Route::get('/descargarPDFcompra/{id}','CompraController@descargaPDF')->name('PdfCompra');

//Ruta descargar PDF de ventas
Route::get('/descargarPDFventa/{id}','VentaController@descargaPDF')->name('PdfVenta');

//Ruta descargar excel de ventas
Route::get('/descargarExcelventa','VentaController@descargaExcel')->name('ExcelVenta');

//Ruta descargar excel de compras
Route::get('/descargarExcelcompra','CompraController@descargaExcel')->name('ExcelCompra');

//Redireccion nuevo usuario
Route::get('/NuevoUsuario','HomeController@ReUsuario')->name('ReUsuario')->middleware('role:admin');

//Eliminar usuario
Route::delete('/EliminarUsuario/{id}','RolesYUsersController@destroyUser')->name('Dusuario')->middleware('role:admin');


//Index Recuperar categorias
Route::get('/Recuperar categorias','CategoriaController@indexRecoveryCategoria')->name('IndexRcategoria');

//Recuperar categorias
Route::get('/RecuperarCategoria','CategoriaController@RecoveryCategoria')->name('Rcategoria');

//Recuperar todas las categorias
Route::get('/RecuperarTodoC','CategoriaController@RecoveryAllCategoria')->name('RAcategoria');

//Index Recuperar cliente
Route::get('/Recuperar clientes','ClienteController@indexRecoveryCliente')->name('IndexRcliente');

//Recuperar clientes
Route::get('/RecuperarCliente','ClienteController@RecoveryCliente')->name('Rcliente');

//Recuperar todas los clientes
Route::get('/RecuperarTodoCliente','ClienteController@RecoveryAllCliente')->name('RAcliente');

//Index Recuperar proveedores
Route::get('/Recuperar proveedores','ProveedorController@indexRecoveryProveedor')->name('IndexRproveedor');

//Recuperar proveedores
Route::get('/RecuperarProveedor','ProveedorController@RecoveryProveedor')->name('Rproveedor');

//Recuperar todas los proveedores
Route::get('/RecuperarTodoProveedor','ProveedorController@RecoveryAllProveedor')->name('RAproveedor');

//Index Recuperar productos
Route::get('/Recuperar productos','ProductoController@indexRecoveryProducto')->name('IndexRproducto');

//Recuperar productos
Route::get('/RecuperarProducto','ProductoController@RecoveryProducto')->name('Rproducto');

//Recuperar todas los productos
Route::get('/RecuperarTodoProducto','ProductoController@RecoveryAllProducto')->name('RAproducto');

//Index Renovar usuarios expirados
Route::get('/Recuperar usuarios','RolesYUsersController@indexRecoveryUsuarios')->name('IndexRusuarios');

//Renovar usuarios
Route::put('/RenovarUsuario','RolesYUsersController@RenovarUsuarios')->name('Rusuario');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Permisos', 'HomeController@RolesYperm')->name('Permisos')->middleware('role:admin');

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
