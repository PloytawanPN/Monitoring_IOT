<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show($id)
    {
        return view('device.index', compact('id'));
    }
}
