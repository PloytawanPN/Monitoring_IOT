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
    public $firebase_data, $del_item, $id;

    public function mount($id)
    {
        $this->id = $id;
        if ($this->id != 0) {
            try {
                $user = DB::table('device_list')->where('id', $this->id)->first();
                $this->name = $user->name;
                $this->location = $user->location;
                $this->detail = $user->detail;
            } catch (\Throwable $th) {
                return redirect('/dashboard');
            }
        }
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
            $reference = $database->getReference('/' . $this->name);
            $snapshot = $reference->getSnapshot();
            $this->firebase_data = $snapshot->getValue();
        } catch (FirebaseException $e) {
            $this->data = 'Error: ' . $e->getMessage();
        }
    }
    public function deleteDevice($index)
    {
        $this->dispatch('DeleteAlert');
        $this->del_item = $index;
    }
    public function confirm_delete()
    {
        try {
            unset($this->device_list[$this->del_item]);
            $this->device_list = array_values($this->device_list);
            $this->dispatch('ConfirmDelete');
        } catch (\Exception $e) {
            dd('Error : ' . $e);
        }
    }
    public function update()
    {
        try {
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
            $this->loadData();
            if ($this->firebase_data == null) {
                $this->dispatch('error:message');
            } else {
                try {
                    DB::table('device_list')
                        ->where('id', $this->id)
                        ->update([
                            'name' => $this->name,
                            'location' => $this->location,
                            'detail' => $this->detail,
                            'updated_at' => Carbon::now(),
                        ]);
                    $this->dispatch('Success:update');
                } catch (\Throwable $th) {
                    $this->dispatch('error:message');
                }
            }
        } catch (\Throwable $th) {
            $this->dispatch('error:message');
        }
    }
    public function add_device()
    {
        try {
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
            $this->loadData();
            if ($this->firebase_data == null) {
                $this->dispatch('error:message');
            } else {
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
                $this->dispatch('success:message');
            }
        } catch (\Throwable $th) {
            $this->dispatch('error:message');
        }

    }
    public function save_device()
    {
        try {
            if (count($this->device_list) != 0) {
                DB::table('device_list')->insert($this->device_list);
                $this->device_list = [];
                $this->message = "Successfully save the data.";

                $this->dispatch('swal:alert', [
                    'type' => 'success',
                    'message' => $this->message,
                    'text' => 'Your information is already in our database.'
                ]);
            } else {
                $this->dispatch('error:message');
            }
        } catch (\Throwable $th) {
            $this->dispatch('error:message');
        }
    }

    public function render()
    {
        return view('livewire.insert-device');
    }
}
