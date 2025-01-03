<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistrictDataResource\Pages;
use App\Filament\Resources\DistrictDataResource\RelationManagers;
use App\Helpers\ModelLabelHelper;
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

    public static function getModelLabel(): string
    {
        return ModelLabelHelper::translateModelLabel(self::$model);
    }

    public static function getPluralModelLabel(): string
    {
        return ModelLabelHelper::translatePluralModelLabel(self::$model);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('district_id')
                    ->required()
                    ->options(
                        \App\Models\District::all()->pluck('name', 'id')
                    )
                    ->searchable(),
                Forms\Components\TextInput::make('area')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('population')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('year')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('district.name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('area')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('population')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('year'),

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
