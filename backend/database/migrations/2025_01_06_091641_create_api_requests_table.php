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
        Schema::create('api_requests', function (Blueprint $table) {
            $table->id();
            $table->string('method'); // GET, POST, etc.
            $table->string('url'); // Request URL
            $table->string('ip'); // Request URL
            $table->json('headers')->nullable(); // Headers as JSON
            $table->json('body')->nullable(); // Request body as JSON
            $table->json('response')->nullable(); // Request body as JSON
            $table->timestamps(); // Created at, Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_requests');
    }
};
