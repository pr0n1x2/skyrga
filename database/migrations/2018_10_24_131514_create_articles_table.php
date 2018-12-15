<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('admin_id');
            $table->string('theme');
            $table->text('message');
            $table->string('file_attache', 40)->nullable();
            $table->string('file_attache_name')->nullable();
            $table->decimal('price', 8, 2);
            $table->date('deadline');
            $table->string('file_result', 40)->nullable();
            $table->string('file_result_name')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->index('user_id');
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
        Schema::dropIfExists('articles');
    }
}
