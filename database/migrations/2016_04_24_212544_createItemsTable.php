<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //

//        Schema::create("items", function(Blueprint $table) {
//            $table->increments('id');
//            $table->integer('workshop_id')->unsigned();
//            $table->string('name', 128)->nullable();
//            $table->text('description')->nullable();
//            $table->decimal('price', 10, 2)->default('0.00');
//            $table->string('image', 128);
//            $table->integer('views')->length(11)->default(0);
//            $table->foreign('workshop_id')
//                    ->references('id')
//                    ->on('workshops')
//                    ->onDelete('cascade');
//            $table->timestamps();;
//            $table->softDeletes();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
//        Schema::drop("items");
    }

}
