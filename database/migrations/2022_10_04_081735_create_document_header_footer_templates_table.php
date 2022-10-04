<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_header_footer_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->text('title');
            $table->text('header_file');
            $table->text('footer_file');
            $table->boolean('is_organization_default')->default(false);
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('document_header_footer_templates');
    }
};
