<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClusterMembers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\CustomerCardController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\ProductSubGroupController;
use App\Http\Controllers\StockClusterController;
use App\Http\Controllers\TypeController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        return view('dashboard');
    });
    
Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/customers', [CustomerController::class,'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class,'create'])->name('customers.create');
Route::post('/customers/store', [CustomerController::class,'store'])->name('customers.store');
Route::get('customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('customers/{customer}/update', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/customers/export-excel', [CustomerController::class, 'yourControllerMethod']);
Route::get('/download-excel', [CustomerController::class, 'downloadExcelFile'])->name('download.excel');


//   for products...
Route::get('/products', [ProductController::class,'index'])->name('products.index');
Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
Route::post('/products/store', [ProductController::class,'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/export/', [ProductController::class, 'exportProducts'])->name('products.export');

//   for User Groups...
Route::get('/customer-groups', [CustomerGroupController::class,'index'])->name('customer-groups.index');
Route::get('/customer-groups/create', [CustomerGroupController::class,'create'])->name('customer-groups.create');
Route::post('/customer-groups/store', [CustomerGroupController::class,'store'])->name('customer-groups.store');
Route::get('/customer-groups/{customerGroup}/edit', [CustomerGroupController::class,'edit'])->name('customer-groups.edit');
Route::put('/customer-groups/{customerGroup}/update', [CustomerGroupController::class,'update'])->name('customer-groups.update');
Route::delete('/customer-groups/{customerGroup}/destroy', [CustomerGroupController::class,'destroy'])->name('customer-groups.destroy');
Route::get('/customer-groups/{id}/members', [CustomerGroupController::class,'members'])->name('customer-groups.members');

//  for customer-group-members

Route::get('/customer-groups-members/{group_id}', [CustomerGroupController::class,'group_members'])->name('customer-group.members');
Route::post('/customer-groups/members/personality', [CustomerGroupController::class,'personality'])->name('customer-groups.members.personality');
Route::post('/customer-groups/members/cardno', [CustomerGroupController::class,'cardno'])->name('customer-groups.members.cardno');
Route::post('/customer-groups/members/uploadFile', [CustomerGroupController::class,'uploadFile'])->name('customer-groups.members.uploadFile');

//  for stock-clusters
Route::get('/stock-clusters', [StockClusterController::class,'index'])->name('stock-clusters.index');
Route::get('/stock-clusters/create', [StockClusterController::class,'create'])->name('stock-clusters.create');
Route::post('/stock-clusters/store', [StockClusterController::class,'store'])->name('stock-clusters.store');
Route::get('/stock-clusters/{stockCluster}/edit', [StockClusterController::class,'edit'])->name('stock-clusters.edit');
Route::put('/stock-clusters/{stockCluster}/update', [StockClusterController::class,'update'])->name('stock-clusters.update');
Route::delete('/stock-clusters/{stockCluster}/destroy', [StockClusterController::class,'destroy'])->name('stock-clusters.destroy');
Route::get('/stock-clusters/{id}/members', [StockClusterController::class,'members'])->name('stock-clusters.members');

Route::post('/stock-clusters/members/uploadFile', [StockClusterController::class,'uploadFile'])->name('stock-clusters.members.uploadFile');
Route::get('/stock-cluster/{id}/members', [ClusterMembers::class,'index'])->name('stock-cluster.members');

Route::get('/stock-cluster/{id}/includedGroupes/create', [ClusterMembers::class,'createIncludedGroup'])->name('includedGroupes.create');
Route::post('/stock-cluster/includedGroupes/store', [ClusterMembers::class,'storeIncludedGroup'])->name('includedGroup.store');
Route::delete('/stock-cluster/includedGroupes/{included_group}/destroy', [ClusterMembers::class,'destroyIncludedGroup'])->name('includedGroupes.destroy');

Route::get('/stock-cluster/{id}/includedSubGroupes/create', [ClusterMembers::class,'createIncludedSubGroup'])->name('includedSubGroupes.create');
Route::post('/stock-cluster/includedSubGroupes/store', [ClusterMembers::class,'storeIncludedSubGroup'])->name('includedSubGroup.store');
Route::delete('/stock-cluster/includedSubGroupes/{included_subgroup}/destroy', [ClusterMembers::class,'destroyIncludedSubGroup'])->name('includedSubGroupes.destroy');

Route::get('/stock-cluster/{id}/excludedGroupes/create', [ClusterMembers::class,'createExcludedGroup'])->name('excludedGroupes.create');
Route::post('/stock-cluster/excludedGroupes/store', [ClusterMembers::class,'storeExcludedGroup'])->name('excludedGroup.store');
Route::delete('/stock-cluster/excludedGroupes/{excluded_group}/destroy', [ClusterMembers::class,'destroyExcludedGroup'])->name('excludedGroupes.destroy');

Route::get('/stock-cluster/{id}/excludedSubGroupes/create', [ClusterMembers::class,'createExcludedSubGroup'])->name('excludedSubGroupes.create');
Route::post('/stock-cluster/excludedSubGroupes/store', [ClusterMembers::class,'storeExcludedSubGroup'])->name('excludedSubGroup.store');
Route::delete('/stock-cluster/excludedSubGroupes/{excluded_subgroup}/destroy', [ClusterMembers::class,'destroyExcludedSubGroup'])->name('excludedSubGroupes.destroy');


//  for customer purchases
Route::get('customers/{id}/purchases', [CustomerController::class, 'purchases'])->name('customers.purchases');
Route::get('/customer/purchased-items/{id}', [CustomerController::class, 'getPurchasedItems']);

//   for customer cards
Route::get('customers/{id}/customer-cards', [CustomerCardController::class,'index'])->name('customer.cards.index');
Route::get('customers/{id}/customer-cards/create', [CustomerCardController::class,'create'])->name('customer.cards.create');
Route::get('customers/customer-cards/{customerCard}/show', [CustomerCardController::class,'show'])->name('customer.cards.show');
Route::get('customers/customer-cards/{customerCard}/edit', [CustomerCardController::class,'edit'])->name('customer.cards.edit');
Route::delete('customers/customer-cards/{customerCard}/destroy', [CustomerCardController::class,'destroy'])->name('customer.cards.destroy');
Route::put('customers/customer-cards/{customerCard}/update', [CustomerCardController::class,'update'])->name('customer.cards.update');
Route::post('customers/customer-cards/store', [CustomerCardController::class,'store'])->name('customer.cards.store');

//    for types
Route::get('types', [TypeController::class,'index'])->name('types.index');
Route::get('types/create', [TypeController::class,'create'])->name('types.create');
Route::get('types/{type}/edit', [TypeController::class,'edit'])->name('types.edit');
Route::delete('types{type}/destroy', [TypeController::class,'destroy'])->name('types.destroy');
Route::put('types{type}/update', [TypeController::class,'update'])->name('types.update');
Route::post('types/store', [TypeController::class,'store'])->name('types.store');

//    for category
Route::get('category', [CategoryController::class,'index'])->name('category.index');
Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
Route::get('category/{category}/edit', [CategoryController::class,'edit'])->name('category.edit');
Route::delete('category{category}/destroy', [CategoryController::class,'destroy'])->name('category.destroy');
Route::put('category{category}/update', [CategoryController::class,'update'])->name('category.update');
Route::post('category/store', [CategoryController::class,'store'])->name('category.store');
//    for productGroup
Route::get('productGroup', [ProductGroupController::class,'index'])->name('productGroup.index');
Route::get('productGroup/create', [ProductGroupController::class,'create'])->name('productGroup.create');
Route::get('productGroup/{productGroup}/edit', [ProductGroupController::class,'edit'])->name('productGroup.edit');
Route::delete('productGroup{productGroup}/destroy', [ProductGroupController::class,'destroy'])->name('productGroup.destroy');
Route::put('productGroup{productGroup}/update', [ProductGroupController::class,'update'])->name('productGroup.update');
Route::post('productGroup/store', [ProductGroupController::class,'store'])->name('productGroup.store');

//    for productSubGroup
Route::get('productSubGroup', [ProductSubGroupController::class,'index'])->name('productSubGroup.index');
Route::get('productSubGroup/create', [ProductSubGroupController::class,'create'])->name('productSubGroup.create');
Route::get('productSubGroup/{productSubGroup}/edit', [ProductSubGroupController::class,'edit'])->name('productSubGroup.edit');
Route::delete('productSubGroup{productSubGroup}/destroy', [ProductSubGroupController::class,'destroy'])->name('productSubGroup.destroy');
Route::put('productSubGroup{productSubGroup}/update', [ProductSubGroupController::class,'update'])->name('productSubGroup.update');
Route::post('productSubGroup/store', [ProductSubGroupController::class,'store'])->name('productSubGroup.store');



});



require __DIR__.'/auth.php';
