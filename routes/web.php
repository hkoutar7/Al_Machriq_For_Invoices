<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\NotificationInvoices;
use App\Http\Controllers\NotificationInvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportInvoiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectiomController;
use App\Http\Controllers\UserController;
use App\Models\Invoice_detail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',function (){
    return view('auth.login');
});

Route::middleware(['auth','verified','check_user_status'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Route::middleware(['auth','verified','check_user_status'])->group( function() {

    Route::get('/dashboard', DashBoardController::class)->name('dashboard');

    Route::get('/invoices/paidInvoices', [InvoiceController::class, 'getPaidInvoice'])->name('invoices.paidInvoices');
    Route::get('/invoices/unpaidInvoices', [InvoiceController::class, 'getUnpaidInvoice'])->name('invoices.unpaidInvoices');
    Route::get('/invoices/halfpaidInvoices', [InvoiceController::class, 'getHalfpaidInvoice'])->name('invoices.halfpaidInvoices');
    Route::get('/invoice/changeStatus/{id}',[InvoiceController::class, 'editStatus'])->name('invoices.editStatus');
    Route::post('/invoice/changeStatus/',[InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');
    Route::get('/invoices/printInvoice/{id}',[InvoiceController::class, 'printInvoice'])->name('invoices.printInvoice');
    Route::resource("/invoices", InvoiceController::class)->except(['show']);


    Route::get('/sections/product/{id}',[SectiomController::class,'getProductBasedSection'])->name('sections.product.getProductBasedSection');
    Route::resource("/sections", SectiomController::class)->except(['show','edit','create']);
    Route::resource('/products',ProductController::class)->except(['show','edit','create']);

    Route::get('/invoicesDetails/getDetails/{id}',[InvoiceDetailController::class,'getDetail'])->name('invoicesDetails.getDetails');
    Route::get('/invoicesDetails/download/{idInvoice}/{idfile}',[InvoiceDetailController::class,'downloadFile']);
    Route::get('/invoicesDetails/show/{idInvoice}/{idfile}',[InvoiceDetailController::class,'showFile']);
    Route::get('/invoicesDetails/export', [InvoiceDetailController::class, 'export'])->name('invoicesDetails.export');
    Route::resource('/invoicesDetails',InvoiceDetailController::class)->except(['index','create','show','edit','update']);


    Route::post('/invoicesArchives/restore', [InvoiceArchiveController::class , "restoreInvoice"])->name('invoicesArchives.restore');
    Route::resource('/invoicesArchives', InvoiceArchiveController::class)->except(['create','show','update','edit','store']);

    Route::post('users/changeStatus', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::controller(ReportInvoiceController::class)->group(function () {
        Route::get('/reportInvoice', 'index')->name('reportInvoice.index');
        Route::post('/searchInvoice', 'search')->name('searchInvoice');
        Route::get('/reportClient','showClient')->name('reportClient.showClient');
        Route::post('/searchClient','searchClient')->name('reportClient.searchClient');
    });

    Route::get('notifications/readAll', [NotificationInvoicesController::class , 'readAll'])->name('notifications.readAll');
    Route::get('notifications/DeleteAll', [NotificationInvoicesController::class , 'deleteAll'])->name('notifications.DeleteAll');
    Route::resource('notifications', NotificationInvoicesController::class)->except(['create','edit','update','store']) ;

});


Route::get('/{page}',[ AdminController::class, 'index']);

