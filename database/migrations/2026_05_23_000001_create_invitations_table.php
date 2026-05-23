<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Nombre del invitado
            $table->enum('type', ['individual', 'familia'])->default('individual');
            $table->string('link_id', 16)->unique();         // Token único para el link personalizado
            $table->enum('status', ['pending', 'confirmed', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
