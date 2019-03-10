<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'thing_id', 'start', 'end', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function thing()
    {
        return $this->belongsTo('App\Thing');
    }

}
