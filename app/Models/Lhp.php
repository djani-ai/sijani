<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Spatie\Permission\Traits\HasRoles;

class Lhp extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function kel(): BelongsTo
    {
        return $this->belongsTo(Kel::class, 'kel_id');
    }
    public function kec(): BelongsTo
    {
        return $this->belongsTo(Kec::class, 'kec_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tahapan(): BelongsTo
    {
        return $this->belongsTo(Tahapan::class, 'tahapan_id');
    }
    public function spt(): BelongsTo
    {
        return $this->belongsTo(Spt::class, 'spt_id');
    }

    public static function query(): EloquentBuilder
    {
        // Batasi query hanya untuk pengguna yang sedang login
        return parent::query()->where('user_id', auth()->id());
    }

}
