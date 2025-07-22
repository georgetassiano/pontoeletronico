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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf')->unique();
            $table->string('position');
            $table->date('birth_date');
            $table->string('cep');
            $table->string('street');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('district');
            $table->string('city');
            $table->string('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
