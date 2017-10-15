<?php

namespace App\Http\ViewComposers;

use App\Channel;
use Illuminate\View\View;

class ChannelComposer
{
	protected $channel = [];

	/**
	 * Create channel composer
	 * @return void
	 */
	public function __construct()
	{
		$this->channels = Channel::all();
	}

	/**
	 * Bind data to the view
	 * @param  View   $view 
	 * @return void       
	 */
	public function compose(View $view)
	{
		$view->with('channels', $this->channels);
	}
}
