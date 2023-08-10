<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'password' => 'required|min:5|confirmed',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            // For example:
            return back()
                    ->withErrors($validator)
                    ->withInput();

            // Also handy: get the array with the errors
            $validator->errors();

            // or, for APIs:
            $validator->errors()->toJson();
        }

        $password = $request->password;

        $theUrl     = config('app.voxteneo_api').'api/v1/users';

        $response= Http::post($theUrl, [
            'firstName'=>$request->firstname,
            'lastName'=>$request->lastname,
            'email'=>$request->email,
            'password'=>$password,
            'repeatPassword'=>$password
        ]);
        
        $result = $response->json();

        if(isset($result['id'])) {
            return back()->with('success', 'User created successfully.');
        } else {
            if(isset($result['errors'])){
                return back()->with('error_validate', $result['errors']);
            } else {
                return back()->with('failed', $result['message']);
            }
        }
    }
}
