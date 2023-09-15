<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->integer('parent');
            $table->integer('user_id');
            $table->integer('location_id');
            $table->integer('type_id');
            $table->string('menu_name');
            $table->string('menu_link');
            $table->integer('new_tab');
             $table->enum('external_link ', ['Yes', 'No'])->default('No');
            $table->integer('ordering');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigations');
    }
};
