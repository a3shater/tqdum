<?php

use App\Models\Applicant;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\RegistrationResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class Register extends BaseRegister
{

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function register(): ?RegistrationResponse
    {
        $return = parent::register();
        Auth::user()->assignR();
        Applicant::create(['user_id'=>Auth::user()->id]);
        return $return;
    }
}
