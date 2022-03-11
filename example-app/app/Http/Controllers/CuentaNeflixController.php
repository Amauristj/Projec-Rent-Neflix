<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CuentaNeflix;

class CuentaNeflixController extends Controller
{
  



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
       $json = $request->json;
       $json = json_decode($json, true);

       

            $validate = Validator::make($json, [
                'email' => 'required',
                'password' => 'required'
           ]);
    
           if ($validate->fails()) {
                
                $data = [
                    'statu' => 'Error',
                    'code' => 400,
                    'massage' => 'Los Campos deben ser llenados Correctamente',
                ];
              
           }else {

                $cuentaneflix = new CuentaNeflix();
                $cuentaneflix->email_account = $json['email'];
                $cuentaneflix->password_account = $json['password'];
                $cuentaneflix->user_id = $user_id;

                if ($cuentaneflix->save()) {
                    $data = [
                        'statu' => 'success',
                        'code' => 200,
                        'massage' => 'Cuenta Registrada Correctamente'
                    ];
                }else {
                    $data = [
                        'statu' => 'Error',
                        'code' => 400,
                        'massage' => 'Hubo un error al registrada La Cuenta'
                    ];
                }
              
           }

           return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentaneflix = CuentaNeflix::where('id', '=', $id)
                                    ->where('user_id', '=', 2)->first();

        if ($cuentaneflix) {

            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => $cuentaneflix
            ];
        }else {
            $data = [
                'statu' => 'Error',
                'code' => 400,
                'massage' => 'La Cuenta que esta buscando no existe'
            ];
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
    public function update(Request $request, $id)
    {
        $json = $request->json;
        $json = json_decode($json, true);

        $validate = Validator::make($json, [
            'email' => 'required',
            'password' => 'required'
       ]);

       if ($validate->fails()) {
            
            $data = [
                'statu' => 'Error',
                'code' => 400,
                'massage' => 'Los Campos deben ser llenados Correctamente',
            ];
          
       }else {

            $cuentaneflix = CuentaNeflix::find($id);
            $cuentaneflix->email_account = $json['email'];
            $cuentaneflix->password_account = $json['password'];

            if ($cuentaneflix->save()) {
                $data = [
                    'statu' => 'success',
                    'code' => 200,
                    'massage' => 'Cuenta Actualizada Correctamente'
                ];
            }else {
                $data = [
                    'statu' => 'Error',
                    'code' => 400,
                    'massage' => 'Hubo un error al Actualizar La Cuenta'
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
    public function destroy($id)
    {
        $user = CuentaNeflix::find($id);

        if ($user->delete()) {
            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => 'Cuenta Eliminada Correctamente',
            ];
        }else {
            $data = [
                'statu' => 'error',
                'code' => 400,
                'massage' => 'Hubo un error al eliminar la cuenta',
            ]; 
        }

        return $data;
    }

    public function getUsersByAccount()
    {
    
        $neflix = CuentaNeflix::with('accountusernetflix')->get();

        $data = [
            'statu' => 'success',
            'code' => 200,
            'netflix_user' => $neflix
        ];

       return $data;
    }

    public static function GetAccountAndUser($cuenta_netflix_id, $user_account_neflix_id)
    {

        $cuentaNeflix= CuentaNeflix::find($cuenta_netflix_id);
        $user_neflix = $cuentaNeflix->accountusernetflix()->where('id', $user_account_neflix_id)->get();

        $datos_cuenta_neflix = [
            'email_account' => $cuentaNeflix->email_account,
            'password_account' => $cuentaNeflix->password_account,
            'user_netflix' => $user_neflix[0]->user_netflix,
            'pin_user_netflix' => $user_neflix[0]->pin_user_netflix
        ];

        return $datos_cuenta_neflix;
    }
}
