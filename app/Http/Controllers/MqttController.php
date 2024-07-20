<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MqttController extends Controller
{
    public function mqtt(){
        return view('template.setting.mqtt');
    }
}
