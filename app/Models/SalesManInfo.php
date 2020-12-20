<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesManInfo extends Model
{
    protected $fillable = [
        'name',
        'postalCode',
    ];
}
