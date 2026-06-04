<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;

    protected $table = 'educations';

    protected $fillable = [
        'cv_id',
        'institution',
        'degree',
        'location',
        'start_date',
        'end_date',
        'description',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'sort_order' => 'integer',
        ];
    }

    public function cv(): BelongsTo
    {
        return $this->belongsTo(CV::class, 'cv_id');
    }
}
