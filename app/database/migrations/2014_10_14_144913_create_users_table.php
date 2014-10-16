<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
    {
        $table->increments('id');
        $table->string('givenname',50);
        $table->string('surname',50);
        $table->string('username',50);
        $table->string('email',100)->unique();
        $table->string('photo',100);
        $table->string('password',100);
        $table->string('password_temp',100);
        $table->string('resetcode',100);
        $table->string('access',50);
        $table->string('active',5);
        $table->string('isdel',5);
        $table->timestamp('last_login');
        $table->string('remember_token',75);
        $table->timestamps();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
