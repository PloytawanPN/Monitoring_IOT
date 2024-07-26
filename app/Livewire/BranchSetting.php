<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class BranchSetting extends Component
{
    public $branch_list, $branch_row = [], $error_ms;

    public function updateStatus($branchId, $status)
    {
        DB::table('branches')->where('id', $branchId)->update(['status' => $status]);
        $this->dispatch('success:message');
    }

    public function updateStatus_row($index, $value)
    {
        $this->branch_row[$index]['status'] = $value;
    }

    public function add_row()
    {
        $this->branch_row[] = ['name' => '', 'status' => 1];
    }

    public function removeRow($index)
    {
        unset($this->branch_row[$index]);
        $this->branch_row = array_values($this->branch_row);
    }

    public function Savebranch()
    {
        try {
            //dd($this->branch_row);
            $this->branch_row = array_filter($this->branch_row, function ($row) {
                return trim($row['name']) !== '';
            });

            $this->branch_row = array_values($this->branch_row);

            // ดึงค่าของ 'name' ออกมาเป็น array และลบค่าที่ซ้ำ
            $names = array_column($this->branch_row, 'name');
            $uniqueNames = array_unique($names);

            // ใช้ array_filter เพื่อเก็บเฉพาะ array ที่มีชื่อไม่ซ้ำ
            $uniqueBranchRows = array_filter($this->branch_row, function ($item) use ($uniqueNames) {
                static $alreadySeen = [];
                if (in_array($item['name'], $alreadySeen)) {
                    return false;
                }
                $alreadySeen[] = $item['name'];
                return true;
            });

            $this->branch_row = $uniqueBranchRows;

            if ($this->branch_row != []) {
                try {
                    foreach ($this->branch_row as $key => $b_name) {
                        $this->validateBranchName($b_name['name'], $key);
                    }

                    $this->branch_row = array_map(function ($branch) {
                        return [
                            'branch_name' => $branch['name'],
                            'status' => $branch['status'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }, $this->branch_row);

                    DB::table('branches')->insert($this->branch_row);
                    foreach ($this->branch_row as $key => $b_name) {
                        $b_id = DB::table('branches')->where('branch_name', $b_name['branch_name'])->first();
                        $formattedName = str_replace(' ', '_', $b_name['branch_name']);
                        $formattedName = preg_replace('/[^a-zA-Z0-9_]/', '', $formattedName);
                        DB::table('users')->insert([
                            'name' => $b_name['branch_name'] . '(ADMIN)',
                            'email' => $formattedName . '@gmail.com',
                            'password' => Hash::make($formattedName . '@gmail.com'),
                            'remember_token' => '',
                            'branch_id' => $b_id->id,
                            'status' => 1,
                            'role' => 3,
                            'email_verified_at' => Carbon::now(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }

                    $this->branch_row = [];
                    $this->branch_list = DB::table('branches')
                        ->leftJoin('users', 'branches.id', '=', 'users.branch_id')
                        ->select('branches.id', 'branches.status', 'branches.branch_name', DB::raw('COUNT(users.id) as account_count'))
                        ->groupBy('branches.id', 'branches.status', 'branches.branch_name')
                        ->get();

                    $this->dispatch('success:message');
                } catch (\Throwable $th) {
                    $this->dispatch('error:already', ['message' => $this->error_ms]);
                }
            } else {
                $this->dispatch('error:notfound');
            }
        } catch (\Throwable $th) {
            $this->dispatch('error:message');
        }


    }

    private function validateBranchName($name, $id)
    {
        $this->validate([
            'branch_row.' . $id . '.name' => [
                function ($attribute, $value, $fail) {
                    $existingBranch = DB::table('branches')->where('branch_name', $value)->count();
                    if ($existingBranch != 0) {
                        $this->error_ms = "The branch name '{$value}' already exists.";
                        $fail("The branch name '{$value}' already exists.");
                    }
                },
            ],
        ]);
    }

    public function cancel()
    {
        $this->branch_row = [];
    }

    public function mount()
    {
        $this->branch_list = DB::table('branches')
            ->leftJoin('users', 'branches.id', '=', 'users.branch_id')
            ->select('branches.id', 'branches.status', 'branches.branch_name', DB::raw('COUNT(users.id) as account_count'))
            ->groupBy('branches.id', 'branches.status', 'branches.branch_name')
            ->get();
    }
    public function render()
    {
        return view('livewire.branch-setting');
    }
}
