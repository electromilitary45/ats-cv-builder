<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class, 'cv_id')->orderBy('sort_order');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class, 'cv_id')->orderBy('sort_order');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'cv_id')->orderBy('sort_order');
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class, 'cv_id')->orderBy('sort_order');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(Language::class, 'cv_id')->orderBy('sort_order');
    }
}
