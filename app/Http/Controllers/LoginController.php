<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;



class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }
    
    public function actionlogin(Request $request)
    {
        $theUrl     = config('app.voxteneo_api').'api/v1/users/login';
        
        $client = new Client();
        $email = $request->email;
        $password = $request->password;

        $params = [
            "email" => $email,
            "password" => $password
        ];

        $response = $client->request('POST', $theUrl, [
            'json' => $params
        ]);

        $data = json_decode($response->getBody());

        $token = $data->token;

        // Redirect to the dashboard page
        if (is_null($token)) {
            Session::flash('error', 'Error: Token is null');

            // Redirect the user back to the previous page
            return redirect()->back();
        } else {
            session(['token' => $token]);
            return redirect('home');
        }
    }
}
