<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en','id']);
        });
        $this->autoTranslateLabels();
    }

    private function autoTranslateLabels()
    {
        $this->translateLabels([
            Field::class,
            BaseFilter::class,
            Placeholder::class,
            Column::class,
            Select::class
        ]);
    }

    private function translateLabels(array $components = [])
    {
        foreach ($components as $component) {
            $component::configureUsing(function ($c): void {
                if ($c instanceof Field) {
                    $this->adjustForeignKeyLabels($c);
                }
                $c->translateLabel();
            });
        }
    }

    private function adjustForeignKeyLabels(Field $field)
    {
        $name = $field->getName();

        if (Str::endsWith($name, '_id')) {
            $relationName = Str::replaceLast('_id', '', $name);
            $modelClass = $this->getModelClassFromRelation($relationName);

            if ($modelClass) {
                $tableName = (new $modelClass)->getTable();

                $label = Str::singular(ucwords(str_replace('_', ' ', $tableName)));

                $field->label($label);
            }
        }
    }

    private function getModelClassFromRelation(string $relationName)
    {
        $models = [
            'birthrate' => \App\Models\BirthRate::class,
            'birthyear' => \App\Models\BirthYear::class,
            'city' => \App\Models\City::class,
            'district_data' => \App\Models\DistrictData::class,
            'district' => \App\Models\District::class
        ];

        return $models[strtolower($relationName)] ?? null;
    }
}
