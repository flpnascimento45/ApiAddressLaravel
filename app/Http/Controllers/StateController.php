<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\State;
use \Exception;

class StateController extends Controller
{

    /**
     * Retorna todos estados
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
     * Retorna estado filtrado pelo id
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
     * Retorna total de usuarios de todos estados
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

            $jsonResponse->data = $query->get();

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

    /**
     * Retorna total de usuarios filtrando estado
     *
     * @param integer $stateId
     * @return \Illuminate\Http\Response
     */
    public static function showUsersByStateId($stateId)
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';

            $query = State::query();
            $query->select(State::raw('state.id, state.name, state.initials, count(user.id) as countUsers'))
                ->join('city', 'city.state_id', 'state.id')
                ->leftJoin('address', 'address.city_id', 'city.id')
                ->leftJoin('user', 'user.address_id', 'address.id')
                ->where('state.id', '=', $stateId)
                ->groupBy('state.id', 'state.name', 'state.initials')
                ->count();

            $jsonResponse->data = $query->get();

            // deixar objeto da posi????o 0 disponivel para acesso direto
            if (count($jsonResponse->data) > 0) {
                $jsonResponse->data = $jsonResponse->data[0];
            } else {
                throw new Exception('Estado n??o localizado!');
            }

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

}
