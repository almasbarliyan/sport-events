<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class SportController extends Controller
{
    public function index() {
        $dataSport = $this->getData()->data;
        
        return view('sport', compact('dataSport'));
    }
    
    public function getData() {
        $client = new \GuzzleHttp\Client(['base_uri' => config('app.voxteneo_api')]);
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('token'),        
            'Accept'        => 'application/json',
        ];

        $response = $client->request('GET', 'api/v1/sport-events', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody());
        
        return $result;
    }
    
    public function create() {
        $organizer = new OrganizerController();
        $organizer = $organizer->getData();

        return view('create_sport', compact('organizer'));
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'eventDate' => 'required',
            'eventType' => 'required',
            'eventName' => 'required',
            'organizerId' => 'required'
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

        $client = new \GuzzleHttp\Client(['base_uri' => config('app.voxteneo_api')]);
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('token'),        
            'Accept'        => 'application/json',
        ];

        if($request->id) {
            $response = $client->request('PUT', 'api/v1/sport-events/'.$request->id, [
                'json' => [
                    'eventDate'=>date("Y-m-d", strtotime($request->eventDate)),
                    'eventType'=>$request->eventType,
                    'eventName'=>$request->eventName,
                    'organizerId'=>$request->organizerId
                ],
                'headers' => $headers
            ]);
            $result = $response->getStatusCode();
        } else {
            dd('else');
            $response = $client->request('POST', 'api/v1/sport-events', [
                'json' => [
                    'eventDate'=>date("Y-m-d", strtotime($request->eventDate)),
                    'eventType'=>$request->eventType,
                    'eventName'=>$request->eventName,
                    'organizerId'=>$request->organizerId
                ],
                'headers' => $headers
            ]);
            $result = json_decode($response->getBody(),true);
        }

        if(isset($result['id'])) {
            return back()->with('success', 'Sport Event created successfully.');
        } else {
            if($result == '204'){
                return back()->with('success', 'Sport Event updated successfully.');
            } else if(isset($result['errors'])){
                return back()->with('error_validate', $result['errors']);
            } else {
                return back()->with('failed', $result['message']);
            }
        }
    }
    
    public function edit($id) {
        $client = new \GuzzleHttp\Client(['base_uri' => config('app.voxteneo_api')]);
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('token'),        
            'Accept'        => 'application/json',
        ];

        $response = $client->request('GET', 'api/v1/sport-events/'.$id, [
            'headers' => $headers
        ]);
        
        $result = json_decode($response->getBody(),true);
        $organizer = new OrganizerController();
        $organizer = $organizer->getData();
        
        return view('create_sport',compact('result', 'organizer'));
    }
    
    public function delete($param) {
        $client = new \GuzzleHttp\Client(['base_uri' => config('app.voxteneo_api')]);
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('token'),        
            'Accept'        => 'application/json',
        ];

        $response = $client->request('DELETE', 'api/v1/sport-events/'.$param, [
            'headers' => $headers
        ]);
        $result = $response->getStatusCode();
        
        return $result;
    }
}
