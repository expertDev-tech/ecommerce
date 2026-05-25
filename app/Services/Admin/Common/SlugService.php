<?php

namespace App\Services\Admin\Common;

use Illuminate\Support\Str;

class SlugService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function generateUniqueSlug(string $name,string $modelClass,?int $ignoreId = null): string
    {
        $slug = Str::slug($name);

        $originalSlug = $slug;

        $count = 1;

        while (

            $modelClass::where(
                'slug',
                $slug
            )

            ->when(
                $ignoreId,
                function ($query) use ($ignoreId) {

                    $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    );
                }
            )

            ->exists()

        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;
        }

        return $slug;
    }
}
