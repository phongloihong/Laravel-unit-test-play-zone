<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Favoriable;
/**
 * @property mixed id
 */
class Reply extends Model
{
    use Favoriable;

    protected $guarded = [];
    protected $with = ['owner', 'favorites'];

    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
