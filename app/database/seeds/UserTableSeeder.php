<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
      
        	'givenname' 	=> 	'Admin',
        	'surname' 		=>	'Istrator',
        	'username' 		=>	'admin',
        	'email' 		=> 	'admin@movies.app',
        	'password'		=>	'password',
        	'access'		=>	1,
        	'active'		=> 	0

        	));
    }

}