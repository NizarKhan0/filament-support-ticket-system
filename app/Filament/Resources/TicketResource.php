<?php

namespace App\Filament\Resources;

use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers\LabelsRelationManager;
use App\Filament\Resources\TicketResource\RelationManagers\CategoriesRelationManager;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            //utk setup column( macam grid/flexbox)
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->required(),

                Select::make('priority')
                    // $model ni dari atas sebab dah declare
                    ->options(self::$model::PRIORITY)
                    ->in(self::$model::PRIORITY)
                    ->required(),

                Select::make('assigned_to')

                    ->relationship('assignedTo', 'name')
                       //1
                    // ->options(
                    //     User::whereHas('roles', function ($query) {
                    //         $query->where('name', Role::ROLES['Agent']);
                    //     })->get()->pluck('name', 'id')->toArray()
                    // )

                    //2 display user yg login sekarang kecuali admin
                    ->options(
                        User::whereHas('roles', function ($query) {
                            $query->where('name', '!=', Role::ROLES['Admin']);
                        })
                        ->where('id', auth()->user()->id) // Menapis hanya untuk pengguna yang sedang log masuk
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray()
                    )

                    //3 display semua user kecuali admin
                    // ->options(
                    //     User::whereHas('roles', function ($query) {
                    //         $query->where('name', '!=', Role::ROLES['Admin']);
                    //     })->get()->pluck('name', 'id')->toArray()
                    // )
                    ->required(),

                // Checkbox::make('is_resolved'),

                Textarea::make('description'),

                Textarea::make('comment'),

                FileUpload::make('attachment'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            //utk buat filter apa yg kita nak
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->check() && auth()->user()->hasRole(Role::ROLES['Admin'])) {
                    // Admin can see all tickets
                    return Ticket::query();
                } else {
                    // Non-admins can only see tickets assigned to them
                    return $query->where('assigned_to', auth()->id());
                }
            })

            //utk setup by default sort nak letak apa
            ->defaultSort('created_at', 'desc')

            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->description(fn(Ticket $record): string => $record?->description ?? '')
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->disabled(!auth()->user()->hasPermission('ticket_edit'))
                    ->selectablePlaceholder(false)
                    ->options(self::$model::STATUS)
                    ->sortable(),

                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->sortable()

                    //bole guna cara ni kalau dah declare dari model
                    ->colors([
                        'success' => self::$model::PRIORITY['Low'],
                        'warning' => self::$model::PRIORITY['Medium'],
                        'danger' => self::$model::PRIORITY['High'],
                    ]),

                //ini cara terus define mcm dalam filament v3
                // ->color(fn (string $state): string => match ($state) {
                //     'Low' => 'success',
                //     'Medium' => 'warning',
                //     'High' => 'danger',
                // }),

                // ini dari model relation function
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignedBy.name')
                    ->searchable(),
                Tables\Columns\TextInputColumn::make('comment')
                    ->disabled(!auth()->user()->hasPermission('ticket_edit')),
                Tables\Columns\ImageColumn::make('attachment')
                    ->square(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(self::$model::STATUS),
                SelectFilter::make('priority')
                    ->options(self::$model::PRIORITY),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            LabelsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
            'view' => Pages\ViewTicket::route('/{record}'),
        ];
    }
}