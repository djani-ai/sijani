<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;

class Kel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kec(): BelongsTo
    {
        return $this->belongsTo(Kec::class, 'kec_id');
    }
}
