<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'gender',
        'country',
        'avatar',
        'age',
    ];

    protected $hidden = [
        'id',
        'updated_at'
    ];
}
