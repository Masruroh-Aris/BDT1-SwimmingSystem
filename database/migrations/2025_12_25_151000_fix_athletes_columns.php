<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign keys in separate steps to handle existence errors gracefully
        try {
            Schema::table('athletes', function (Blueprint $table) {
                $table->dropForeign('athletes_user_id_foreign');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('athletes', function (Blueprint $table) {
                $table->dropForeign('athletes_admin_id_foreign');
            });
        } catch (\Exception $e) {}

        Schema::table('athletes', function (Blueprint $table) {
            // Hapus kolom lama jika ada
            if (Schema::hasColumn('athletes', 'admin_id')) {
                $table->dropColumn('admin_id');
            }
            if (Schema::hasColumn('athletes', 'user_id')) {
                $table->dropColumn('user_id');
            }

            // Tambahkan club_id dan institution_id
            if (!Schema::hasColumn('athletes', 'club_id')) {
                $table->unsignedBigInteger('club_id')->nullable()->after('place_of_birth');
                $table->foreign('club_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('athletes', 'institution_id')) {
                $table->unsignedBigInteger('institution_id')->nullable()->after('club_id');
                $table->foreign('institution_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('athletes', function (Blueprint $table) {
            $table->dropForeign(['club_id']);
            $table->dropForeign(['institution_id']);
            $table->dropColumn(['club_id', 'institution_id']);
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }
};
