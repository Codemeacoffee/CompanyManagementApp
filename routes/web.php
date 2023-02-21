<?php

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

/*----------------------- ROOT ROUTES -----------------------*/

Route::get('/', 'RootController@access');

Route::get('home', 'RootController@controlPanel');

Route::post('validateAccess', 'RootController@login');

/*----------------------- ADMIN ROUTES -----------------------*/

Route::get('viewSolvedIncidences', 'AdminController@solvedIncidences');

Route::get('viewUnsolvedIncidences', 'AdminController@unsolvedIncidences');

/*-------------- Incidences --------------*/

Route::post('createIncidence', 'AdminController@insertIncidence');

Route::get('viewIncidences', 'AdminController@allIncidences');

Route::get('viewUnsolvedTableIncidences', 'AdminController@unsolvedTableIncidences');

Route::get('incidence/{id}', 'AdminController@editIncidence');

Route::post('editIncidence', 'AdminController@modifyIncidence');

Route::post('resolveIncidence', 'AdminController@resolveIncidence');

Route::post('deleteIncidence', 'AdminController@removeIncidence');

/*-------------- Computer --------------*/

Route::post('createComputer', 'AdminController@insertComputer');

Route::get('viewComputers', 'AdminController@allComputers');

Route::get('autoCompleteComputer', 'AdminController@autoCompleteComputer');

Route::get('computer/{id}', 'AdminController@editComputer');

Route::get('editPlacementComputers', 'AdminController@editPlacementComputers');

Route::post('editComputer', 'AdminController@modifyComputer');

Route::post('moveComputer', 'AdminController@moveComputer');

Route::post('deleteComputer', 'AdminController@removeComputer');

/*-------------- Audit --------------*/

Route::post('createAudit','AdminController@insertAudit');

Route::get('viewAudits', 'AdminController@allAudits');

Route::get('audits/{id}', 'AdminController@editAudit');

Route::post('editAudit', 'AdminController@modifyAudit');

Route::post('deleteAudit', 'AdminController@removeAudit');

/*-------------- External Incidence --------------*/

Route::post('createExternalIncidence','AdminController@insertExternalIncidence');

Route::get('viewExternalIncidences', 'AdminController@allExternalIncidences');

Route::get('viewUnsolvedExternalIncidences', 'AdminController@unsolvedExternalIncidences');

Route::get('externalIncidence/{id}', 'AdminController@editExternalIncidence');

Route::post('editExternalIncidence', 'AdminController@modifyExternalIncidence');

Route::post('resolveExternalIncidence', 'AdminController@resolveExternalIncidence');

Route::post('deleteExternalIncidence', 'AdminController@removeExternalIncidence');

/*-------------- Service Incidence --------------*/

Route::post('createServiceIncidence','AdminController@insertServiceIncidence');

Route::get('viewServiceIncidences', 'AdminController@allServiceIncidences');

Route::get('viewUnsolvedServiceIncidences', 'AdminController@unsolvedServiceIncidences');

Route::get('serviceIncidence/{id}', 'AdminController@editServiceIncidence');

Route::post('editServiceIncidence', 'AdminController@modifyServiceIncidence');

Route::post('modifyServiceIncidence', 'AdminController@modifyServiceIncidence');

Route::post('deleteServiceIncidence', 'AdminController@removeServiceIncidence');

/*-------------- Furniture --------------*/

Route::post('createFurniture','AdminController@insertFurniture');

Route::get('viewFurniture', 'AdminController@allFurniture');

Route::get('furniture/{id}', 'AdminController@editFurniture');

Route::post('editFurniture', 'AdminController@modifyFurniture');

Route::post('deleteFurniture', 'AdminController@removeFurniture');

/*-------------- Reserved List --------------*/

Route::post('createReservedList','AdminController@insertReservedList');

Route::get('viewReservedList', 'AdminController@allReservedList');

Route::get('viewLimitedReservedList', 'AdminController@limitedReservedList');

Route::get('reserved/{id}', 'AdminController@editReservedList');

Route::post('editReservedList', 'AdminController@modifyReservedList');

Route::post('deleteReservedList', 'AdminController@removeReservedList');

/*-------------- Formative Action --------------*/

Route::post('createFormativeAction','AdminController@insertFormativeAction');

Route::get('viewFormativeAction', 'AdminController@allFormativeAction');

Route::get('formativeAction/{id}', 'AdminController@editFormativeAction');

Route::post('editFormativeAction', 'AdminController@modifyFormativeAction');

Route::post('deleteFormativeAction', 'AdminController@removeFormativeAction');

/*-------------- Check In --------------*/

Route::post('createCheckIn','AdminController@insertCheckIn');

Route::get('viewCheckIn', 'AdminController@allCheckIn');

Route::get('checkIn/{id}', 'AdminController@editCheckIn');

Route::post('editCheckIn', 'AdminController@modifyCheckIn');

Route::post('deleteCheckIn', 'AdminController@removeCheckIn');

/*-------------- Check Out --------------*/

Route::post('createCheckOut','AdminController@insertCheckOut');

Route::get('viewLimitedCheckOut', 'AdminController@limitedCheckOut');

Route::get('viewCheckOut', 'AdminController@allCheckOut');

Route::get('checkOut/{id}', 'AdminController@editCheckOut');

Route::post('editCheckOut', 'AdminController@modifyCheckOut');

Route::post('deleteCheckOut', 'AdminController@removeCheckOut');

/*-------------- Staff --------------*/

Route::post('createStaff','AdminController@insertStaff');

Route::get('viewStaff', 'AdminController@allStaff');

Route::get('staff/{id}', 'AdminController@editStaff');

Route::post('editStaff', 'AdminController@modifyStaff');

Route::post('deleteStaff', 'AdminController@removeStaff');

/*-------------- Staff --------------*/

Route::post('createContract','AdminController@insertContract');

Route::get('viewLimitedContracts', 'AdminController@limitedContracts');

Route::get('viewContracts', 'AdminController@allContract');

Route::get('contract/{id}', 'AdminController@editContract');

Route::post('editContract', 'AdminController@modifyContract');

Route::post('deleteContract', 'AdminController@removeContract');

/*-------------- Chat --------------*/

Route::get('chat/{parameter?}', 'AdminController@viewAllChats');

Route::post('sendMessage', 'AdminController@chatSendMessage');

/*-------------- Close Session --------------*/

Route::get('closeSession', 'AdminController@closeSession');
