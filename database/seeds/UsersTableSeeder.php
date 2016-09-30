<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = [
['id'=>'1', 'name'=>'Eliecer','email'=>'narvaez@gmail.com','password'=>'12345678']
];
foreach ($users as $user) {
User::create($user);
}
  }
}
