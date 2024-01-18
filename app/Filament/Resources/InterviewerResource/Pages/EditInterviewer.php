<?php

namespace App\Filament\Resources\InterviewerResource\Pages;

use App\Filament\Resources\InterviewerResource;
use App\Models\Interviewer;
use Illuminate\Validation\Rule;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;



class EditInterviewer extends EditRecord
{
    protected static string $resource = InterviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = Interviewer::find($data['id'])->user;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        return $data;
    }



    protected function mutateFormDataBeforeSave(array $data): array
    {

        $user_id = $data['user_id'];
        $validationRules = [
            'email' => [
                Rule::unique('users')->ignore($user_id),
            ],
        ];
        unset($data['user_id']);
        $validator = \Illuminate\Support\Facades\Validator::make($data, $validationRules);
        if (!$validator->fails()) {
            $user = User::find($user_id);
            $user->update($data);
            $data = [];
            $data['user_id'] = $user_id;
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
