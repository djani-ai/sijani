<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;

class Tps extends Model
{
    use HasFactory, HasRoles;
    protected $guarded = [];

    public function kel(): BelongsTo
    {
        return $this->belongsTo(Kel::class, 'kel_id');
    }
    public function kec(): BelongsTo
    {
        return $this->belongsTo(Kec::class, 'kec_id');
    }
}
