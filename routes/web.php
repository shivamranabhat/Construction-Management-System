<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Role\Index as RoleIndex;
use App\Livewire\Role\Create as RoleCreate;
use App\Livewire\Role\Edit as RoleEdit;
use App\Livewire\Module\Index as ModuleIndex;
use App\Livewire\Module\Create as ModuleCreate;
use App\Livewire\Module\Edit as ModuleEdit;

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

