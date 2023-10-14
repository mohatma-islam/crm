<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whois extends Model
{
    use HasFactory;
    protected $dates = ['creation_date', 'expiration_date', 'updated_at'];
}
