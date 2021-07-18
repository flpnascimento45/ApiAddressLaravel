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

/**
 * busca endereço pela cidade
 */
// $router->get('/city/state/{stateId}', [
//     function ($stateId) {

//         $returnAddress = CityController::getCityByState($stateId);
//         $jsonReturn = new JsonResponse($returnAddress[0], $returnAddress[1], $returnAddress[2]);

//         return new Response(200, $jsonReturn, 'json');

//     },
// ]);

/**
 * busca cidade pelo id
 */
// $router->get('/city/id/{cityId}', [
//     function ($cityId) {

//         $returnAddress = CityController::getCityById($cityId);
//         $jsonReturn = new JsonResponse($returnAddress[0], $returnAddress[1], $returnAddress[2]);

//         return new Response(200, $jsonReturn, 'json');

//     },
// ]);

/**
 * retorna totalização de usuarios por estado
 */
// $router->get('/city/users', [
//     function () {

//         $returnAddress = CityController::getUsersByCity();
//         $jsonReturn = new JsonResponse($returnAddress[0], $returnAddress[1], $returnAddress[2]);

//         return new Response(200, $jsonReturn, 'json');

//     },
// ]);

/**
 * retorna totalização de usuarios por estado filtrando id
 */
// $router->get('/city/users/{cityId}', [
//     function ($cityId) {

//         $returnAddress = CityController::getUsersByCityId($cityId);
//         $jsonReturn = new JsonResponse($returnAddress[0], $returnAddress[1], $returnAddress[2]);

//         return new Response(200, $jsonReturn, 'json');

//     },
// ]);
