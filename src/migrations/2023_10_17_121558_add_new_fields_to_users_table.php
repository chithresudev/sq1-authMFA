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
        Schema::table('users', function (Blueprint $table) {
            $table->text('google2fa_secret')->after('email')->nullable();
            $table->enum('mfa_type', ['sms', 'email', 'totp'])->after('email')->default('totp');
            $table->enum('activity', ['online', 'offline'])->after('password')->nullable();
            $table->enum('user_status', ['invite', 'register', 'mfa_register', 'completed'])->before('password')->default('invite')->nullable();
            $table->dateTime('last_activity_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
