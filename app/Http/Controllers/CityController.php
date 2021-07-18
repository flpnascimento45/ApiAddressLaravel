<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\City;
use \Exception;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {

        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = City::all();
        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = City::findOrFail($id);
        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $stateId
     * @return \Illuminate\Http\Response
     */
    public static function showByState($stateId)
    {
        $jsonResponse = new JsonResponse();

        try {

            $jsonResponse->returnStatus = 'success';

            $query = City::query();
            $query->where('state_id', '=', $stateId);

            $jsonResponse->data = $query->get();

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }
}
