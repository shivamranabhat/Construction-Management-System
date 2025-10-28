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
use App\Livewire\Vendor\Index as VendorIndex;
use App\Livewire\Vendor\Create as VendorCreate;
use App\Livewire\Vendor\Edit as VendorEdit;

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
});

