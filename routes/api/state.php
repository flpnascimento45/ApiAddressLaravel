<?php

use \App\Http\Controllers\StateController;

Route::get('/state', function (Request $request) {
    return StateController::index();
});

Route::get('/state/id/{id}', function ($id) {
    return StateController::show($id);
});

Route::get('/state/users', function () {
    return StateController::showUsersByState();
});

Route::get('/state/users/{stateId}', function ($stateId) {
    return StateController::showUsersByStateId($stateId);
});
