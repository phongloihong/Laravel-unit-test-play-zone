<?php

namespace App\Http\ViewComposers;

use App\Channel;
use Illuminate\View\View;

class ChannelComposer
{
	protected $channels = [];

    /**
     * Create channel composer
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
