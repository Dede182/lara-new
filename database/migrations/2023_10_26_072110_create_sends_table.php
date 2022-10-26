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
        Schema::create('sends', function (Blueprint $table) {
            $table->id();
            $table->string("sender");
            $table->string('receiver');
            $table->json("message");
            $table->foreignId('receiver_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained()->cascadeOnDelete();
            $table->enum('status',['accepted','rejected'])->nullable();
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
        Schema::dropIfExists('sends');
    }
};
