<?php

namespace App\Filters;

use Illuminate\Http\Request;

/**
* 
*/
abstract class Filters
{
	protected $request, $builder;
	/**
	 * Resigted filters to operate upon
	 * @var array
	 */
	protected $filters = [];

	/**
	 * create new ThreadFilter instance
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Apply filters to thread
	 * @param  Builder $builder
	 * @return Builder
	 */
	public function apply($builder)
	{
		$this->builder = $builder;

		foreach($this->getFilters() as $filter => $value) {
			if (method_exists($this, $filter))
			
			$this->$filter($value);
		}

		return $this->builder;
	}

	/**
	 * fetch all available filters from request
	 * @return array
	 */
	public function getFilters()
	{
		// if laravel 5.5 ->only()
		return $this->request->intersect($this->filters);
	}
}