<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'desc'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}
