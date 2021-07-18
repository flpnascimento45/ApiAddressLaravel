<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\Address;
use \Exception;

class AddressController extends Controller
{
    /**
     * Retorna todos endereços
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {

        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = Address::all();
        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }

    }

    /**
     * Retorna endereço filtrado pelo id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = Address::findOrFail($id);
        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

    /**
     * Retorna todos endereços pela cidade
     *
     * @param  int  $cityId
     * @return \Illuminate\Http\Response
     */
    public static function showByCity($cityId)
    {
        $jsonResponse = new JsonResponse();

        try {

            $jsonResponse->returnStatus = 'success';

            $query = Address::query();
            $query->where('city_id', '=', $cityId);

            $jsonResponse->data = $query->get();

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

}
