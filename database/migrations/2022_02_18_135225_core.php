<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\CoreSeed;
use Illuminate\Support\Facades\Artisan;

class Core extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //daily task
        Schema::create('core_daily_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('week', 20);
            $table->string('site', 75);
            $table->string('district', 75);
            $table->string('ticket')->default();
            $table->string('type', 20);
            $table->string('subject', 150);
            $table->string('raisedby', 150);
            $table->string('position', 75)->nullable();
            $table->string('department', 75)->nullable();
            $table->integer('days')->default(0);
            $table->boolean('hitmiss')->default(false)->nullable();
            $table->boolean('status')->default(false)->nullable();
            $table->boolean('sla')->default(false)->nullable();
            $table->string('remarks', 150)->nullable();
            $table->boolean('publish')->default(false);
            $table->string('agent', 75);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        //soption
        Schema::create('core_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('soptiontype', 20);
            $table->string('name', 20);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        // Run the Core database Seeder
        // Artisan::call('db:seed', ['--class' => CoreSeed::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_daily_tasks');
        Schema::dropIfExists('core_options');
        Schema::dropIfExists('InnoDB');
    }
}
