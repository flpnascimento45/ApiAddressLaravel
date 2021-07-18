<?php

use \App\Http\Controllers\AddressController;

Route::get('/address', function (Request $request) {
    return AddressController::index();
});

Route::get('/address/id/{id}', function ($id) {
    return AddressController::show($id);
});
