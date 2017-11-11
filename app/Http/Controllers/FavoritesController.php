<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Reply $reply
     */
    function store(Reply $reply)
    {
        $reply->addFavorite();
        return back();
    }
}
