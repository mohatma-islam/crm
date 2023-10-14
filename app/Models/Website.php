<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query
            ->where('website_name', 'like', '%' . $search.'%')
            ->orWhere('website_address', 'like', '%' . $search.'%')
        );
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function hostingDetail()
    {
        return $this->hasOne(HostingDetail::class, 'website_id', 'id');
    }

    public function serviceLevels()
    {
        return $this->hasMany(ServiceLevel::class, 'website_id', 'id');
    }

    public function technologies()
    {
        return $this->hasMany(Technology::class, 'website_id', 'id');
    }

}
