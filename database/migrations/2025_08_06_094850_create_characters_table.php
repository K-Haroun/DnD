<?php

use App\Models\Story;
use App\Models\User;
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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Story::class)->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('race');
            $table->string('class');
            $table->string('alignment');
            $table->integer ('level')->default(1);
            $table->unsignedInteger ('current_hp');
            $table->unsignedInteger ('max_hp');
            $table->text('backstory');
            $table->unsignedTinyInteger('armor_class');
            $table->unsignedTinyInteger('initiative');
            $table->unsignedTinyInteger('speed');
            $table->unsignedTinyInteger('strength');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
