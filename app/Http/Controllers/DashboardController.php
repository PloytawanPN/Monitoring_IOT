<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard.index');
    }
    public function insert_device(){
        return view('dashboard.insert_device', ['id' => 0]);
    }

    public function edit($id){
        $decodedId = base64_decode($id);
        return view('dashboard.insert_device', ['id' => $decodedId]);
    }
    public function view($id){
        $decodedId = base64_decode($id);
        return view('dashboard.view_device', ['id' => $decodedId]);
    }
}
