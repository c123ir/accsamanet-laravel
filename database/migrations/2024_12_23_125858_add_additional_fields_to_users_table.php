<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 50)->nullable()->after('id');
            $table->string('last_name', 50)->nullable()->after('first_name');
            $table->string('phone_number', 20)->nullable()->after('email');
            $table->string('profile_pic', 255)->nullable()->after('phone_number');
            $table->string('start_date_shamsi', 10)->nullable()->after('profile_pic'); // به فرمت YYYY/MM/DD
            $table->string('end_date_shamsi', 10)->nullable()->after('start_date_shamsi'); // به فرمت YYYY/MM/DD
            $table->boolean('is_active')->default(true)->after('end_date_shamsi');
            $table->unsignedBigInteger('creator_user_id')->nullable()->after('is_active');

            // افزودن کلید خارجی برای creator_user_id
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // حذف کلید خارجی و فیلدها
            $table->dropForeign(['creator_user_id']);
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone_number',
                'profile_pic',
                'start_date_shamsi',
                'end_date_shamsi',
                'is_active',
                'creator_user_id',
            ]);
        });
    }
}