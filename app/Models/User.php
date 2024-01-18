<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Filament\Http\Responses\Auth\RegistrationResponse;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //change user avatar image must implements has avatar
    public function getFilamentAvatarUrl(): ?string
    {
        return asset('/assets/images/logo1.png');
    }
    //check if user role is applicant
    public function is_applicant(): bool
    {
        return Auth()->user()->hasRole('applicant');
    }
    //Assign applicant role
    public function assignR()
    {
        Auth()->user()->assignRole('applicant');
    }
    //Assign interviewer role
    public function assignRI($user)
    {
        $user->assignRole('interviewer');
    }
    //Assign reviewer role
    public function assignRR($user)
    {
        $user->assignRole('reviewer');
    }
    public static function getForm()
    {
        return [
            Hidden::make('user_id'),
            TextInput::make('name')
                ->label(__('tqdum.user.name'))
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label(__('tqdum.user.email'))
                // ->disabledOn('edit')
                ->required(),
            // ->unique(ignoreRecord: true),
            TextInput::make('password')
                ->label(__('tqdum.user.password'))
                ->password()
                ->required()
                ->maxLength(255),
        ];
    }
}
