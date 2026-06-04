<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CV extends Model
{
    use SoftDeletes;

    protected $table = 'cvs';

    protected $fillable = [
        'user_id',
        'job_offer_id',
        'full_name',
        'email',
        'phone',
        'location',
        'linkedin',
        'github',
        'professional_title',
        'professional_summary',
        'language',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobOffer(): BelongsTo
    {
        return $this->belongsTo(JobOffer::class);
    }
}
