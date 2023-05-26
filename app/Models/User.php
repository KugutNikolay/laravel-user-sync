<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'street',
        'suite',
        'city',
        'zipcode',
        'geo_lat',
        'geo_lng',
        'phone',
        'website',
        'company_name',
        'company_catch_phrase',
        'company_bs',
    ];

    protected $dates = ['deleted_at'];
}
