<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Website;
use App\Models\ClientContact;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['User:user_name'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query
            ->where('client_name', 'like', '%' . $search.'%'));
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id' , 'client_account_manager_id');
    }

    public function websites()
    {
        return $this->hasMany(Website::class, 'client_id', 'id');
    }

    public function clientContacts()
    {
        return $this->hasMany(ClientContact::class, 'client_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'client_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'client_id', 'id');
    }

    public function deal()
    {
        return $this->hasOne(Deal::class, 'client_id', 'id');
    }

}
