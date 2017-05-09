<?php

use Illuminate\Database\Seeder;

class Customer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer')->insert([
		    'name' => 'vinh',
		    'email' => 'vinhht@gmail.com',
		    'password' => bcrypt('1234'),
	    ]);
    }
}
