<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\State;
use \Exception;

class StateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = State::all();
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
    public function show($id)
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = State::findOrFail($id);
        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

}
