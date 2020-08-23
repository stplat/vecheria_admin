<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
      [
        'name' => 'admin',
        'password' => Hash::make('password'), //$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        'remember_token' => Str::random(10),
        'updated_at' => now()->format('Y-m-d H:i:s'),
        'created_at' => now()->format('Y-m-d H:i:s')
      ]
    ]);
  }
}
