<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'description', 'filename'
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }

}
