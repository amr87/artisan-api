<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

//        Schema::create("workshops", function(Blueprint $table) {
//            $table->increments('id');
//            $table->integer('user_id')->unsigned();
//            $table->integer('district_id')->unsigned();
//            $table->integer('category_id')->unsigned();
//            $table->string('name', '128');
//            $table->text('description')->nullable();
//            $table->text('address');
//            $table->double('longitude',15, 8)->nullable();
//            $table->double('latitude', 15, 8)->nullable();
//            $table->enum('type', ['0', '1'])->default('0');
//            $table->integer('views')->length(11)->default(0);
//            $table->foreign('user_id')
//                    ->references('id')
//                    ->on('users')
//                    ->onDelete('cascade');
//
//            $table->foreign('district_id')
//                    ->references('id')
//                    ->on('districts')
//                    ->onDelete('cascade');
//
//            $table->foreign('category_id')
//                    ->references('id')
//                    ->on('categories')
//                    ->onDelete('cascade');
//            $table->timestamps();
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
        
        // Schema::drop("workshops");
    }

}
