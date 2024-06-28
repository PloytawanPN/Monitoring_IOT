<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    public $database,$tablename;

    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = '';
    }
    public function index(){
        $data = $this->database->getReference($this->tablename)->getValue();
        dd($data);
        return view('firebase',compact('contact'));
    }
}
