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
    Schema::create('media', function (Blueprint $table) {
        $table->id();
        $table->enum('type', ['anime', 'film']);
        $table->string('title')->unique();
        $table->unsignedSmallInteger('year');
        $table->float('rating');
        $table->boolean('is_available')->default(true);

        // khusus Anime
        $table->unsignedInteger('episodes')->nullable();
        $table->string('studio')->nullable();
        // khusus Film
        $table->unsignedInteger('duration')->nullable();
        $table->string('director')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('media');
}
};
