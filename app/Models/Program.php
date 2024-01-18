<?php

namespace App\Models;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'start_date',
        'end_date',
        'student_count',
        'is_published',
        'fields',
        'interview_min_rate',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'fields' => 'array',
    ];

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(Applicant::class, 'applications');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->label(__('tqdum.program.name'))
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->label(__('tqdum.program.description'))
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            FileUpload::make('image')
                ->label(__('tqdum.program.image'))
                ->image()
                ->required(),
            DateTimePicker::make('start_date')
                ->label(__('tqdum.program.start_date'))
                ->required(),
            DateTimePicker::make('end_date')
                ->label(__('tqdum.program.end_date'))
                ->after('start_date')
                ->required(),
            TextInput::make('student_count')
                ->label(__('tqdum.program.student_count'))
                ->required()
                ->maxLength(255),
            Checkbox::make('is_published')
            ->label(__('tqdum.program.is_published')),
        ];
    }
}
