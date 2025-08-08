<?php

use App\Models\Character;
use App\Models\NPC;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('npc_id')->nullable()->constrained('npcs')->cascadeOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('quantity')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
