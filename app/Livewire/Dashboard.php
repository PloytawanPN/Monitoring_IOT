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
    public $data, $devices, $search;

    public function delete($id){
        try {
            DB::table('device_list')->where('id', $id)->delete();
            $this->dispatch('success:message');
        } catch (\Throwable $th) {
            $this->dispatch('error:message');
        }
    }

    public function mount()
    {
        $this->loadData();
    }
    public function redirect_insert()
    {
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
            //dd($this->data);
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
        $this->devices = DB::table('device_list')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('name','LIKE', '%'.$this->search.'%')
                    ->where('detail','LIKE', '%'.$this->search.'%')
                    ->orwhere('location','LIKE', '%'.$this->search.'%');
                }
            })
            ->where('status', 1)
            ->get();
        return view('livewire.dashboard');
    }
}
