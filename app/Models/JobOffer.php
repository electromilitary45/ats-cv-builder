<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobOffer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'company',
        'url',
        'published_at',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cv(): HasOne
    {
        return $this->hasOne(CV::class, 'job_offer_id');
    }
}
