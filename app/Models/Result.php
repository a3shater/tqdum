<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'result',
        'criteria_id',
        'interview_result_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'criteria_id' => 'integer',
        'interview_result_id' => 'integer',
    ];

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function interviewResult(): BelongsTo
    {
        return $this->belongsTo(InterviewResult::class);
    }
}
