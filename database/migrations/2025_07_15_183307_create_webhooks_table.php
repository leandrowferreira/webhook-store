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
        Schema::create('webhooks', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('method', 10);
            $table->string('url', 2048);
            $table->json('headers');
            $table->json('query_parameters');
            $table->longText('body')->nullable();
            $table->string('content_type')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address', 45);
            $table->string('origin')->nullable();
            $table->integer('content_length')->nullable();
            $table->timestamps();

            $table->index(['created_at']);
            $table->index(['method']);
            $table->index(['ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};
