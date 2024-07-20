<?php

namespace App\Livewire;

use Livewire\Component;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\DB;
use Bluerhinos\phpMQTT;
use Exception;
use Illuminate\Support\Facades\Log;

class DeviceShow extends Component
{
    public $deviceId,$data,$device_data,$server_info;

    public function mount($id)
    {
        $this->deviceId = $id;
        $this->device_data=DB::table('device_list')->where('id',$this->deviceId)->first();
        $this->server_info=DB::table('mqtt_connection')->first();
        $this->loadData();
    }
    public function ToggleSwitch($index)
    { 
        $server =  $this->server_info->server_name;
        $port = $this->server_info->port_number;
        $username = $this->server_info->username;
        $password = $this->server_info->password;
        $client_id = 'mqttx_20cbc973';

        $mqtt = new phpMQTT($server, $port, $client_id);

        try {
            if (!$mqtt->connect(true, NULL, $username, $password)) {
                throw new Exception('ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ MQTT');
            }
            $mqtt->publish('cmnd/'.$this->device_data->name.'/Power'.$index, 'toggle', 0);
            $this->status = 'ส่งข้อความสำเร็จ';
        } catch (\Exception $e) {
            $this->status = 'ข้อผิดพลาด: ' . $e->getMessage();
            Log::error('MQTT Error: ' . $e->getMessage());
        } finally {
            $mqtt->close();
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
