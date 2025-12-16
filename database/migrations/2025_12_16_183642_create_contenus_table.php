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
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->text('texte');
            $table->datetime('datepub');
            $table->string('statut');
            $table->datetime('dateval');

            $table->unsignedBigInteger('region');
            $table->foreign('region')
              ->references('id')
              ->on('regions')
              ->onDelete('cascade');

            $table->unsignedBigInteger('langue');       
            $table->foreign('langue')
              ->references('id')
              ->on('langues')
              ->onDelete('cascade');

            $table->unsignedBigInteger('type');       
            $table->foreign('type')
              ->references('id')
              ->on('typecontenus')
              ->onDelete('cascade');
            
            $table->unsignedBigInteger('auteur');       
            $table->foreign('auteur')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

            $table->unsignedBigInteger('moderateur');       
            $table->foreign('moderateur')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
            
            $table->unsignedBigInteger('parent')->default(0);       
            $table->foreign('parent')
              ->references('id')
              ->on('contenus')
              ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
