<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MikroTikDevice extends Model
{
    use HasFactory;
    protected $table = 'mikrotik_devices';
    protected $fillable = ['name', 'ip_address', 'username', 'password', 'port'];
}
