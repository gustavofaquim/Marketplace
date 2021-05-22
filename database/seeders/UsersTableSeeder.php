<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Store;
use \App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* \DB::table('users')->insert([
              'name'=> 'Administrator',
              'email'=> 'admin@admin.com',
              'email_verified_at'=> now(),
              'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
              'remember_token'=>'gfjhgjfhgjfghjfghjfgff',  
        ]); */


        //criando usuários fakes
        /*$user = User::factory()
            ->count(30)  //Numero de usuário a ser criado
            ->has(Store::factory()) //Passando as lojas 
            ->create(); */


        
        User::factory()->count(20)->create()->each(function($user){
            $user->store()->save(Store::factory()->make());
        });
        
    }
}
