<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'description','price' , 'user_id',
    ];

    public function owner()
    {
        return $this->hasOne("App\User", "id", "user_id");
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}
