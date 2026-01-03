<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Versi bersih untuk instalasi baru
        if (!Schema::hasTable('athletes')) {
            Schema::create('athletes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->date('birth_date');
                $table->string('gender');
                $table->string('place_of_birth')->nullable();
                
                $table->unsignedBigInteger('club_id')->nullable();
                $table->unsignedBigInteger('institution_id')->nullable();

                $table->foreign('club_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('institution_id')->references('id')->on('users')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
