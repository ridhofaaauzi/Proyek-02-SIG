<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistrictDataResource\Pages;
use App\Filament\Resources\DistrictDataResource\RelationManagers;
use App\Models\DistrictData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistrictDataResource extends Resource
{
    protected static ?string $model = DistrictData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('district_id')
                    ->required()
                    ->options(
                        \App\Models\District::all()->pluck('name', 'id')
                    ),
                Forms\Components\TextInput::make('broad')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('year')
                    ->required(),
                Forms\Components\select::make('birthrate_id')
                    ->required()
                    ->options(
                        \App\Models\BirthRate::all()->pluck('total', 'id')
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('district.name')
                    ->label('District Name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('broad')
                    ->label('Broad')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total Population')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('year'),

                Tables\Columns\TextColumn::make('birthRate.total')
                    ->label('2020')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistrictData::route('/'),
            'create' => Pages\CreateDistrictData::route('/create'),
            'edit' => Pages\EditDistrictData::route('/{record}/edit'),
        ];
    }
}