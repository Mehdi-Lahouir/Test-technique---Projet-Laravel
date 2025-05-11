<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Carbon;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Réservations';
    protected static ?string $pluralModelLabel = 'Réservations';
    protected static ?string $modelLabel = 'Réservation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Utilisateur')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('property_id')
                    ->label('Bien')
                    ->options(Property::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                DatePicker::make('start_date')
                    ->label('Date de début')
                    ->required(),

                DatePicker::make('end_date')
                    ->label('Date de fin')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('ID')
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Utilisateur')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('property.name')
                ->label('Bien')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('start_date')
                ->label('Début')
                ->date('d/m/Y')
                ->sortable(),

            Tables\Columns\TextColumn::make('end_date')
                ->label('Fin')
                ->date('d/m/Y')
                ->sortable(),

            Tables\Columns\TextColumn::make('total_price')
                ->label('Total (€)')
                ->state(function ($record) {
                    $nights = Carbon::parse($record->start_date)
                        ->diffInDays(Carbon::parse($record->end_date));
                    return $record->property->price_per_night * $nights;
                })
                ->money('eur')
                ->sortable()
                ->toggleable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('user_id')
                ->label('Utilisateur')
                ->relationship('user', 'name'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()->label('Supprimer'),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make()->label('Supprimer la sélection'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit'   => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
