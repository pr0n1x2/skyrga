<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 70);
            $table->string('domain', 70);
            $table->integer('group_id');
            $table->integer('mail_account_id');
            $table->integer('reserve_mail_account_id')->nullable();
            $table->string('business_name', 140);
            $table->string('address1', 60);
            $table->string('address2', 60)->nullable();
            $table->string('city', 40);
            $table->string('state', 30);
            $table->string('state_shortcode', 2);
            $table->string('zip', 10);
            $table->string('phone', 20);
            $table->string('security_answer_mother', 30);
            $table->string('security_answer_pet', 30);
            $table->text('blog_name');
            $table->text('about');
            $table->text('anchor');
            $table->text('main_anchor');
            $table->string('field1')->nullable();
            $table->string('field2')->nullable();
            $table->string('field3')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();

            $table->index('group_id');
            $table->index('mail_account_id');
            $table->index('reserve_mail_account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
