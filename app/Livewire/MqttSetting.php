<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Bluerhinos\phpMQTT;
use Exception;
use Illuminate\Support\Facades\Log;

class MqttSetting extends Component
{

    public $server, $port, $username, $password, $data;

    public $client_id = 'mqttx_20cbc973', $server_info = [];

    public function mount()
    {
        $this->data = DB::table('mqtt_connection')->first();
        if (isset($this->data)) {
            $this->server = $this->data->server_name;
            $this->port = $this->data->port_number;
            $this->username = $this->data->username;
            $this->password = $this->data->password;
        }
    }
    public function CheckConnection()
    {
        $this->validate(
            [
                'server' => ['required'],
                'port' => ['required', 'numeric'],
                'username' => ['required'],
                'password' => ['required'],
            ],
            [
                'server.required' => 'The Mqtt server is required.',
                'port.required' => 'The Mqtt port is required.',
                'port.numeric' => 'Format is incorrect.',
                'username.required' => 'Username is required.',
                'password.required' => 'Password is required.',
            ]
        );
        $mqtt = new phpMQTT($this->server, $this->port, $this->client_id);
        try {
            if (!$mqtt->connect(true, NULL, $this->username, $this->password)) {
                $this->dispatch('Error:Alert');
            } else {
                $this->dispatch('Success:Alert');
            }
        } catch (\Exception $e) {
            $this->dispatch('Error:Alert');
        }
    }
    public function SaveConfig()
    {

        $this->dispatch('SaveAlert');
    }
    public function confirm_to_save()
    {
        $this->server_info[] = [
            'server_name' => $this->server,
            'port_number' => $this->port,
            'username' => $this->username,
            'password' => $this->password,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        if (!empty($this->data)) {
            DB::table('mqtt_connection')
                ->where('id', $this->data->id)
                ->update([
                    'server_name' => $this->server,
                    'port_number' => $this->port,
                    'username' => $this->username,
                    'password' => $this->password,
                    'updated_at' => Carbon::now(),
                ]);
        } else {
            DB::table('mqtt_connection')->insert($this->server_info);
        }
        $this->dispatch('ConfirmSave');
    }


    public function render()
    {
        return view('livewire.mqtt-setting');
    }
}






/*  public function CheckConnection()
     {
         $server = '202.28.244.150';
         $port = 1883;
         $username = 'mqttuser1';
         $password = 'mqtt[user1]';
         $client_id = 'mqttx_20cbc973';

         $mqtt = new phpMQTT($server, $port, $client_id);

         try {
             if (!$mqtt->connect(true, NULL, $username, $password)) {
                 throw new Exception('ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ MQTT');
             }

             $mqtt->publish('cmnd/tasmota_4D99F0/Power1', 'toggle', 0);
             $this->status = 'ส่งข้อความสำเร็จ';
         } catch (\Exception $e) {
             $this->status = 'ข้อผิดพลาด: ' . $e->getMessage();
             Log::error('MQTT Error: ' . $e->getMessage());
         } finally {
             $mqtt->close();
         }
     } */
