<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Biens';
    protected static ?string $pluralModelLabel = 'Biens';
    protected static ?string $modelLabel = 'Bien';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nom du bien')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->rows(4),

            Forms\Components\TextInput::make('price_per_night')
                ->label('Prix par nuit (€)')
                ->required()
                ->numeric()
                ->minValue(0),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price_per_night')
                    ->label('Prix/nuit')
                    ->money('eur')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit'   => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
