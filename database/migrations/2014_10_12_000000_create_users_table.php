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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unit_no')->nullable(true);
            $table->string('first_name');
            $table->string('middle_name')->nullable(true);
            $table->string('last_name');
            $table->string('name_ext')->nullable(true);
            $table->enum('gender', ['MALE', 'FEMALE'])->nullable(true);
            $table->tinyInteger('age')->nullable(true);
            $table->string('org_code')->nullable(true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['ADMIN', 'ORGANIZER', 'PARTICIPANT'])->default('PARTICIPANT');
            $table->enum('active_flag', ['Y', 'N'])->default('Y');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
