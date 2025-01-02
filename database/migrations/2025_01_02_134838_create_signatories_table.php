<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('signatories', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');

            $table->string('signatory_1', 255)->nullable(true);
            $table->string('signatory_1_pos', 255)->nullable(true);

            $table->string('signatory_2', 255)->nullable(true);
            $table->string('signatory_2_pos', 255)->nullable(true);

            $table->string('signatory_3', 255)->nullable(true);
            $table->string('signatory_3_pos', 255)->nullable(true);

            $table->string('signatory_4', 255)->nullable(true);
            $table->string('signatory_4_pos', 255)->nullable(true);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatories');
    }
};
