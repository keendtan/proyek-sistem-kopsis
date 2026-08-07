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
        if (! Schema::hasTable('users_kita')) {
            Schema::create('users_kita', function (Blueprint $table) {
                $table->id();
                $table->string('username')->unique();
                $table->string('password');
                $table->string('email')->unique();
                $table->string('role')->default('user');
                $table->timestamps();
            });

            return;
        }

        if (! Schema::hasColumn('users_kita', 'username')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->string('username')->nullable()->unique();
            });
        }

        if (! Schema::hasColumn('users_kita', 'password')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->string('password')->nullable();
            });
        }

        if (! Schema::hasColumn('users_kita', 'email')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->string('email')->nullable()->unique();
            });
        }

        if (! Schema::hasColumn('users_kita', 'role')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->string('role')->nullable()->default('user');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('users_kita')) {
            return;
        }

        if (Schema::hasColumn('users_kita', 'role')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }

        if (Schema::hasColumn('users_kita', 'email')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }

        if (Schema::hasColumn('users_kita', 'password')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->dropColumn('password');
            });
        }

        if (Schema::hasColumn('users_kita', 'username')) {
            Schema::table('users_kita', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }
    }
};
