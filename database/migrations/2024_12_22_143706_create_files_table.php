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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inodes_id')->nullable(false);
            $table->string('filename', 60)->nullable(false);
            $table->integer('size')->unsigned()->default(0);
            $table->string('type', 60);
            // $table->foreign('inodes_id')->references('id')->on('inodes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
