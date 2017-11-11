<?php
namespace App\Traits;

use App\Favorites;

trait Favoriable
{
    public function favorites()
    {
        return $this->morphMany(Favorites::class, 'favorited');
    }

    public function addFavorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($attributes)->exists()) {
            $this->favorites()->create($attributes);
        }
    }

    public function isFavorited()
    {
        if (auth()->check()) {
            return !! $this->favorites->where('user_id', auth()->id())->count();
        }
    }

    public function getFavoritesCount()
    {
        return $this->favorites->count();
    }
}
