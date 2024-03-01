<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Constants\OrderState;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Confirm Order')
                ->requiresConfirmation()
                ->color('success')
                ->action('setStateToOrdered')
        ];
    }


    public function setStateToOrdered()
    {
        if ($this->record->state == OrderState::PENDING->value) {
            $this->record->state = OrderState::ORDERED->value;
            $this->record->save();

            Notification::make()
                ->success()
                ->title('Success')
                ->body("The record has been saved!")
                ->persistent()
                ->send();

        } else {

            Notification::make()
                ->danger()
                ->title('Error')
                ->body("The recording doesn't need to be confirmed")
                ->persistent()
                ->send();

        }
    }
}
