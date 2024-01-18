<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note',
        'reviewer_id',
        'application_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reviewer_id' => 'integer',
        'application_id' => 'integer',
    ];

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Reviewer::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
