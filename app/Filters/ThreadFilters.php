<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{
	protected $filters = ['by', 'popular'];

	/**
	 * Filter query by a given username
	 * @param   string$username 
	 * @return  collection
	 */
	protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
	}

	/**
	 * Filter query get most popular threads
	 * @return $this
	 */
	protected function popular()
	{
		// reset orderBy
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}
}