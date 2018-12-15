<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('admin_id')->nullable();
            $table->text('message');
            $table->dateTime('date');

            $table->index('article_id');
            $table->index('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_messages');
    }
}
