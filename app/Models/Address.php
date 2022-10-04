<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'city',
        'district',
        'street',
        'building',
        'room',
    ];

    public function users() {
        return $this->hasMany(User::class, 'address_id', 'id');
    }
}
