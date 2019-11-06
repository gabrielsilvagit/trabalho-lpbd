<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
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
