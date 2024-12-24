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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            $table->text('particulars')->nullable(true);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');

            $table->date('reg_start_date');
            $table->date('reg_end_date');
            $table->time('reg_start_time');
            $table->time('reg_end_time');
            
            $table->integer('no_of_participants');
            $table->enum('status',['PENDING','ONGOING','FINISHED'])->default('PENDING');
            $table->integer('created_by');
            $table->integer('certificate_id')->nullable(true);
            $table->integer('evaluation_id')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
