<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name', 20);
            $table->string('url', 20);
            $table->timestamps();
        });

        //submenu
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('submenu_name', 20);
            $table->string('link', 50);
            $table->integer('menu_id')->default(0);
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
        Schema::dropIfExists('menus');
        Schema::drapIfExists('sub_menus');
    }
}
