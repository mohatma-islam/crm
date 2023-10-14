<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technology extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }

    public function technology_lookup()
    {
        return $this->hasOne(TechnologyLookup::class, 'id', 'technology_lookup_id');
    }
}
