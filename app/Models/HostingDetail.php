<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ESolution\DBEncryption\Traits\EncryptedAttribute;

class HostingDetail extends Model
{
    use HasFactory, SoftDeletes, EncryptedAttribute;
    
    protected $guarded = ['id'];

    protected $encryptable = [
        'forge_server_id', 'host_name', 'host_username', 'host_password', 'host_port_number'
    ];

    public function website()
    {
        return $this->hasOne(Website::class, 'id', 'website_id');
    }

    public function server_supplier_lookup()
    {
        return $this->hasOne(ServerSupplierLookup::class, 'id', 'server_supplier_lookup_id');
    }   

    public function connection_type_lookup()
    {
        return $this->hasOne(ConnectionTypeLookup::class, 'id', 'connection_type_lookup_id');
    }   
}
