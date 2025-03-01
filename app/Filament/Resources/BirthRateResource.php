<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BirthRateResource\Pages;
use App\Filament\Resources\BirthRateResource\RelationManagers;
use App\Helpers\ModelLabelHelper;
use App\Models\BirthRate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BirthRateResource extends Resource
{
    protected static ?string $model = BirthRate::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

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
                Forms\Components\select::make('birthyear_id')
                    ->required()
                    ->options(
                        \App\Models\BirthYear::all()->pluck('year', 'id')
                    )
                    ->searchable(),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('district.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('birthYear.year')
                    // ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBirthRates::route('/'),
            'create' => Pages\CreateBirthRate::route('/create'),
            'edit' => Pages\EditBirthRate::route('/{record}/edit'),
        ];
    }
}
