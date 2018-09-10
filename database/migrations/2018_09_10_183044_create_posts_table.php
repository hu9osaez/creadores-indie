<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_discussion')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->text('body');
            $table->boolean('markdown')->default(false);
            $table->boolean('locked')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_discussion')->references('id')->on('discussions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
