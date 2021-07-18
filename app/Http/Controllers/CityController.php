<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\City;
use App\Models\State;
use \Exception;

class CityController extends Controller
{
    /**
     * Retorna todas as cidades
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
     * Retorna cidade filtrada pelo id
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
     * Retorna todas as cidades de um determinado estado
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

    /**
     * Retorna os usuarios de todas as cidades
     *
     * @return \Illuminate\Http\Response
     */
    public static function showUsersByCity()
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';

            $query = City::query();
            $query->select(City::raw('city.id, city.name, city.state_id, count(user.id) as countUsers'))
                ->join('address', 'address.city_id', 'city.id')
                ->join('user', 'user.address_id', 'address.id')
                ->groupBy('city.id', 'city.name', 'city.state_id')
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
     * Retorna os usuarios de uma determinada cidade
     *
     * @param integer $cityId
     * @return \Illuminate\Http\Response
     */
    public static function showUsersByCityId($cityId)
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';

            $query = City::query();
            $query->select(City::raw('city.id, city.name, city.state_id, count(user.id) as countUsers'))
                ->leftJoin('address', 'address.city_id', 'city.id')
                ->leftJoin('user', 'user.address_id', 'address.id')
                ->where('city.id', '=', $cityId)
                ->groupBy('city.id', 'city.name', 'city.state_id')
                ->count();

            $jsonResponse->data = $query->get();

            // deixar objeto da posição 0 disponivel para acesso direto
            if (count($jsonResponse->data) > 0) {
                $jsonResponse->data = $jsonResponse->data[0];
            } else {
                throw new Exception('Cidade não localizada!');
            }

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

}
