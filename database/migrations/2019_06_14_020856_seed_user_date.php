<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUserDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user_date = [
            'name'       => 'wade',
            'email'      => '123456@qq.com',
            //密码123456加密
            'password'   => '$2y$10$W.1Zj88vd0ZZ30Yrd.AE3.inM05U/cHzY5oSB7YltdT16fRgCwEkq',
            'phone'      => '123456',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        \DB::table('users')->insert($user_date);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('users')->truncate();
    }
}
