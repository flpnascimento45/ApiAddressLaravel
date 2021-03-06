<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use \Exception;

class UserController extends Controller
{
    /**
     *
     */
    public function index()
    {
        return get_object_vars(new JsonResponse('error', '', 'Método não definido'));
    }

    /**
     * Retorna usuario filtrado pelo id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jsonResponse = new JsonResponse();

        try {
            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = User::findOrFail($id);
        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

    /**
     * Criar novo usuario
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
     * Atualizar cadastro do usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jsonResponse = new JsonResponse();

        try {

            $user = User::findOrFail($id);

            $dataUser = $request->all();

            foreach ($dataUser as $key => $value) {
                $user->$key = $value;
            }

            $user->save();

            $user = ($user->returnArray())['attributes'];
            unset($user['pass']);

            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = $user;

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }

    /**
     * Excluir usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jsonResponse = new JsonResponse();

        try {

            $user = User::findOrFail($id);
            $user->delete();

            $jsonResponse->returnStatus = 'success';
            $jsonResponse->data = 'Excluido com êxito';

        } catch (Exception $e) {
            $jsonResponse->returnStatus = 'error';
            $jsonResponse->errorMessage = $e->getMessage();
        } finally {
            return get_object_vars($jsonResponse);
        }
    }
}
