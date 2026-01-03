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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('athlete_name');
            $table->string('event_name'); // e.g., 'Freestyle-50M-Men's'
            $table->string('lane')->nullable();
            $table->string('meet_name');
            $table->string('time_result'); // storing as string for flexibility, but we will sort carefully
            $table->integer('points')->nullable();
            
            // Calculated Fields
            $table->integer('rank')->nullable();
            $table->string('medal')->nullable(); // Gold, Silver, Bronze
            
            $table->text('note')->nullable();
            $table->string('status')->default('Done');
            $table->string('input_by')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
