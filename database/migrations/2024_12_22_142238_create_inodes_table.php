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
        Schema::create('inodes', function (Blueprint $table) {
            // PK
            $table->id();
            $table->bigInteger('users_id')->unsigned()->nullable(false);
            $table->bigInteger('inodes_id')->unsigned()->nullable(false)->default(0);

            $table->string('name', 60);
            $table->timestamps();
            // FK
            $table->foreign('users_id')->references('id')->on('users');
            // $table->foreign('inodes_id')->references('id')->on('inodes')->cascadeOnUpdate()->noActionOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inodes');
    }
};
