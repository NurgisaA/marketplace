<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Constants\OrderState;
use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('confirm')->action(function () {
                $order = Order::find($this->data['id']);
                if (in_array($order->state, [OrderState::ORDERED->value, OrderState::DRAFT->value])) {
                    return;
                }
                $order->state = OrderState::ORDERED->value;
                $order->save();
            })->color('success'),
        ];
    }
}
