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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')->disabled(),
                Forms\Components\TextInput::make('state')->disabled(),
                Forms\Components\Select::make('user')
                    ->columnSpanFull()
                    ->relationship(titleAttribute: 'email')
                    ->disabled(),
                Forms\Components\Repeater::make('product')
                    ->columnSpanFull()
                    ->relationship()
                    ->disabled()
                    ->schema([
                        Forms\Components\TextInput::make('id'),
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\TextInput::make('price'),
                        Forms\Components\TextInput::make('count'),
                        Forms\Components\Select::make("size")
                            ->relationship('size', 'title'),
                        Forms\Components\Select::make('color')
                            ->relationship("color", "title")
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('user.email'),
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
