<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use SoftDeletes;

    protected $table = 'certifications';

    protected $fillable = [
        'cv_id',
        'name',
        'issuer',
        'issued_at',
        'url',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'sort_order' => 'integer',
        ];
    }

    public function cv(): BelongsTo
    {
        return $this->belongsTo(CV::class, 'cv_id');
    }
}
