<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Deepanjalee',
                'email' => 'deepanjalee.s.k27@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$LwHONvvipxRcuLC4ID5QGOgUgYFs0M0cVjVfCXHz4Pks8OQUEURlO',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => 'loGcb7NEdjDkL9P1opbLNb5KXYwEAiyBi2r5nlzWwmlIcxXwe9uApwJLJRPZ',
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2024-09-09 06:59:47',
                'updated_at' => '2024-09-16 08:47:03',
                'first_name' => 'deepanjalee',
                'last_name' => 'kathriarachchi',
                'nic' => NULL,
                'salary_per_day' => NULL,
                'user_type' => '1',
                'active' => 1,
            ),
        ));
        
        
    }
}