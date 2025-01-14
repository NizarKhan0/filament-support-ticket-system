<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers\CategoriesRelationManager;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->required(),

                Select::make('priority')
                    // $model ni dari atas sebab dah declare
                    ->options(self::$model::PRIORITY),

                Select::make('assigned_to')
                    ->relationship('assignedTo', 'name'),

                // Checkbox::make('is_resolved'),

                Textarea::make('comment'),

                Textarea::make('description')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->description(fn (Ticket $record): string => $record->description),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                    // ->enum(self::$model::STATUS),
                Tables\Columns\TextColumn::make('priority')
                    ->badge(),
                    // ->enum(self::$model::PRIORITY),
                    //ini dari model relation function
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignedBy.name')
                    ->searchable(),
                Tables\Columns\TextInputColumn::make('comment'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}