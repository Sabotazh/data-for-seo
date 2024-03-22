<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dataforseos', function (Blueprint $table) {
            $table->id();
            $table->json('excluded_target')->nullable();
            $table->string('target_domain')->nullable();
            $table->json('referring_domain')->nullable();
            $table->json('rank')->nullable();
            $table->json('backlinks')->nullable();
            $table->timestamps();
            $table->string('parameter')->default('wrong_domain');
            $table->json('original_response')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dataforseos');
    }
};
