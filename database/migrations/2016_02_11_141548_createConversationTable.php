<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("conversations", function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->nullable();
            $table->timestamps();
        });

        Schema::create("conversation_user", function(Blueprint $table) {

            $table->integer('conversation_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('conversation_id')
                    ->references('id')
                    ->on('conversations')
                    ->onDelete('cascade');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->primary(['conversation_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop("conversations");
        Schema::drop("conversation_user");
    }

}
