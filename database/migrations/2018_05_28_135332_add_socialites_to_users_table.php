<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialitesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *provider    区分当前使用的登录服务，例如QQ登录，那就存成qq。如果是微博登录，那就存weibo
     *uid    保存第三方登录提供的唯一识别id
     *avatar    第三方登录提供的用户头像
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable();
            $table->string('uid')->nullable();
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('provider');
            $table->dropColumn('uid');
            $table->dropColumn('avatar');
        });
    }
}
