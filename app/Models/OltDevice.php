<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OltDevice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ip_address', 'api_url', 'username', 'password'];
}
