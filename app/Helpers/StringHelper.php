<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class StringHelper
{
    public static function buildUniqueSlug($table, $id = 0, $slug){

        $allSlugs = self::getRelatedSlugs($table, $slug, $id);

        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        for ($i = 1; $i <= 999; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected static function getRelatedSlugs($table, $slug, $id = 0){
        return DB::table($table)->select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}