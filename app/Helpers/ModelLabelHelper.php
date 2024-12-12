<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ModelLabelHelper
{
    /**
     * Automatically translate the model label (singular).
     *
     * @param string $modelClass
     * @return string
     */
    public static function translateModelLabel(string $modelClass): string
    {
        $tableName = (new $modelClass)->getTable();

        $label = Str::singular(ucwords(str_replace('_', ' ', $tableName)));

        $labelPlural = Str::plural($label);

        return __($label === $tableName ? $label : $labelPlural);
    }

    /**
     * Automatically translate the plural model label.
     *
     * @param string $modelClass
     * @return string
     */
    public static function translatePluralModelLabel(string $modelClass): string
    {
        $tableName = (new $modelClass)->getTable();
        $label = Str::singular(ucwords(str_replace('_', ' ', $tableName)));

        // Return plural form of the label
        return __(Str::plural($label));
    }
}
