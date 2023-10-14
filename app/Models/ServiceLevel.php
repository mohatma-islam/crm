<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function website()
    {
        return $this->hasOne(Website::class, 'id', 'website_id');
    }

    public function serviceLevel_lookup()
    {
        return $this->hasOne(ServiceLevelLookup::class, 'id', 'service_level_lookup_id');
    }

    public function serviceLevelMaintenance_lookup()
    {
        return $this->hasOne(ServiceLevelMaintenanceLookup::class, 'id', 'maintenance_lookup_id');
    }
}
