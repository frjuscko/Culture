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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();

            $table->string('statut');
            $table->text('texte');
            $table->integer('note')->nullable();

            $table->unsignedBigInteger('contenu');       
            $table->foreign('contenu')
              ->references('id')
              ->on('contenus')
              ->onDelete('cascade');

            $table->unsignedBigInteger('utilisateur');       
            $table->foreign('utilisateur')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
