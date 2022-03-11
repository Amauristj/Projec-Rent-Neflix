<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCuentaNeflix;
use Illuminate\Support\Facades\Validator;

class UserCuentaNeflixController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id, $cuenta_neflix_id)
    {
        $json = $request->json;
        $json = json_decode($json, true);

        $validate = Validator::make($json, [
            'user_neflix' => 'required',
            'pin_user_neflix' => 'required'
        ]);

        if ($validate->fails()) {
            $data = [
                'statu' => 'Error',
                'code' => 400,
                'massage' => 'Error al Procesar los Datos'
            ];
        }else {
            $userCuentaNeflix = new UserCuentaNeflix;

            $userCuentaNeflix->user_id = $user_id;
            $userCuentaNeflix->cuenta_netflix_id = $cuenta_neflix_id;
            $userCuentaNeflix->user_netflix = $json['user_neflix'];
            $userCuentaNeflix->pin_user_netflix = $json['pin_user_neflix'];
            $userCuentaNeflix->disponibilidad = 0;

           

            if ($userCuentaNeflix->save()) {

                $data = [
                    'statu' => 'success',
                    'code' => 200,
                    'massage' => 'Usuario de Neflix Agrergado Correctamente'
                ];
            }else {

                $data = [
                    'statu' => 'Error',
                    'code' => 400,
                    'massage' => 'Error al Registrar los Datos'
                ];
            }
        }

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $user_id, $cuenta_netflix_id)
    {
        $json = $request->json;
        $json = json_decode($json, true);

        $validate = Validator::make($json, [
            'user_neflix' => 'required',
            'pin_user_neflix' => 'required'
        ]);

        if ($validate->fails()) {
            $data = [
                'statu' => 'Error',
                'code' => 400,
                'massage' => 'Error al Procesar los Datos'
            ];
        }else {
            $userCuentaNeflix = UserCuentaNeflix::where('id','=',$id)
                                                ->where('user_id','=',$user_id)
                                                ->where('cuenta_netflix_id','=',$cuenta_netflix_id)
                                                ->first();

            $userCuentaNeflix->user_netflix = $json['user_neflix'];
            $userCuentaNeflix->pin_user_netflix = $json['pin_user_neflix'];
           

            if ($userCuentaNeflix->save()) {

                $data = [
                    'statu' => 'success',
                    'code' => 200,
                    'massage' => 'Usuario de Neflix Actualizado Correctamente'
                ];
            }else {

                $data = [
                    'statu' => 'Error',
                    'code' => 400,
                    'massage' => 'Error al Actualizar los Datos'
                ];
            }
        }

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user_id, $cuenta_netflix_id)
    {

        $userCuentaNeflix = UserCuentaNeflix::where('id','=',$id)
                                            ->where('user_id','=',$user_id)
                                            ->where('cuenta_netflix_id','=',$cuenta_netflix_id)
                                            ->first();

        if ($userCuentaNeflix->delete()) {

            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => 'Usuario de Neflix Eliminado Correctamente'
            ];
        }else {
            $data = [
                'statu' => 'Error',
                'code' => 204,
                'massage' => 'Usuario de Neflix No Encontrado'
            ];
        }

        return $data;
    }

    public static function GetUserbyIDforUpdate($id){

        $userCuentaNeflix = UserCuentaNeflix::where('id','=',$id)
                                            ->first();
        
        $userCuentaNeflix->disponibilidad = 1;
        $userCuentaNeflix->save();
    }

    public function GetUserNeflixbyAccount($account_id)
    {
        $userCuentaNeflix = UserCuentaNeflix::where('cuenta_netflix_id','=',$account_id)
                                            ->where('disponibilidad','=',0)->get();
        
        $data = [
            'statu' => 'success',
            'code' => 200,
            'netflix_user' => $userCuentaNeflix
        ];

        return $data;
        die();

    }
}
