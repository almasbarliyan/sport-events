<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;


class HomeController extends Controller
{
    public function index()
    {
        if(Session::get('token')) {
            return view('home');
        } else {
            return redirect('login');
        }
    }
}
