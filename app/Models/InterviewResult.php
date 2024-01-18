<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InterviewResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note',
        'interviewer_id',
        'interview_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'interviewer_id' => 'integer',
        'interview_id' => 'integer',
    ];

    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(Interviewer::class);
    }

    public function interview(): BelongsTo
    {
        return $this->belongsTo(Interview::class);
    }

    public function criterias(): BelongsToMany
    {
        return $this->belongsToMany(Criteria::class, 'results');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
