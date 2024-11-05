<?php

namespace App\Util;

use Illuminate\Http\Request;

class Arrays
{
    public static function getFilters(Request $request): array
    {
        return [
            'searchByName' => $request->input('searchByName'),
            'category' => $request->input('category'),
            'rating' => $request->input('rating'),
            'filterOrder' => $request->input('filterOrder'),
            'filterComment' => $request->input('filterComment'),
        ];
    }

    public static function getCategories(): array
    {
        return [
            'strings' => __('attributes.categories.strings'),
            'brass' => __('attributes.categories.brass'),
            'percussion' => __('attributes.categories.percussion'),
            'keyboards_pianos' => __('attributes.categories.keyboards_pianos'),
            'ethnic_traditional' => __('attributes.categories.ethnic_traditional'),
            'electronic_dj' => __('attributes.categories.electronic_dj'),
            'accessories' => __('attributes.categories.accessories'),
            'bowed_strings' => __('attributes.categories.bowed_strings'),
            'sheet_music_books' => __('attributes.categories.sheet_music_books'),
            'studio_recording' => __('attributes.categories.studio_recording'),
            'percussion' => __('attributes.categories.percussion'),
            'other' => __('attributes.categories.other'),
        ];
    }
}
