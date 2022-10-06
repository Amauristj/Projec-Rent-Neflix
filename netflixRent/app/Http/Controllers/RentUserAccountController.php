<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentUserAccount;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CuentaNeflixController;
use App\Mail\UserCuentaNeflixMailable;
use Illuminate\Support\Facades\Mail;

//Poner fecha de vencimiento de renta


class RentUserAccountController extends Controller
{
   public function store(Request $request)
   {
       
    $jsonn = $request->json;
    $json = json_decode($jsonn, true);
    
    $validate = Validator::make($json, [
        'email_client' => 'required',
        'cuenta_netflix_id' => 'required',
        'user_account_neflix_id' => 'required',
    ]);
   
    if ($validate->fails()) {
        $data = [
            'statu' => 'Error',
            'code' => 400,
            'massage' => 'Debe LLenar los Campos'
        ];
    }else {
        $rentuseraccount = new RentUserAccount();
        $rentuseraccount->email_client = $json['email_client'];
        $rentuseraccount->cuenta_netflix_id = $json['cuenta_netflix_id'];
        $rentuseraccount->user_account_neflix_id = $json['user_account_neflix_id'];

        if ($rentuseraccount->save()) {

            $userNetflixON =  UserCuentaNeflixController::GetUserNeflixbyAccount($json['cuenta_netflix_id']);
            $ncount = $userNetflixON['netflix_user']->count();

            if ($ncount == 1) {
                $updatedisponibilidadAccount = CuentaNeflixController::GetAccountByIdForUpdate($json['cuenta_netflix_id']);
            }
            $updatedisponibilidad = UserCuentaNeflixController::GetUserbyIDforUpdate($json['user_account_neflix_id']);

            $datos_netflix = CuentaNeflixController::GetAccountAndUser($json['cuenta_netflix_id'], $json['user_account_neflix_id']);

            $correo = new UserCuentaNeflixMailable($datos_netflix);
            Mail::to('amauristj2016@gmail.com')->send($correo->build());

            $data = [
                'statu' => 'success',
                'code' => 200,
                'massage' => 'listo'
            ];
        }
    }
    return $data;
   }
}
