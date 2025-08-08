<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NPC extends Model
{
    /** @use HasFactory<\Database\Factories\NPCFactory> */
    use HasFactory;

    protected $table = 'npcs';

    protected $guarded = [];

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function spells(): HasMany
    {
        return $this->hasMany(Spell::class);
    }
}
