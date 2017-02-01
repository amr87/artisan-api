<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('type', ['0', '1'])->default('0');
            $table->integer('company_id')->after('id')->unsigned();
            $table->foreign('company_id')
                    ->references('id')
                    ->on('companies')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('type');
            $table->dropColumn('company_id');
        });
    }

}
