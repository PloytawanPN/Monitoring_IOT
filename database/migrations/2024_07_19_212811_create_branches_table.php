<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->integer('status');
            $table->timestamps();
        });

        DB::table('branches')->insert([
            'branch_name' => 'Admin',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $b_id=DB::table('branches')->where('branch_name','Admin')->first();

        DB::table('users')->insert([
            'name' => 'Admin(ADMIN)',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('Admin@gmail.com'),
            'remember_token' => '',
            'branch_id' => $b_id->id,
            'status' => 1,
            'role' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
