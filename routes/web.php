<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::prefix('admin.')->middleware(['access.control.list'])->group(function () {
//     Route::resource('/users', App\Http\Controllers\UserController::class);
// });

 Route::middleware(['auth', 'access.control.list'])->group(function(){

    Route::get('/categorias', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.view');
    Route::get('/categorias/cadastro', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categorias/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categorias', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categorias/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorias/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.delete');

    Route::get('/fornecedores', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers.view');
    Route::get('/fornecedores/cadastro', [App\Http\Controllers\SupplierController::class, 'create'])->name('suppliers.create');
    Route::get('/fornecedores/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::post('/fornecedores', [App\Http\Controllers\SupplierController::class, 'store'])->name('suppliers.store');
    Route::put('/fornecedores/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/fornecedores/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('suppliers.delete');

    Route::get('/produtos', [App\Http\Controllers\ProdutoController::class, 'index'])->name('products.view');
    Route::get('/produtos/cadastro', [App\Http\Controllers\ProdutoController::class, 'create'])->name('products.create');
    Route::get('/produtos/{id}', [App\Http\Controllers\ProdutoController::class, 'edit'])->name('products.edit');
    Route::post('/produtos', [App\Http\Controllers\ProdutoController::class, 'store'])->name('products.store');
    Route::put('/produtos/{id}', [App\Http\Controllers\ProdutoController::class, 'update'])->name('products.update');
    Route::delete('/produtos/{id}', [App\Http\Controllers\ProdutoController::class, 'destroy'])->name('products.delete');



   ############# SEGURANCA ########################################

    ############## PERMISSOES ###############
    Route::get('/permissoes', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.view');
    Route::get('/permissoes/cadastro', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('permissions.create');
    Route::get('/permissoes/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissoes', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissoes/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissoes/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.delete');


    ############## PERFIS (ROLES) ###############
    Route::get('/perfis', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.view');
    Route::get('/perfis/cadastro', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
    Route::get('/perfis/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/perfis', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
    Route::put('/perfis/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/perfis/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.delete');

    ############## USUARIOS ###############
    Route::get('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.view');
    Route::get('/usuarios/cadastro', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::get('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::post('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::put('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.delete');
    Route::get('/meu-perfil/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
   
   
    Route::post('/users.save-image', [App\Http\Controllers\Admin\UserController::class, 'saveImage'])->name('users.save-image');


   ############## USUARIOS ###############
   Route::get('/alterar-senha', [App\Http\Controllers\Admin\AlterPasswordController::class, 'index'])->name('password.index');
   Route::post('/alterar-senha', [App\Http\Controllers\Admin\AlterPasswordController::class, 'store'])->name('password.store');

   ############## AUDITORIA ###############
   Route::get('/auditoria', [App\Http\Controllers\Admin\AcitivityLogController::class, 'index'])->name('logs.view');

});

