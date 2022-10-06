<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CuentaNeflix;

class CuentaNeflixController extends Controller
{
  
    public function index()
    {
        $accout = CuentaNeflix::all();

        if ($accout) {

            $data = [
                'statu' => 'success',
                'code' => 200,
                'users' => $accout
            ];
        };

        return $data;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // agregar el campo de disponibilidad
       $json = $request->json;
       $json = json_decode($json, true);

       

            $validate = Validator::make($json, [
                'email_account' => 'required',
                'password_account' => 'required'
           ]);
    
           if ($validate->fails()) {
                
                $data = [
                    'statu' => 'Error',
                    'code' => 400,
                    'massage' => 'Los Campos deben ser llenados Correctamente',
                ];
              
           }else {

                $cuentaneflix = new CuentaNeflix();
                $cuentaneflix->email_account = $json['email_account'];
                $cuentaneflix->disponibilidad = 1;
                $cuentaneflix->password_account = $json['password_account'];
                $cuentaneflix->user_id = 4;

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
        // agregar id del usuario para poder buscar la cuenta 
        $cuentaneflix = CuentaNeflix::where('id', '=', $id)
                                    ->where('user_id', '=', 4)->first();

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
            'email_account' => 'required',
            'password_account' => 'required'
       ]);

       if ($validate->fails()) {
            
            $data = [
                'statu' => 'Error',
                'code' => 400,
                'massage' => 'Los Campos deben ser llenados Correctamente',
            ];
          
       }else {

            $cuentaneflix = CuentaNeflix::find($id);
            $cuentaneflix->email_account = $json['email_account'];
            $cuentaneflix->password_account = $json['password_account'];

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
// arreglar la rura poniendoles los parametros 
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

    public static function GetAccountByIdForUpdate($id)
    {
        $userCuentaNeflix = CuentaNeflix::where('id','=',$id)
        ->first();

        $userCuentaNeflix->disponibilidad = 0;
        $userCuentaNeflix->save();
    }

    public function GetCuentaNeflixON()
    {
        $CuentaNeflix = CuentaNeflix::where('disponibilidad','=',1)->get();
        
        $data = [
            'statu' => 'success',
            'code' => 200,
            'netflix_account' => $CuentaNeflix
        ];

        return $data;
    }
}
