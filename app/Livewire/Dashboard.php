<?php

namespace App\Livewire;

use Livewire\Component;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\DB;

/* use Bluerhinos\phpMQTT;
use Exception;
use Illuminate\Support\Facades\Log; */

class Dashboard extends Component
{
    public $data,$devices;

    public function view($id){
        return redirect('Device/'.$id);
    }

    public function mount()
    {
        $this->loadData();
    }
    public function redirect_insert(){
        return redirect('/InsertDevice');
    }

    public function loadData()
    {
        $firebaseCredentials = config('firebase.credentials.file');
        $firebaseDatabaseUrl = config('firebase.database.url');

        if (!file_exists($firebaseCredentials)) {
            throw new \Exception('Firebase credentials file not found: ' . $firebaseCredentials);
        }

        try {
            $factory = (new Factory)
                ->withServiceAccount($firebaseCredentials)
                ->withDatabaseUri($firebaseDatabaseUrl);

            $database = $factory->createDatabase();
            $reference = $database->getReference('/');
            $snapshot = $reference->getSnapshot();
            $this->data = $snapshot->getValue();
        } catch (FirebaseException $e) {
            $this->data = 'Error: ' . $e->getMessage();
        }
    }
    public function updateData()
    {
        $this->loadData();
    }
    public function render()
    {
        $this->devices=DB::table('device_list')->where('status',1)->get();
        return view('livewire.dashboard');
    }
}
