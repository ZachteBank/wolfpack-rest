<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWolvesAndPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('wolves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ["male", "female"]); // I would normally add a third option for gender, something like "other" or "Prefer not to Answer"
            $table->date('birthday');
            $table->json('location');
            $table->foreignId('pack_id')->nullable()->constrained('packs')->nullOnDelete();
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
        Schema::dropIfExists('wolves');
        Schema::dropIfExists('packs');
    }
}
