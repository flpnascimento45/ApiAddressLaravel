<?php

use \App\Http\Controllers\CityController;

Route::get('/city', function (Request $request) {
    return CityController::index();
});

Route::get('/city/id/{id}', function ($id) {
    return CityController::show($id);
});

Route::get('/city/state/{stateId}', function ($stateId) {
    return CityController::showByState($stateId);
});

Route::get('/city/users', function () {
    return CityController::showUsersByCity();
});

Route::get('/city/users/{stateId}', function ($stateId) {
    return CityController::showUsersByCityId($stateId);
});
