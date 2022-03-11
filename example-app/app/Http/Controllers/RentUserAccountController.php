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
   public function store(Request $request, $cuenta_netflix_id, $user_account_neflix_id)
   {
       
    $json = $request->json;
    $json = json_decode($json, true);

    $validate = Validator::make($json, [
        'email_client' => 'required',
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
        $rentuseraccount->cuenta_netflix_id = $cuenta_netflix_id;
        $rentuseraccount->user_account_neflix_id = $user_account_neflix_id;

        if ($rentuseraccount->save()) {
            
            $updatedisponibilidad = UserCuentaNeflixController::GetUserbyIDforUpdate($user_account_neflix_id);

            $datos_netflix = CuentaNeflixController::GetAccountAndUser($cuenta_netflix_id, $user_account_neflix_id);

            $correo = new UserCuentaNeflixMailable($datos_netflix);
            Mail::to('amauristj2016@gmail.com')->send($correo->build());

        }
    }
   }
}
