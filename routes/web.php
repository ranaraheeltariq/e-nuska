<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\UserLogController;

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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    // Department Controller Routes
    // Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    // Route::get('/add/department', [DepartmentController::class, 'create'])->name('department.add');
    // Route::post('/department', [DepartmentController::class, 'store'])->name('department.save');
    // Route::get('/department/{department:name}',[DepartmentController::class,'show'])->name('department.detail');
    // Route::get('/department/{department:name}/edit',[DepartmentController::class, 'edit'])->name('department.edit');
    // Route::put('/department/{department}',[DepartmentController::class, 'update'])->name('department.update');
    // Route::delete('/department/{department}',[DepartmentController::class,'destroy'])->name('department.remove');
    // Doctor Controller Routes
    Route::get('/doctors',[DoctorController::class,'index'])->name('doctors');
    Route::get('/add/doctor',[DoctorController::class,'create'])->name('doctor.add');
    Route::post('/doctor',[DoctorController::class,'store'])->name('doctor.save');
    // Route::get('/doctor/{doctor:doctor_name}',[DoctorController::class,'show'])->name('doctor.profile');
    Route::get('edit/{doctor}/doctor',[DoctorController::class,'edit'])->name('doctor.edit');
    Route::put('/doctor/{doctor}',[DoctorController::class,'update'])->name('doctor.update');
    Route::delete('/doctor/{doctor}',[DoctorController::class,'destroy'])->name('doctor.remove');
    // Lead Controller Routes
    Route::get('/leads',[LeadController::class,'index'])->name('leads');
    Route::get('/leads/pending',[LeadController::class,'pending'])->name('leads.pending');
    Route::get('/leads/order-created',[LeadController::class, 'ordercreated'])->name('leads.ordercreated');
    Route::get('/leads/close',[LeadController::class,'customernotinterested'])->name('leads.close');
    Route::get('/add/lead',[LeadController::class,'create'])->name('lead.add');
    Route::post('/lead',[LeadController::class,'store'])->name('lead.save');
    // Route::get('/lead/{lead}',[LeadController::class,'show'])->name('lead.detail');
    Route::get('lead/{lead}/createorder',[LeadController::class,'createorder'])->name('lead.createorder');
    Route::get('lead/{lead}/edit',[LeadController::class,'edit'])->name('lead.edit');
    Route::put('/lead/{lead}',[LeadController::class,'update'])->name('lead.update');
    Route::delete('/lead/{lead}',[LeadController::class,'destroy'])->name('lead.remove');
    // Order Controller Routes
    Route::get('/orders',[OrderController::class,'index'])->name('orders');
    Route::get('/orders/being-process',[OrderController::class, 'beingprocess'])->name('orders.beingprocess');
    Route::get('/orders/shipped',[OrderController::class,'shipped'])->name('orders.shipped');
    Route::get('/orders/cancelled',[OrderController::class,'cancelled'])->name('orders.cancelled');
    Route::get('/orders/refund',[OrderController::class, 'refund'])->name('orders.refund');
    Route::get('/orders/approval',[OrderController::class, 'approval'])->name('orders.approval');
    Route::get('/orders/completed',[OrderController::class, 'completed'])->name('orders.completed');
    Route::post('/order',[OrderController::class, 'store'])->name('orders.save');
    // Route::get('/order/{order}',[OrderController::class, 'show'])->name('orders.detail');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/order/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('orders.remove');
    // Remarks Controller Routes
    Route::post('/remarks',[RemarkController::class, 'store'])->name('remarks.save');
    // UserLog Controller Routes
    Route::get('/logs',[UserLogController::class, 'index'])->name('userlogs');
    Route::get('/users',[HomeController::class, 'users'])->name('users');
    Route::get('/profile/users/{user?}',[HomeController::class, 'show'])->name('profile');
    Route::put('password/{user}',[HomeController::class,'update'])->name('password');
    Route::get('/add/user',[HomeController::class,'create'])->name('user.add');
    Route::post('/add-user',[HomeController::class,'store'])->name('add user');
    Route::get('/edit/{user}/user',[HomeController::class,'edit'])->name('user.edit');
    Route::delete('/uers/{user}',[HomeController::class,'destroy'])->name('user.remove');
});
