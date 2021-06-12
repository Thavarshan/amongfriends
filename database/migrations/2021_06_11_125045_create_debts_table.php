<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignId('charge_id')
                ->constrained('charges', 'id')
                ->onDelete('cascade');
            $table->foreignId('person_id')
                ->constrained('people', 'id')
                ->onDelete('cascade');
            $table->string('owed_to');
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
        Schema::dropIfExists('debts');
    }
}
