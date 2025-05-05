<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
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
                // …
            ])
            // …
        ;
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
