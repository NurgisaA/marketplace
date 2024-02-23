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
            Actions\DeleteAction::make(),
            Actions\Action::make('Confirm')
                ->color('success')
                ->requiresConfirmation()
                ->action('setStateToOrdered')
//                ->url(fn(): string => route('filament.admin.resources.orders.index', ['post' => $this->record->id]))
        ];
    }

    public function setStateToOrdered(): void
    {
        if ($this->record->state == OrderState::PENDING->value) {
            $this->record->state = OrderState::ORDERED->value;
            $this->record->save();
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
