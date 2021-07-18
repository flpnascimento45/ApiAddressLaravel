<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use \Exception;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jsonResponse = new JsonResponse();

        try {

            $dataUser = $request->all();
            $dataUser['pass'] = md5($dataUser['pass']);

            $returnInsert = User::create($dataUser);
            $returnInsert = ($returnInsert->returnArray())['attributes'];
            unset($returnInsert['pass']);

            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = $returnInsert;

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jsonResponse = new JsonResponse();

        try {

            // $user = User::findOrFail($id);

            $dataUser = $request->all();

            print_r($id);
            print_r($dataUser);

            // $dataUser['pass'] = md5($dataUser['pass']);

            // $returnInsert = User::create($dataUser);
            // $returnInsert = ($returnInsert->returnArray())['attributes'];
            // unset($returnInsert['pass']);

            // $jsonResponse->returnStatus = 'success';
            // $jsonResponse->data = $returnInsert;

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
