<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = 'websites';
    protected $guarded = ['id'];
    protected $hidden = ['updated_at'];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getUrlAttribute($url)
    {
        return "http://{$url}";
    }

    /*public function getCreatedAtAttribute($created_at)
    {
        return $created_at->format('d/m/Y H:i');
    }*/

    public function scopeFilter($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
