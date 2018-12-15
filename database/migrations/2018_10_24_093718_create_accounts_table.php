<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->integer('project_id');
            $table->integer('mail_account_id');
            $table->enum('gender', ['female', 'male']);
            $table->string('username', 40);
            $table->string('password', 25);
            $table->string('prefix', 10);
            $table->string('firstname', 25);
            $table->string('middlename', 25);
            $table->string('lastname', 25);
            $table->date('birthday');
            $table->string('address1', 60);
            $table->string('address2', 60);
            $table->string('city', 40);
            $table->string('state', 30);
            $table->string('state_shortcode', 2);
            $table->string('zip', 10);
            $table->string('phone', 20);
            $table->string('domain_word', 40);
            $table->tinyInteger('status')->default(0);
            $table->string('link_page')->nullable();
            $table->date('complete')->nullable();
            $table->timestamps();

            $table->index('profile_id');
            $table->index('project_id');
            $table->index('mail_account_id');
            $table->index('complete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
