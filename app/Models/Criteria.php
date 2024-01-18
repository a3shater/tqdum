<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criteria extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function interviewResults(): BelongsToMany
    {
        return $this->belongsToMany(InterviewResult::class, 'results');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
            ->label(__('tqdum.criteria.name'))
                ->required()
                ->maxLength(255),
        ];
    }
}
