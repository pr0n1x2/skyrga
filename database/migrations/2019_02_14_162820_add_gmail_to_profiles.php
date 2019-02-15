<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGmailToProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('gmail')->nullable()->after('reserve_mail_account_id');
            $table->string('gmail_password', 40)->nullable()->after('gmail');
            $table->string('proxy', 80)->nullable()->after('main_anchor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('gmail');
            $table->dropColumn('gmail_password');
            $table->dropColumn('proxy');
        });
    }
}
