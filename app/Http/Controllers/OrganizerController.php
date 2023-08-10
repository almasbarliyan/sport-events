<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganizerController extends Controller
{
    public function index() {
        return view('organizer');
    }
    
    public function getData() {
        $client = new \GuzzleHttp\Client(['base_uri' => config('app.voxteneo_api')]);
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('token'),        
            'Accept'        => 'application/json',
        ];

        $response = $client->request('GET', 'api/v1/organizers', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody());

        return $result;
    }
}
