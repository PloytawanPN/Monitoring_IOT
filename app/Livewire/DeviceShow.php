<?php

namespace App\Livewire;

use Livewire\Component;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\DB;

class DeviceShow extends Component
{
    public $deviceId,$data,$device_data;
    public function mount($id)
    {
        $this->deviceId = $id;
        $this->device_data=DB::table('device_list')->where('id',$this->deviceId)->first();
        $this->loadData();
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
            $reference = $database->getReference('/'.$this->device_data->name);
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
        return view('livewire.device-show');
    }
}
