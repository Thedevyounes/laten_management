<?php

use Illuminate\Support\Facades\Route;

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');

// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');

// es
Route::get('/deleteES/{id}', $controller_path . '\pages\ESocial@deletees')->name('deletees');
Route::get('/pages/e-social', $controller_path . '\pages\ESocial@index')->name('pages-e-social');
Route::get('/modifyesocial/{id}', $controller_path . '\pages\ESocial@modifyesocial')->name('pages-modify-es');
// ep
Route::get('/deleteep/{id}', $controller_path . '\pages\EPhysique@deleteep')->name('deleteep');
Route::get('/pages/e-physique', $controller_path . '\pages\EPhysique@index')->name('pages-e-physique');
Route::get('/modifyephysique/{id}', $controller_path . '\pages\EPhysique@modifyephysique')->name('pages-modify-ep');
Route::get('/detailsephysique/{id}', $controller_path . '\pages\EPhysique@detailsephysique')->name('pages-details-ep');

//contrat error
Route::get('/contraterror', $controller_path . '\pages\EPhysique@contraterror')->name('contraterror');

// prepaid client sans remise dans l'une des article de leur contrat.
Route::get('/preClientRemise', $controller_path . '\pages\EPhysique@preClientRemise')->name('preClientRemise');

// post 

//es
Route::post('/addestodb', $controller_path . '\pages\ESocial@addestodb')->name('addestodb');
Route::post('/modifyes', $controller_path . '\pages\ESocial@modifyesindb')->name('modifyesindb');
// ep
Route::post('/addeptodb', $controller_path . '\pages\EPhysique@addeptodb')->name('addeptodb');
Route::post('/modifyep', $controller_path . '\pages\EPhysique@modifyepindb')->name('modifyepindb');
// contrat
Route::post('/deletePreviouscontrat', $controller_path . '\pages\EPhysique@deletePreviouscontrat')->name('deletePreviouscontrat');
// ajouter 10 % de remise pour ces client
Route::post('/addremise', $controller_path . '\pages\EPhysique@addremise')->name('addremise');
