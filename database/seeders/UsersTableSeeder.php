<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => config('admin.admin_email'),
            'email_verified_at' => now(),
            'password' => Hash::make(config('admin.admin_password')),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
