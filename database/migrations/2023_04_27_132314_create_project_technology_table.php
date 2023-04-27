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
        // Creazione Tabella Ponte per Relazione: Project(s) [N:N] Technology(ies)
        Schema::create('project_technology', function (Blueprint $table) {

            // Colonna FK relativa a Entita' 'Project'
            // Setto i Campi della Relazione nel DB con valori 'Cascade' per permettere eliminazione a Cascata 
            // in caso di cancellazione di un Entita'
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE')->onUpdate('CASCADE');

            // Colonna FK relativa a Entita' 'Technology'
            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technology');
    }
};
