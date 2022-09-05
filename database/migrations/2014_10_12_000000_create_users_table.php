<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->foreignId('role_id');
            $table->foreignId('organization_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table
                ->enum('gender', ['Male', 'Female', 'Other', 'Undisclosed'])
                ->default('Male');
            $table->string('mobile_number')->nullable();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table
            ->enum('type', ['full-time', 'part-time', 'contract', 'casual'])
            ->default('full-time');
        $table->string('document_letter_header')->nullable();
        $table->string('document_letter_footer')->nullable();
        $table->string('signature')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
