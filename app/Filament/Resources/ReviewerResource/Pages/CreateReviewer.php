<?php

namespace App\Filament\Resources\ReviewerResource\Pages;

use App\Filament\Resources\ReviewerResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\Rule;
use Filament\Notifications\Notification;

class CreateReviewer extends CreateRecord
{
    protected static string $resource = ReviewerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $validationRules = [
            'email' => [
                Rule::unique('users'),
            ],
        ];
        unset($data['user_id']);
        $validator = \Illuminate\Support\Facades\Validator::make($data, $validationRules);
        if (!$validator->fails()) {
            $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']]);
            $user->assignRR($user);
            $data['user_id'] = $user->getKey();
            unset($data['password']);
            unset($data['email']);
            unset($data['name']);
            return $data;
        } else {
            Notification::make()
                ->danger()
                ->title('لم تنجح العملية.')
                ->icon('heroicon-o-exclamation-circle')
                ->send();
            $this->halt();
        }
    }
}
