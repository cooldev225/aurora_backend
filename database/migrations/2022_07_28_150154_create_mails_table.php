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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->foreignId('from_user_id');
            $table->json('to_user_ids');
            $table->text('body')->nullable();
            $table->foreignId('reply_id')->nullable();
            $table->foreignId('thread_id')->nullable();
            $table
                ->enum('status', ['draft', 'sent', 'starred', 'deleted'])
                ->default('draft');
            $table->dateTime('sent_at')->nullable();
            $table->json('attachment')->nullable();
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
        Schema::dropIfExists('mails');
    }
};
