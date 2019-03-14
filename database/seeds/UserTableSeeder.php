<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Thing;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=> app('hash')->make('admin')
        ]);

        factory(User::class, 10)->create()->each(function ($user) {
            $user->things()->saveMany(factory(Thing::class, $user->id)->make());
        });
    }
}
