<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->disabled(),

                Forms\Components\TextInput::make('state')
                    ->disabled(),

                Forms\Components\TextInput::make('phone')
                    ->columnSpanFull()
                    ->disabled(),

                Forms\Components\Select::make('user')
                    ->columnSpanFull()
                    ->disabled()
                    ->relationship(titleAttribute: 'name'),

                Forms\Components\Repeater::make('product')
                    ->columnSpanFull()
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\TextInput::make('price'),
                        Forms\Components\TextInput::make('count'),
                        Forms\Components\Select::make('size_id')
                            ->relationship('size', 'title'),
                        Forms\Components\Select::make('color_id')
                            ->relationship('color', 'title')
                    ])->disabled()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('state'),
                Tables\Columns\TextColumn::make('updated_at')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
