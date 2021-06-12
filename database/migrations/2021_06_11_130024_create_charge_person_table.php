<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_person', function (Blueprint $table) {
            $table->foreignId('person_id')
                ->constrained('people', 'id')
                ->onDelete('cascade');
            $table->foreignId('charge_id')
                ->constrained('charges', 'id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_person');
    }
}
