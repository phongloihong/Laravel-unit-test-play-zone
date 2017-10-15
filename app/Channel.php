<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}

	/**
	 * Get path to channel
	 * @return string
	 */
	public function path()
	{
		return "/threads/{$this->slug}";
	}

    public function threads()
    {
    	return $this->hasMany(Thread::class);
    }
}
