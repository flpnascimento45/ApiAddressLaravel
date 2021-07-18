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
    public static function index()
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
    public static function show($id)
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

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function showUsersByState()
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';

            $query = State::query();
            $query->select(State::raw('state.id, state.name, state.initials, count(user.id) as countUsers'))
                ->join('city', 'city.state_id', 'state.id')
                ->join('address', 'address.city_id', 'city.id')
                ->join('user', 'user.address_id', 'address.id')
                ->groupBy('state.id', 'state.name', 'state.initials')
                ->count();

            // ->where('state_id', '=', $stateId);

            $jsonResponse->data = $query->get();

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

}
