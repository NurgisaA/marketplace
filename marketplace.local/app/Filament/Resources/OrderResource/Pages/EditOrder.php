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
            Actions\Action::make('Confirm')->color('success')->action('setStateToOrdered')
        ];
    }

    public function setStateToOrdered()
    {
        if ($this->record->state == OrderState::PENDING->value) {

            $this->record->state = OrderState::ORDERED->value;
            $this->record->save();

            Notification::make()
                ->success()
                ->title('Record state changed')
                ->send();
        } else {
            Notification::make()
                ->danger()
                ->title("The record can't be changed")
                ->send();
        }
    }
}
