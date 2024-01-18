<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'application_id',
        'interview_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'program_id' => 'integer',
        'application_id' => 'integer',
        'interview_date' => 'datetime',
    ];

    public function interviewResults(): HasMany
    {
        return $this->hasMany(InterviewResult::class);
    }

    public function interviewers(): BelongsToMany
    {
        return $this->belongsToMany(Interviewer::class, 'interview_results');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
    //this power full way
    public function getFullnameAttribute()
    {
        return "ahmed work well";
    }
}
