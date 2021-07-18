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

/**
 * retorna totalização de usuarios por estado
 */
// $router->get('/state/users', [
//     function () {

//         $returnAddress = StateController::getUsersByState();
//         $jsonReturn = new JsonResponse($returnAddress[0], $returnAddress[1], $returnAddress[2]);

//         return new Response(200, $jsonReturn, 'json');

//     },
// ]);

/**
 * retorna totalização de usuarios por estado filtrando id
 */
// $router->get('/state/users/{stateId}', [
//     function ($stateId) {

//         $returnAddress = StateController::getUsersByStateId($stateId);
//         $jsonReturn = new JsonResponse($returnAddress[0], $returnAddress[1], $returnAddress[2]);

//         return new Response(200, $jsonReturn, 'json');

//     },
// ]);
