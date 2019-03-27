<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultUserToProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->enum('gender', ['female','male'])->after('gmail_password');
            $table->string('username', 40)->after('gender');
            $table->string('password', 25)->after('username');
            $table->string('prefix', 10)->after('password');
            $table->string('firstname', 25)->after('prefix');
            $table->string('middlename', 25)->after('firstname');
            $table->string('lastname', 25)->after('middlename');
            $table->date('birthday')->nullable()->after('lastname');
            $table->string('position', 80)->after('birthday');
            $table->string('url1', 191)->after('position');
            $table->string('url2', 191)->after('url1');
            $table->string('url3', 191)->after('url2');
            $table->string('primary_domain_word', 191)->after('url3');
            $table->string('secondary_domain_word', 191)->after('primary_domain_word');
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
            $table->dropColumn('gender');
            $table->dropColumn('username');
            $table->dropColumn('password');
            $table->dropColumn('prefix');
            $table->dropColumn('firstname');
            $table->dropColumn('middlename');
            $table->dropColumn('lastname');
            $table->dropColumn('birthday');
            $table->dropColumn('position');
            $table->dropColumn('url1');
            $table->dropColumn('url2');
            $table->dropColumn('url3');
            $table->dropColumn('primary_domain_word');
            $table->dropColumn('secondary_domain_word');
        });
    }
}
