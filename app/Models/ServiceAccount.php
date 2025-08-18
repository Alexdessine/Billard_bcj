<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // important
use Laravel\Sanctum\HasApiTokens;

class ServiceAccount extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'service_accounts';
    protected $fillable = ['name'];
}