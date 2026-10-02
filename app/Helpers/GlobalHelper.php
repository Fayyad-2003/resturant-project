<?php

use Illuminate\Support\Str;

/**
 * Generate a unique slug for a model
 * 
 * @param string $model Model name (e.g., 'Product', 'Category')
 * @param string $name The name to convert to slug
 * @return string The unique slug
 */
if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug(string $model, string $name): string
    {
        $modelClass = "App\\Models\\$model";

        if (!class_exists($modelClass)) {
            throw new \InvalidArgumentException("Model $model not found");
        }

        $slug = Str::slug($name);
        $count = 2;

        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
