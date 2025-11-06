<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login as AuthLogin;
use App\Livewire\Company\Index as CompanyIndex;
use App\Livewire\Company\Create as CompanyCreate;
use App\Livewire\Company\Edit as CompanyEdit;
use App\Livewire\Role\Index as RoleIndex;
use App\Livewire\Role\Create as RoleCreate;
use App\Livewire\Role\Edit as RoleEdit;
use App\Livewire\Module\Index as ModuleIndex;
use App\Livewire\Module\Create as ModuleCreate;
use App\Livewire\Module\Edit as ModuleEdit;
use App\Livewire\Account\Index as AccountIndex;
use App\Livewire\Account\Create as AccountCreate;
use App\Livewire\Account\Edit as AccountEdit;
use App\Livewire\Project\Index as ProjectIndex;
use App\Livewire\Project\Create as ProjectCreate;
use App\Livewire\Project\Edit as ProjectEdit;
use App\Livewire\Boq\Index as BoqIndex;
use App\Livewire\Boq\Create as BoqCreate;
use App\Livewire\Boq\Edit as BoqEdit;
use App\Livewire\Boq\Preview as BoqPreview;
use App\Livewire\Vendor\Index as VendorIndex;
use App\Livewire\Vendor\Create as VendorCreate;
use App\Livewire\Vendor\Edit as VendorEdit;
use App\Livewire\Category\Index as CategoryIndex;
use App\Livewire\Category\Create as CategoryCreate;
use App\Livewire\Category\Edit as CategoryEdit;
use App\Livewire\Item\Index as ItemIndex;
use App\Livewire\Item\Create as ItemCreate;
use App\Livewire\Item\Edit as ItemEdit;
use App\Livewire\Bill\Index as BillIndex;
use App\Livewire\Bill\Create as BillCreate;
use App\Livewire\Bill\Edit as BillEdit;
use App\Livewire\Tax\Index as TaxIndex;
use App\Livewire\Tax\Create as TaxCreate;
use App\Livewire\Tax\Edit as TaxEdit;
use App\Livewire\Purchase\Index as PurchaseIndex;
use App\Livewire\Purchase\Create as PurchaseCreate;
use App\Livewire\Purchase\Edit as PurchaseEdit;


Route::get('/signin', AuthLogin::class)->name('signin');
Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', Dashboard::class)->name('index');
    Route::name('company.')->group(function () {
        Route::get('/companies', CompanyIndex::class)->name('index');            
        Route::get('/company/create', CompanyCreate::class)->name('create');   
        Route::get('/company/{slug}', CompanyEdit::class)->name('edit');    
    });
    
    Route::name('role.')->group(function () {
        Route::get('/roles', RoleIndex::class)->name('index');            
        Route::get('/role/create', RoleCreate::class)->name('create');   
        Route::get('/role/{slug}', RoleEdit::class)->name('edit');   
    });
    
    Route::name('module.')->group(function () {
        Route::get('/modules', ModuleIndex::class)->name('index');            
        Route::get('/module/create', ModuleCreate::class)->name('create');   
        Route::get('/module/{slug}', ModuleEdit::class)->name('edit');    
    });
    
    Route::name('account.')->group(function () {
        Route::get('/accounts', AccountIndex::class)->name('index');            
        Route::get('/account/create', AccountCreate::class)->name('create');   
        Route::get('/account/{slug}', AccountEdit::class)->name('edit');    
    });
    
    Route::name('boq.')->group(function () {
        Route::get('/boqs', BoqIndex::class)->name('index');            
        Route::get('/boq/create', BoqCreate::class)->name('create');   
        Route::get('/boq/{slug}', BoqEdit::class)->name('edit');  
        Route::get('/boq/preview/{slug}', BoqPreview::class)->name('preview');  
    });
    Route::name('tax.')->group(function () {
        Route::get('/taxes', TaxIndex::class)->name('index');            
        Route::get('/tax/create', TaxCreate::class)->name('create');   
        Route::get('/tax/{slug}', TaxEdit::class)->name('edit');  
    });
    
    Route::name('project.')->group(function () {
        Route::get('/projects', ProjectIndex::class)->name('index');            
        Route::get('/project/create', ProjectCreate::class)->name('create');   
        Route::get('/project/{slug}', ProjectEdit::class)->name('edit');    
    });
    Route::name('vendor.')->group(function () {
        Route::get('/vendors', VendorIndex::class)->name('index');            
        Route::get('/vendor/create', VendorCreate::class)->name('create');   
        Route::get('/vendor/{slug}', VendorEdit::class)->name('edit');    
    });
    Route::name('category.')->group(function () {
        Route::get('/categories', CategoryIndex::class)->name('index');            
        Route::get('/category/create', CategoryCreate::class)->name('create');   
        Route::get('/category/{slug}', CategoryEdit::class)->name('edit');    
    });
    Route::name('item.')->group(function () {
        Route::get('/items', ItemIndex::class)->name('index');            
        Route::get('/item/create', ItemCreate::class)->name('create');   
        Route::get('/item/{slug}', ItemEdit::class)->name('edit');    
    });
    Route::name('bill.')->group(function () {
        Route::get('/bills', BillIndex::class)->name('index');            
        Route::get('/bill/create', BillCreate::class)->name('create');      
        Route::get('/bill/{slug}', BillEdit::class)->name('edit');    
    });
    Route::name('purchase.')->group(function () {
        Route::get('/purchases', PurchaseIndex::class)->name('index');            
        Route::get('/purchase/new', PurchaseCreate::class)->name('create');      
        Route::get('/purchase/{slug}', PurchaseEdit::class)->name('edit');    
    });
});

