<?php

namespace App\Livewire;

use Livewire\Component;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InsertDevice extends Component
{
    public $device_list = [];
    public $name, $location, $detail, $message;
    public $firebase_data;

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
            $reference = $database->getReference('/' . $this->name);
            $snapshot = $reference->getSnapshot();
            $this->firebase_data = $snapshot->getValue();
        } catch (FirebaseException $e) {
            $this->data = 'Error: ' . $e->getMessage();
        }
    }
    public function deleteDevice($index)
    {
        unset($this->device_list[$index]);
        $this->device_list = array_values($this->device_list); // Re-index the array
    }
    public function add_device()
    {
        $this->loadData();
        $this->validate(
            [
                'name' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $this->loadData();
                        if (!(isset($this->firebase_data))) {
                            $fail('Not found device');
                        }
                    },
                ],
                'location' => 'required',
            ],
            [
                'name.required' => 'The device name is required.',
                'location.required' => 'The device location is required.',
            ]
        );
        $this->device_list[] = [
            'name' => $this->name,
            'location' => $this->location,
            'detail' => $this->detail,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $this->name = null;
        $this->location = null;
        $this->detail = null;
    }
    public function save_device()
    {
        DB::table('device_list')->insert($this->device_list);
        $this->message = "Successfully save the data.";
        $this->dispatch('swal:alert', [
            'type' => 'success',
            'message' => $this->message,
            'text' => 'Your information is already in our database.'
        ]);
    }

    public function render()
    {
        return view('livewire.insert-device');
    }
}
