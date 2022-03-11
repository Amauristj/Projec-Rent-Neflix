<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\prueba;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = prueba::all();

        if ($users) {

            $data = [
                'statu' => 'success',
                'code' => 200,
                'message' => $users
            ];
        };

        return $data;
    }

    public function show($id)
    {
        $user = prueba::find($id);

        if ($user) {

            $data = [
                'statu' => 'success',
                'code' => 200,
                'message' => $user
            ];
        };

        return $data;
    }

    public function store(Request $request){

        $json = $request->json;
        $json = json_decode($json, true);

        $validate = Validator::make($json,[
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            $data = [
                'statu' => 'error',
                'code' => 400,
                'message' => "Inserte los Datos Correctamente"
            ];
        }else{
            
            $user = new prueba();
            $user->nombre = $json['nombre'];
            $user->apellido = $json['apellido'];
            $user->email = $json['email'];
            $user->password = Hash::make($json['password']);

            if($user->save()){
                $data = [
                    'statu' => 'success',
                    'code' => 200,
                    'message' => "Registro Insertado Correctamente"
                ];
            }else {
                $data = [
                    'statu' => 'error',
                    'code' => 400,
                    'message' => "Error al insertar el registro"
                ];
            };
            return $data;
        }

    }

    public function edit($id)
    {
        $user = prueba::find($id);

        if ($user) {
            $data = [
                'statu' => 'success',
                'code' => 200,
                'user' => $user
            ];
        }else {
            $data = [
                'statu' => 'error',
                'code' => 400,
                'message' => 'El Usuario No existe'
            ];
        }

        return $data;
    }

    public function update(Request $request, $id)
    {
        $json = $request->json;
        $json = json_decode($json, true);

        $user = prueba::find($id);

        $user->nombre = $json['nombre'];
        $user->apellido = $json['apellido'];
        $user->email = $json['email'];
           
        if ($user->save()) {
            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => 'Usuario Actualizado Correctamente',
            ];
        }else {
            $data = [
                'statu' => 'error',
                'code' => 400,
                'massage' => 'No se pudo actualizar el Usuario',
            ];
        }

        return $data;
        
    }

    public function destroy($id)
    {
        $user = prueba::find($id);

        if ($user->delete()) {
            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => 'Usuario Eliminado Correctamente',
            ];
        }else {
            $data = [
                'statu' => 'error',
                'code' => 400,
                'massage' => 'El usuario no se ha eliminado',
            ]; 
        }

        return $data;
    }

    public function getAccounbyUser($id)
    {
       $accountNeflix = prueba::find($id)->accountNeflix;
     
        if (count($accountNeflix) > 0) {
            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => $accountNeflix
            ]; 
        }else {
            $data = [
                'statu' => 'Success',
                'code' => 204,
                'massage' => "No Tiene Cuentas Registradas"
            ]; 
        }
        
       return $data; 
    }
}
